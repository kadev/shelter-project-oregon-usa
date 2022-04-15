<?php

/**
 * Class SongsController
 * This is a demo Controller class.
 *
 * If you want, you can use multiple Models or Controllers.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Mini\Controller;

use Mini\Libs\Helper;
use Mini\Model\Shelter;
use Mini\Model\ShelterRollback;
use Mini\Model\ShelterUpdates;
use Mini\Model\Song;

class ShelterUpdatesController
{

    public function index()
    {

        require APP . 'view/_templates/header.php';
        require APP . 'view/songs/index.php';
        require APP . 'view/_templates/footer.php';
    }


    public function store()
    {
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_shelter"])) {
            $params = array();
            parse_str($_POST["data_shelter"], $params);
            if(!isset($params['address-unknown'])) $params['address-unknown'] = 0;

            $Shelter = new Shelter();
            $ShelterUpdates = new ShelterUpdates();
            $params['shelter-id'] = $_POST['shelter_id'];
            $params['user-id'] = $session['user_id'];
            $params['request-status'] = "pending";
            $result->response = $ShelterUpdates->add($params);

            $newupdate = $ShelterUpdates->getLastRecord();

            if($result->response){
                if(isset($params['financialfiles']) AND !empty($params['financialfiles'])){
                    foreach ($params['financialfiles'] as $file){
                        $file['shelter_id'] = $newupdate->id;
                        $Shelter->addFinancialFile($file, "updates");
                    }
                }
            }

            Helper::addLog("create-shelter-update", $session['user_id'], $newupdate->id);
        }

        echo json_encode($result);
    }

    public function updateRequest(){
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_update"]) AND isset($_POST['update_id'])) {
            $params = array();
            parse_str($_POST["data_update"], $params);
            if(!isset($params['address-unknown'])) $params['address-unknown'] = 0;


            $Shelter = new Shelter();
            $ShelterUpdates = new ShelterUpdates();
            $result->response = $ShelterUpdates->update($params, $_POST['update_id']);

            if($result->response){
                $Shelter->destroyFinancialFiles($_POST['update_id'], 'updates');
                if(isset($params['financialfiles'])){
                    foreach ($params['financialfiles'] as $file){
                        $file['shelter_id'] = $_POST['update_id'];
                        $Shelter->addFinancialFile($file, "updates");
                    }
                }
            }

            Helper::addLog("edit-shelter-update", $session['user_id'], $_POST['update_id']);
        }

        echo json_encode($result);
    }

    public function approveRequest(){
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["update_id"])) {
            $ShelterUpdates = new ShelterUpdates();
            $ShelterRollback = new ShelterRollback();
            $Shelter = New Shelter();

            $dataUpdate = $ShelterUpdates->get($_POST['update_id']);
            $dataFinancials = $Shelter->getFinancialFiles($_POST['update_id'], "updates");

            $shelter = $Shelter->getShelter($dataUpdate->shelter_id);

            $params = array(
                'shelter-name' => $dataUpdate->shelter_name,
                'contact-name' => $dataUpdate->contact_name,
                'contact-title' => $dataUpdate->contact_title,
                'street-address' => $dataUpdate->street_address,
                'city' => $dataUpdate->city,
                'state' => $dataUpdate->states_id,
                'zip-code' => $dataUpdate->zip,
                'phone-number' => $dataUpdate->phone_number,
                'email' => $dataUpdate->email_address,
                'website' => $dataUpdate->website,
                'shelter-logo' => $dataUpdate->logo,
                'shelter-image' => $dataUpdate->image,
                'county' => $dataUpdate->county,
                'published' => $dataUpdate->published,
                'open-door-shelter' => $dataUpdate->open_shelter,
                'type-shelter' => $dataUpdate->type_shelter,
                'designated-no-kill' => $dataUpdate->designated_no_kill,
                'importing-shelter' => $dataUpdate->importing_shelter,
                'address-unknown' => $dataUpdate->address_unknown,
                'financials' => $dataUpdate->financials,
                'type-of-entry' => $dataUpdate->type_of_entry,
                'shelter-data' => $dataUpdate->shelter_data,
                'programs' => $dataUpdate->programs,
                'id' => $shelter->id
            );

            if($ShelterRollback->add($shelter, $session['user_id'])){
                $rollback = $ShelterRollback->getLastRecord();
                $Shelter->ChangeCurrentFilesToRollback($shelter->id, $rollback->id);
                if($Shelter->updateShelter($params)){
                    //$Shelter->ChangeUpdatesFilesToCurrent($dataUpdate->id, $shelter->id);
                    foreach ($dataFinancials as $file){
                        $file = (array) $file;
                        $file['file'] = $file['link'];
                        $file['shelter_id'] = $shelter->id;
                        $Shelter->addFinancialFile($file, "shelter");
                    }
                    $result->response = $ShelterUpdates->changeRequestStatus($dataUpdate->id, 'approved');
                    Helper::addLog("approved-shelter-update", $session['user_id'], $dataUpdate->id);
                }
            }
        }

        echo json_encode($result);
    }

    public function declineRequest(){
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["update_id"])) {
            $ShelterUpdates = new ShelterUpdates();

            $result->response = $ShelterUpdates->changeRequestStatus($_POST["update_id"], 'declined');

            Helper::addLog("decline-shelter-update", $session['user_id'], $_POST["update_id"]);
        }

        echo json_encode($result);
    }

    public function removeImageShelter(){
        $result = new \stdClass();
        $result->response = false;
        $ShelterUpdates = new ShelterUpdates();

        if (isset($_POST["image_shelter"]) AND !empty($_POST["image_shelter"])) {
            $filename = $_POST["image_shelter"];
            $PATHFILE = ROOT . 'public/uploads/'.$filename;
            $result->pathfile = $PATHFILE;
            if (file_exists($PATHFILE)) {
                $result->response = unlink($PATHFILE);
                if($result->response == true AND isset($_POST['shelter_id'])){
                    $shelter = $ShelterUpdates->get($_POST['shelter_id']);

                    if($shelter->logo == $_POST["image_shelter"]){
                        $ShelterUpdates->clearImageColumn($_POST['shelter_id'], "logo");
                    }elseif($shelter->image == $_POST["image_shelter"]){
                        $ShelterUpdates->clearImageColumn($_POST['shelter_id'], "image");
                    }

                }
            } else {
                $result->response = true;
            }
        }

        echo json_encode($result);
    }
}
