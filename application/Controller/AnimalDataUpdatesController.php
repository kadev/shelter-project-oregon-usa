<?php

namespace Mini\Controller;

use Mini\Libs\Helper;
use Mini\Model\Animal;
use Mini\Model\AnimalData;
use Mini\Model\AnimalDataUpdates;
use Mini\Model\Population;
use Mini\Model\Shelter;

class AnimalDataUpdatesController
{
    private $_animal, $_animalData, $_animalDataUpdates, $_population, $_shelter;
    private $_session;

    public function __construct(){
        Helper::verifyUserSession();
        $this->_session = Helper::getSession();

        $this->_animal = new Animal();
        $this->_animalData = new AnimalData();
        $this->_animalDataUpdates = new AnimalDataUpdates();
        $this->_population = new Population();
        $this->_shelter = new Shelter();
    }
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/pages/index
     */
    public function index()
    {
        echo "Page not found (Error 404)";
        return false;
    }

    public function createAnimalDataByShelterIDAndYear(){
        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["shelter"]) AND isset($_POST["year"])) {
            $params = array();
            parse_str($_POST["data"], $params);

            $data = new \stdClass();
            $data->shelter = $_POST["shelter"];
            $data->year = $_POST["year"];
            $data->no_data = $_POST["no_data"];
            $data->population = $params["population"];
            $data->notes = $params["notes"];
            $data->user_id = $this->_session['user_id'];
            $data->request_status = "pending";
            $data->animal_data = json_encode($params['data']);

            $this->_animalDataUpdates->add($data);

            $result->response = true;
            $lastRecord = $this->_animalDataUpdates->getLastRecord();

            Helper::addLog("create-data-request", $this->_session['user_id'], $lastRecord->id);

        }

        echo json_encode($result);
    }

    public function updateRequestAnimalDataRequest(){
        $result = new \stdClass();
        $result->response = false;
        $dataID = NULL;

        if (isset($_POST["request"]) AND isset($_POST["shelter"])) {
            $params = array();
            parse_str($_POST["data"], $params);
            $request = null;

            if(!empty($_POST["request"])) $request = $this->_animalDataUpdates->get($_POST["request"]);

            if($request != null AND $request->request_status == "pending"){
                $data = new \stdClass();
                $data->id = $_POST["request"];
                $data->no_data = $_POST["no_data"];
                $data->population = $params["population"];
                $data->notes = $params["notes"];
                $data->animal_data = json_encode($params['data']);

                if($this->_animalDataUpdates->update($data)){
                    $result->response = true;
                    Helper::addLog("update-data-request", $this->_session['user_id'], $data->id);
                }
            }
        }

        echo json_encode($result);
    }

    public function changeRequestStatus(){
        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["request"]) AND isset($_POST["status"])) {
            $request = $this->_animalDataUpdates->get($_POST["request"]);

            if($request->request_status != "approved" AND $request->request_status  != "declined"){
                if($this->_animalDataUpdates->changeRequestStatus($_POST["request"], $_POST["status"])){
                    $result->response = true;

                    if($_POST["request"] == "approved"){
                        $data = json_decode($request->animal_data);

                        foreach ($data as $animal => $adata){
                            $row = $this->_animalData->getAnimalDataByShelterYearAndAnimalID($request->shelter_id, $request->year, $animal);
                            //create backup

                             $d = array(
                                'received' => $adata->received,
                                'returned' => $adata->returned,
                                'placed' => $adata->placed,
                                'transfers_in' => $adata->transfers_in,
                                'euthanized' => $adata->euthanized,
                                'transfers_out' => $adata->transfers_out,
                                'transfers_out_within_area' => $adata->transfers_out_within_area,
                                'transfers_out_outside_area' => $adata->transfers_out_outside_area,
                                'transfers_in_within_area' => $adata->transfers_in_within_area,
                                'transfers_in_outside_area' => $adata->transfers_in_outside_area
                            );

                            if($row){
                                $d['data_id'] = $row->data_id;
                                $this->_animalData->updateAnimalData($d);
                            }else{
                                $this->_animalData->addAnimalData($request->shelter_id, $animal, $request->year, $d);
                            }
                        }
                    }

                    Helper::addLog($_POST["status"]."-data-request", $this->_session['user_id'], $_POST["request"]);
                }
            }
        }

        echo json_encode($result);
    }

    public function deleteRequest(){
        $result = new \stdClass();
        $result->response = false;

        if(isset($_POST["request"])){
            $request = $this->_animalDataUpdates->get($_POST["request"]);

            if($request){
                if($this->_animalDataUpdates->delete($request->id)){
                    $result->response = true;
                    Helper::addLog("delete-data-request", $this->_session['user_id'], $request->id);
                }
            }
        }

        echo json_encode($result);
    }
}