<?php

namespace Mini\Controller;

use Mini\Model\AnimalDataUpdates;
use Mini\Model\SecurityLog;
use Mini\Model\State;
use Mini\Model\Animal;
use Mini\Model\Shelter;
use Mini\Model\AnimalData;
use Mini\Model\Population;
use Mini\Model\User;

use Mini\Libs\Helper;
use Mini\Model\UserPermissions;

class AnimalDataController
{
    private $_secutirylog, $_state, $_animal, $_shelter, $_animaldata, $_animalDataUpdates, $_population, $_user, $_userpermissions;

    function __construct() {
        $this->_secutirylog = new SecurityLog();
        $this->_state = new State();
        $this->_animal = new Animal;
        $this->_shelter = new Shelter();
        $this->_animaldata = new AnimalData();
        $this->_animalDataUpdates = new AnimalDataUpdates();
        $this->_population = new Population();
        $this->_user = new User();
        $this->_userpermissions = new UserPermissions();
    }

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/pages/index
     */
    public function index($shelter_id = NULL, $year = NULL)
    {
        Helper::verifyUserSession();
        $session = Helper::getSession();
        $title = "Animal Data";
        $current_page = "animal-data";

        $custom_css = array(
            0 => URL."plugins/summernote/summernote-bs4.css"
        );
        $custom_js = array(
            0 => URL."plugins/summernote/summernote-bs4.js",
            1 => URL."js/animal-data.js"
        );

        $State = new State();
        $Animal = new Animal();
        $AnimalData = new AnimalData();
        $Shelter = new Shelter();
        $Population = new Population();
        $datatables = true;

        $states = $State->getAllStates();
        $animals = $Animal->getAllAnimals();
        //$shelters = $Shelter->getAllShelters();

        if($shelter_id != NULL){
            $shelter = $Shelter->getShelter($shelter_id);
            $shelters = $Shelter->getSheltersByStateID($shelter->states_id);

            if($year != NULL){
                //$shelter_data = $AnimalData->getAnimalDataByShelterAndYear($shelter_id, $year);
                $no_data = $AnimalData->getShelterNoDataByShelterAndYear($shelter_id, $year);
                $shelter_notes = $Shelter->getShelterNotesByYear($shelter->id, $year);
                $shelter_population = $Population->getPopulationByShelterIDAndYear($shelter->id, $year);
            }

        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/animal-data/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function updates($update_id = null){
        Helper::verifyUserSession();
        $session = Helper::getSession();
        $title = "Manage Updates";
        $current_page = "manage-updates";
        $datatables = true;
        $requests = array();

        $custom_js = array(
            0 => URL."js/animal-data-send-update.js"
        );

        if($session['privilege'] == 4){
            $requests = $this->_animalDataUpdates->getByUserID($session['user_id']);
        }elseif($session['privilege'] == 1 OR $session['privilege'] == 2){
            $requests = $this->_animalDataUpdates->getByStatus("pending");
        }


        require APP . 'view/_templates/header.php';

        if($update_id == null){
            require APP . 'view/animal-data/updates.php';
        }else{
            $animals = $this->_animal->getAllAnimals();
            $request = $this->_animalDataUpdates->get($update_id);
            $shelter = null;

            if($request){
                $shelter = $this->_shelter->getShelter($request->shelter_id);
                $animalData = json_decode($request->animal_data);
            }

            require APP . 'view/animal-data/update-review.php';
        }

        require APP . 'view/_templates/footer.php';
    }

    public function send_update($shelter_id = NULL, $year = NULL)
    {
        Helper::verifyUserSession();
        $session = Helper::getSession();
        $title = "Send Update";
        $current_page = "animal-data-send-update";

        $custom_css = array(
            0 => URL."plugins/summernote/summernote-bs4.css"
        );

        $custom_js = array(
            0 => URL."plugins/summernote/summernote-bs4.js",
            1 => URL."js/animal-data-send-update.js"
        );

        $datatables = true;
        $permissionData = $this->getPermissionDataForEditor("states");

        $animals = $this->_animal->getAllAnimals();

        if($shelter_id != NULL){
            $shelter = $this->_shelter->getShelter($shelter_id);
            $shelters = $this->_shelter->getSheltersByStateID($shelter->states_id);
            $years = $this->getPermissionDataForEditor("years", $shelter->states_id);

            if($year != NULL){
                $no_data = $this->_animaldata->getShelterNoDataByShelterAndYear($shelter_id, $year);
                $shelter_notes = $this->_shelter->getShelterNotesByYear($shelter->id, $year);
                $shelter_population = $this->_population->getPopulationByShelterIDAndYear($shelter->id, $year);
            }

        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/animal-data/send-update.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/pages/create
     */
    public function create()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $current_page = "animal-data";

        require APP . 'view/_templates/header.php';
        require APP . 'view/animal-data/create.php';
        require APP . 'view/_templates/footer.php';
    }

    public function activity($data_id)
    {
        Helper::verifyUserSession();
        $session = Helper::getSession();
        $current_page = "animal-data";
        $title = "Activity Log";
        $custom_js = URL . "js/animal-data.js";
        $Shelter = new Shelter();
        $Log = new SecurityLog();
        $AnimalData = new AnimalData();
        $datatables = true;

        $data = $AnimalData->getAnimalData($data_id);
        $logs = $Log->getAnimalDataLogByDataID($data->data_id);
        $shelter = $Shelter->getShelter($data->shelter_id);
        //$activity = $this->generateTemplateActivity($Log->getAnimalDataLogByShelter($shelter_id));

        require APP . 'view/_templates/header.php';
        require APP . 'view/animal-data/activity-log.php';
        require APP . 'view/_templates/footer.php';
    }

    public function getShelterByID()
    {
        $result = new \stdClass();
        $result->response = false;
        $session = Helper::getSession();

        if (isset($_POST["data_id"])) {
            $Shelter = new Shelter();
            $Population = new Population();
            $Log = new SecurityLog();

            $result->shelter = $Shelter->getShelter($_POST["data_id"]);

            if (!empty($result->shelter) or $result->shelter != null) {
                $AnimalData = new AnimalData();
                $State = new State();
                $data = $AnimalData->getAnimalDataByShelterAndYear($result->shelter->id, null);
                $result->shelter->shelter_name = Helper::getTheCorrectShelterName($result->shelter->shelter_name);
                $result->shelter->state_name = $State->getStateNameById($result->shelter->states_id);
                //$result->shelter->activity = $this->generateTemplateActivity($Log->getAnimalDataLogByShelter($result->shelter->id));

                if (!empty($data) or $data != null) {
                    $result->shelter->population = $Population->getPopulationByShelterIDAndYear($result->shelter->id, $data{0}->year);
                    $result->shelter->notes = $Shelter->getShelterNotesByYear($result->shelter->id, $data{0}->year);
                    $result->shelter->no_data = $AnimalData->getShelterNoDataByShelterAndYear($result->shelter->id, $data{0}->year);
                    $result->shelter->animal_data = $data;
                    $result->last_year = $data{0}->year;
                    //Helper::addLog("viewed-animal-data", $session['user_id'], $data{0}->id);
                } else {
                    $result->shelter->population = false;
                    $result->shelter->notes = false;
                    $result->shelter->no_data = false;
                    $result->shelter->animal_data = false;
                    $result->last_year = date("Y");
                }

                $result->response = true;
            }
        }

        echo json_encode($result);
    }

    public function getShelterDataByYear()
    {
        $result = new \stdClass();
        $result->response = false;
        $session = Helper::getSession();

        if (isset($_POST["shelter"]) and isset($_POST["year"])) {
            $AnimalData = new AnimalData();
            $Population = new Population();
            $Shelter = new Shelter();

            $data = $AnimalData->getAnimalDataByShelterAndYear($_POST["shelter"], $_POST["year"]);
            $population = $Population->getPopulationByShelterIDAndYear($_POST["shelter"], $_POST["year"]);
            $notes = $Shelter->getShelterNotesByYear($_POST["shelter"], $_POST["year"]);
            $no_data = $AnimalData->getShelterNoDataByShelterAndYear($_POST["shelter"], $_POST["year"]);

            if (!empty($data) or $data != null) {
                $result->animal_data = $data;
                $result->population = $population;
                $result->notes = $notes;
                $result->no_data = $no_data;

                //Helper::addLog("viewed-animal-data", $session['user_id'], $data{0}->id);
            } else {
                $result->animal_data = false;
                $result->population = null;
                $result->notes = null;
                $result->no_data = $no_data;
            }
            $result->response = true;
        }
        echo json_encode($result);
    }

    public function getSheltersByState()
    {
        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_id"])) {
            $Shelter = new Shelter();
            $result->shelters = $Shelter->getSheltersByStateID($_POST["data_id"]);

            if (!empty($result->shelters) or $result->shelters != null) {
                $result->response = true;
            }
        }

        echo json_encode($result);
    }

    public function getSheltersByYear($year){
        Helper::verifyUserSession();
        $session = Helper::getSession();

        if(empty($year)) header("Location: ". URL.'404');

        $current_page = "animal-data";
        $AnimalData = new AnimalData();
        $State = new State();
        $Shelter = new Shelter();
        $shelters = array();
        $datatables = true;
        $custom_js = URL . "js/animal-data.js";

        $data = $AnimalData->getAnimalDataByYear($year);

        foreach ($data as $item){
            $shelterInfo = $Shelter->getShelter($item->shelter_id);
            array_push($shelters, $shelterInfo);
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/animal-data/shelters-by-year.php';
        require APP . 'view/_templates/footer.php';
    }

    public function createAnimalDataByShelterIDAndYear(){
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["shelter"]) AND isset($_POST["year"])) {
            $AnimalData = new AnimalData(); $Population = new Population(); $Shelter = new Shelter();
            $params = array();
            parse_str($_POST["data"], $params);

            foreach ($params['data'] as $key => $data) {
                $AnimalData->addAnimalData($_POST["shelter"], $key, $_POST["year"], $data);
            }

            $Population->addPopulation($_POST["shelter"], $_POST["year"], $params["population"]);
            $Shelter->addShelterNotes($_POST["shelter"], $_POST["year"], $params["notes"]);

            $result->response = true;
            $newAnimalData = $AnimalData->getLastRecord();

            Helper::addLog("create-animal-data", $session['user_id'], $newAnimalData->data_id);

        }

        echo json_encode($result);
    }

    public function updateAnimalDataByShelterIDAndYear(){
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;
        $dataID = NULL;

        if (isset($_POST["shelter"]) AND isset($_POST["year"])) {
            $AnimalData = new AnimalData(); $Population = new Population(); $Shelter = new Shelter();
            $params = array();
            parse_str($_POST["data"], $params);

            foreach ($params['data'] as $data) {
                if(isset($data['data_id']) AND !empty($data['data_id'])){
                    $AnimalData->updateAnimalData($data);
                    $dataID = $data['data_id'];
                }
            }

            if(isset($params['population_id']) AND !empty($params['population_id']) AND !is_null($params['population_id'])){
                $Population->updatePopulation($params['population_id'], $params["population"]);
            }

            if(isset($params['notes_id']) AND !empty($params['notes_id']) AND !is_null($params['notes_id'])){
                $Shelter->updateShelterNotes($params["notes_id"], $params["notes"]);
            }

            $result->response = true;
            Helper::addLog("update-animal-data", $session['user_id'], $dataID);
        }

        echo json_encode($result);
    }

    public function changeShelterYearNoData(){
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["shelter_id"]) AND isset($_POST["year"]) AND isset($_POST['status'])) {
            $AnimalData = new AnimalData();
            $no_data = $AnimalData->getShelterNoDataByShelterAndYear($_POST["shelter_id"], $_POST["year"]);

            if($no_data != false){
                $no_data->status = $_POST["status"];

                $result->response = $AnimalData->changeNoDataShelter($no_data);
            }else{
                $no_data = new \stdClass();
                $no_data->shelter_id = $_POST["shelter_id"];
                $no_data->year = $_POST["year"];
                $no_data->status = $_POST["status"];

                $result->response = $AnimalData->createNoDataShelter($no_data);
                $no_data = $AnimalData->getLastRecordNoDataTable();
            }

            $result->response = true;
            Helper::addLog("change-no-data-shelter", $session['user_id'], $no_data->id);
        }

        echo json_encode($result);
    }

    public function updateNotesById(){
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["note_id"]) AND isset($_POST["comments"])) {
            $Shelter = new Shelter();
            $params = array();

            if($Shelter->updateShelterNotes($_POST["note_id"], $_POST["comments"])){
                Helper::addLog("update-shelter-notes", $session['user_id'], $_POST["note_id"]);
                $result->response = true;
            }
        }

        echo json_encode($result);
    }

    public function goToAnimalData($type, $data_id){
        $AnimalData = new AnimalData();
        $Shelter = new Shelter();

        if($type == "id")
            $data = $AnimalData->getAnimalData($data_id);

        if($type == "no-data")
            $data = $AnimalData->getAnimalNoDataById($data_id);

        if($type == "notes")
            $data = $Shelter->getShelterNotesByNoteID($data_id);

        if(!empty($data) AND $data != NULL){
            header("Location: " . URL . "animalData/index/".$data->shelter_id."/".$data->year);
        }else{
            header("Location: " . URL . "error"); //redirect to 404 page
        }

    }

    public function getSheltersTableData(){
        $session = Helper::getSession();
        $Shelter = new Shelter();
        $State = new State();
        $result = array();
        $result['data'] = array();

        $shelters = $Shelter->getAllShelters();

        foreach ($shelters as $shelter){
            $actions = "";
            $stateName = ($shelter->states_id == 0) ? '<span class="badge badge-danger">Not assigned</span>' : $State->getStateNameById($shelter->states_id);
            $temp = array(
                $shelter->shelter_name
            );

            $actions .= '<div class="btn-icon-list">';
            $actions .= '<span data-shelter="'.$shelter->id.'" class="btn ripple btn-primary btn-sm show-shelter-data"><i class="fe fe-eye"></i></span>';
            $actions .= '</div>';

            array_push($temp, $actions);

            array_push($result['data'], $temp);
        }

        echo json_encode($result);
    }

    private function getPermissionDataForEditor($response = "states", $state_id = null){
        $session = Helper::getSession();
        $result = new \stdClass();
        $permissions = $this->_userpermissions->getByKeynameAndUserID("data-editor-permissions-by-state", $session['user_id'], "all");

        switch ($response){
            case 'states':
                if($this->checkAllStatesAvailable($permissions)){
                    $states = $this->_state->getAllStates();
                }else{
                    foreach ($permissions as $permission){
                        $states = array();

                        if(!empty($permission->value)){
                            $state = $this->_state->getState($permission->value);
                            array_push($states, $state);
                        }
                    }
                }

                $result = $states;

                break;
            case 'years':
                $years = array();
                if($this->checkAllYearsAvailable($permissions, $state_id)){
                    for($i = date("Y"); $i >= 1970 ; $i--){
                        array_push($years, $i);
                    }
                }else{
                    foreach ($permissions as $permission){
                        if($permission->value == $state_id OR $permission->value == "all"){
                            $hyears = explode(",", $permission->other_value);

                            foreach ($hyears as $y){
                                if($y != "all"){
                                    array_push($years, $y);
                                }
                            }
                        }
                    }

                    $result = $years;
                }

                break;
            default:
                return false;
        }

        return $result;
    }

    private function checkAllStatesAvailable($permissions){
        $result = false;

        foreach ($permissions as $permission){
            if($permission->value == "all"){
                $result = true;
                return $result;
            }
        }

        return $result;
    }

    private function checkAllYearsAvailable($permissions, $state_id){
        $result = false;

        foreach ($permissions as $permission){
            if($permission->other_value == $state_id AND $permission->other_value == "all"){
                $result = true;
                return $result;
            }
        }

        return $result;
    }
}
