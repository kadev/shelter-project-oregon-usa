<?php

namespace Mini\Controller;

use Mini\Libs\Helper;
use Mini\Model\Animal;
use Mini\Model\AnimalData;
use Mini\Model\Population;
use Mini\Model\Shelter;
use Mini\Model\ShelterRollback;
use Mini\Model\ShelterUpdates;
use Mini\Model\State;
use Mini\Model\County;

class SheltersController
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/pages/index
     */
    public function index()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Shelters";
        $Shelter = new Shelter();
        $State = new State();
        $current_page = "shelters";
        $custom_js = URL."js/shelters.js";
        $datatables = true;

        $shelters = $Shelter->getAllShelters();

        require APP . 'view/_templates/header.php';
        require APP . 'view/shelters/index.php';
        require APP . 'view/_templates/footer.php';
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

    public function getShelterReport($shelter_id){
        $result = new \stdClass();
        $result->response = false;

        if (isset($shelter_id)) {
            $Shelter = new Shelter();
            $Population = new Population();

            $result->shelter = $Shelter->getShelter($shelter_id);

            if (!empty($result->shelter) or $result->shelter != null) {
                $AnimalData = new AnimalData(); $State = new State(); $Animal = new Animal();
                $animals = $Animal->getAllAnimals();
                $data = array();

                foreach ($animals as $animal){
                    $h = new \stdClass();
                    $h->animal_name = $animal->name;
                    $h->data = $AnimalData->getAnimalDataByShelterAndAnimalID($result->shelter->id, $animal->id);

                    //foreach ($h->data as $item){

                    //}

                    array_push($data,$h);
                }

                $result->shelter->shelter_name = Helper::getTheCorrectShelterName($result->shelter->shelter_name);
                $result->shelter->state_name = $State->getStateNameById($result->shelter->states_id);

                if (!empty($data) or $data != null) {
                    $result->shelter->report_data = $data;
                } else {
                    $result->shelter->report_data = false;
                }

                $result->response = true;
            }
        }

        return $result;
    }

    public function getSheltersData(){
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
                "<a href='".URL."shelters/edit/".$shelter->id."'>".$shelter->id."</a>",
                "<a href='".URL."shelters/edit/".$shelter->id."'>".$shelter->shelter_name."</a>",
                $shelter->street_address,
                $stateName
            );

            $actions .= '<div class="btn-icon-list">';
            if($session['privilege'] == 1 OR $session['privilege'] == 2) {
                $actions .= '<a href="' . URL . 'shelters/edit/' . $shelter->id . '" class="btn ripple btn-info btn-sm"><i class="fe fe-edit"></i></a>';
                $actions .= '<span data-shelter="' . $shelter->id . '" class="btn ripple btn-danger btn-sm delete-shelter"><i class="fe fe-trash"></i></span>';
            }elseif($session['privilege'] == 3){
                $actions .= '<a href="'.URL.'shelters/send-update/'.$shelter->id.'" class="btn ripple btn-info btn-sm"><i class="fe fe-edit"></i></a>';
            }
            $actions .= '</div>';
            array_push($temp, $actions);

            array_push($result['data'], $temp);
        }

        echo json_encode($result);
    }

    public function getSheltersForSearch(){
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
                $shelter->shelter_name,
                $stateName
            );

            $actions .= '<div class="btn-icon-list">';
            $actions .= '<a href="'.URL.'shelters/report/'.$shelter->id.'" class="btn ripple btn-primary btn-sm"><i class="fe fe-eye"></i></a>';
            $actions .= '</div>';

            array_push($temp, $actions);

            array_push($result['data'], $temp);
        }

        echo json_encode($result);
    }

    public function create()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Create shelter";
        $current_page = "create-shelter";
        $custom_css = array(
            0 => URL."plugins/fancyuploder/fancy_fileupload.css",
            1 => URL."plugins/summernote/summernote-bs4.css"
        );
        $custom_js = array(
            0 => URL."plugins/fancyuploder/jquery.ui.widget.js",
            1 => URL."plugins/fancyuploder/jquery.fileupload.js",
            2 => URL."plugins/fancyuploder/jquery.iframe-transport.js",
            3 => URL."plugins/fancyuploder/jquery.fancy-fileupload.js",
            4 => URL."plugins/summernote/summernote-bs4.js",
            5 => URL."js/shelter-financials.js",
            6 => URL."js/shelters.js"
        );

        $State = new State();
        $County = new County();
        $states = $State->getAllStates();
        $counties = $County->getAllCounties();

        require APP . 'view/_templates/header.php';
        require APP . 'view/shelters/create.php';
        require APP . 'view/_templates/footer.php';
    }

    public function addShelter(){
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_shelter"])) {
            $params = array();
            parse_str($_POST["data_shelter"], $params);
            if(!isset($params['address-unknown'])) $params['address-unknown'] = 0;

            //echo json_encode($params['financialfiles']); exit();


            $Shelter = new Shelter();
            if(!isset($params['county'])) $params['county'] = null;
            $result->response = $Shelter->addShelter($params);
            $newshelter = $Shelter->getLastRecord();

            if($result->response){
                if(isset($params['financialfiles']) AND !empty($params['financialfiles'])){
                    foreach ($params['financialfiles'] as $file){
                        $file['shelter_id'] = $newshelter->id;
                        $Shelter->addFinancialFile($file, "shelter");
                    }
                }
            }

            Helper::addLog("create-shelter", $session['user_id'], $newshelter->id);

        }

        echo json_encode($result);
    }


    public function edit($shelter_id)
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Edit shelter";
        $current_page = "shelters";
        $custom_css = array(
            0 => URL."plugins/fancyuploder/fancy_fileupload.css",
            1 => URL."plugins/summernote/summernote-bs4.css"
        );
        $custom_js = array(
            0 => URL."plugins/fancyuploder/jquery.ui.widget.js",
            1 => URL."plugins/fancyuploder/jquery.fileupload.js",
            2 => URL."plugins/fancyuploder/jquery.iframe-transport.js",
            3 => URL."plugins/fancyuploder/jquery.fancy-fileupload.js",
            4 => URL."plugins/summernote/summernote-bs4.js",
            5 => URL."js/shelter-financials.js",
            6 => URL."js/shelters.js"
        );
        $Shelter = new Shelter();
        $State = new State();
        $County = new County();
        $shelter = $Shelter->getShelter($shelter_id);
        $financialFiles = $Shelter->getFinancialFiles($shelter_id, 'shelter');
        $states = $State->getAllStates();

        if(!empty($shelter->states_id)){
            $state = $State->getState($shelter->states_id);
            $counties = $County->getByStateCode($state->short_name);
        }else{
            $counties = null;
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/shelters/edit.php';
        require APP . 'view/_templates/footer.php';
    }

    public function send_update($shelter_id){
        Helper::verifyUserSession();
        $session = Helper::getSession();
        $title = "Send shelter update";
        $current_page = "shelters";
        $custom_css = array(
            0 => URL."plugins/fancyuploder/fancy_fileupload.css",
            1 => URL."plugins/summernote/summernote-bs4.css"
        );
        $custom_js = array(
            0 => URL."plugins/fancyuploder/jquery.ui.widget.js",
            1 => URL."plugins/fancyuploder/jquery.fileupload.js",
            2 => URL."plugins/fancyuploder/jquery.iframe-transport.js",
            3 => URL."plugins/fancyuploder/jquery.fancy-fileupload.js",
            4 => URL."plugins/summernote/summernote-bs4.js",
            5 => URL."js/shelter-financials.js",
            6 => URL."js/shelter-updates.js"
        );

        $Shelter = new Shelter();
        $State = new State();
        $County = new County();
        $shelter = $Shelter->getShelter($shelter_id);
        $financialFiles = $Shelter->getFinancialFiles($shelter_id, 'shelter');
        $states = $State->getAllStates();

        if(!empty($shelter->states_id)){
            $state = $State->getState($shelter->states_id);
            $counties = $County->getByStateCode($state->short_name);
        }else{
            $counties = null;
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/shelters/send-update.php';
        require APP . 'view/_templates/footer.php';
    }

    public function updates($update_id = null){
        Helper::verifyUserSession();
        $session = Helper::getSession();
        $title = "Shelter updates";
        $current_page = "shelter-updates";
        $datatables = true;
        $custom_css = array(
            0 => URL."plugins/fancyuploder/fancy_fileupload.css",
            1 => URL."plugins/summernote/summernote-bs4.css"
        );
        $custom_js = array(
            0 => URL."plugins/fancyuploder/jquery.ui.widget.js",
            1 => URL."plugins/fancyuploder/jquery.fileupload.js",
            2 => URL."plugins/fancyuploder/jquery.iframe-transport.js",
            3 => URL."plugins/fancyuploder/jquery.fancy-fileupload.js",
            4 => URL."plugins/summernote/summernote-bs4.js",
            5 => URL."js/shelter-financials.js",
            6 => URL."js/shelter-updates.js"
        );

        $Shelter = new Shelter();
        $ShelterUpdates = new ShelterUpdates();
        $State = new State();
        $County = new County();

        $requests = $ShelterUpdates->getAll();
        $states = $State->getAllStates();

        require APP . 'view/_templates/header.php';

        if($update_id == null){
            require APP . 'view/shelters/updates.php';
        }else{
            $shelter = $ShelterUpdates->get($update_id);
            $financialFiles = $Shelter->getFinancialFiles($shelter->id, "updates");

            if(!empty($shelter->states_id)){
                $state = $State->getState($shelter->states_id);
                $counties = $County->getByStateCode($state->short_name);
            }else{
                $counties = null;
            }

            require APP . 'view/shelters/update-review.php';
        }

        require APP . 'view/_templates/footer.php';
    }

    public function backups($shelter_id){
        Helper::verifyUserSession();
        $session = Helper::getSession();
        $title = "Shelter backups";
        $current_page = "shelter-backups";

        /*$custom_js = array(
            4 => URL."js/shelter-updates.js"
        );*/

        $Shelter = new Shelter();
        $ShelterRollback = new ShelterRollback();
        $State = new State();
        $County = new County();

        $shelter = $Shelter->getShelter($shelter_id);
        $backups = $ShelterRollback->getByShelterID($shelter_id);
        $states = $State->getAllStates();
        $counties = $County->getAllCounties();

        require APP . 'view/_templates/header.php';
        require APP . 'view/shelters/backups.php';
        require APP . 'view/_templates/footer.php';
    }

    public function backup_details($backup_id){
        Helper::verifyUserSession();
        $session = Helper::getSession();
        $title = "Shelter: Backup Details";
        $current_page = "backup-details";

        $custom_css = array(
            0 => URL."plugins/fancyuploder/fancy_fileupload.css",
            1 => URL."plugins/summernote/summernote-bs4.css"
        );

        $custom_js = array(
            0 => URL."plugins/fancyuploder/jquery.ui.widget.js",
            1 => URL."plugins/fancyuploder/jquery.fileupload.js",
            2 => URL."plugins/fancyuploder/jquery.iframe-transport.js",
            3 => URL."plugins/fancyuploder/jquery.fancy-fileupload.js",
            4 => URL."plugins/summernote/summernote-bs4.js",
            5 => URL."js/shelter-backups.js"
        );

        $Shelter = new Shelter();
        $ShelterRollback = new ShelterRollback();
        $State = new State();
        $County = new County();

        $backup = $ShelterRollback->get($backup_id);
        $financialFiles = $Shelter->getFinancialFiles($backup_id, 'rollback');

        $states = $State->getAllStates();
        $counties = $County->getAllCounties();

        require APP . 'view/_templates/header.php';
        require APP . 'view/shelters/backup-review.php';
        require APP . 'view/_templates/footer.php';
    }

    public function updateShelter()
    {
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_shelter"]) AND isset($_POST["shelter_id"])) {
            $params = array();
            parse_str($_POST["data_shelter"], $params);
            if(!isset($params['address-unknown'])) $params['address-unknown'] = 0;

            $Shelter = new Shelter();
            $params['id'] = $_POST["shelter_id"];
            $result->response = $Shelter->updateShelter($params);

            if($result->response){
                $Shelter->destroyFinancialFiles($params['id'], 'shelter');
                if(isset($params['financialfiles'])){
                    foreach ($params['financialfiles'] as $file){
                        $file['shelter_id'] = $params['id'];
                        $Shelter->addFinancialFile($file, "shelter");
                    }
                }
            }

            Helper::addLog("update-shelter", $session['user_id'], $_POST["shelter_id"]);
        }

        echo json_encode($result);
    }

    public function uploadShelterImage(){
        require_once APP."Libs/FancyFileUploaderHelper.php";

        header("Content-Type: application/json");

        $allowedexts = array("jpg" => true, "png" => true,);

        $files = FancyFileUploaderHelper::NormalizeFiles("files");

        if (!isset($files[0]))  $result = array("success" => false, "error" => "File data was submitted but is missing.", "errorcode" => "bad_input");
        else if (!$files[0]["success"])  $result = $files[0];
        else if (!isset($allowedexts[strtolower($files[0]["ext"])])) {
            $result = array(
                "success" => false,
                "error" => "Invalid file extension.  Must be '.jpg' or '.png'.",
                "errorcode" => "invalid_file_ext"
            );
        }
        else
        {
            // For chunked file uploads, get the current filename and starting position from the incoming headers.
            $name = FancyFileUploaderHelper::GetChunkFilename();
            if ($name !== false) {
                $startpos = FancyFileUploaderHelper::GetFileStartPosition();
            }
            else {
                // [Do stuff with the file here.]
                $tname = explode(".", $files[0]["name"]);
                $tname = $tname[0].".".time().'.'.$files[0]["ext"];

                copy($files[0]["file"], __DIR__ . "/../../public/uploads/" . strtolower($tname));
            }

            $result = array(
                "success" => true,
                "filename" => $tname
            );
        }

        echo json_encode($result, JSON_UNESCAPED_SLASHES);
        exit();
        //}
    }

    public function getCountiesByState()
    {
        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_id"])) {
            $County = new County();
            $State = new State();

            $state = $State->getState($_POST["data_id"]);
            $result->counties = $County->getByStateCode($state->short_name);

            if ($result->counties != null OR empty($result->counties)) {
                $result->response = true;
            }
        }

        echo json_encode($result);
    }

    public function removeImageShelter(){
        $result = new \stdClass();
        $result->response = false;
        $Shelter = new Shelter();

        if (isset($_POST["image_shelter"]) AND !empty($_POST["image_shelter"])) {
            $filename = $_POST["image_shelter"];
            $PATHFILE = ROOT . 'public/uploads/'.$filename;
            $result->pathfile = $PATHFILE;
            if (file_exists($PATHFILE)) {
                $result->response = unlink($PATHFILE);
                if($result->response == true AND isset($_POST['shelter_id'])){
                    $shelter = $Shelter->getShelter($_POST['shelter_id']);

                    if($shelter->logo == $_POST["image_shelter"]){
                        $Shelter->clearImageColumn($_POST['shelter_id'], "logo");
                    }elseif($shelter->image == $_POST["image_shelter"]){
                        $Shelter->clearImageColumn($_POST['shelter_id'], "image");
                    }

                }
            } else {
                $result->response = true;
            }
        }

        echo json_encode($result);
    }

    public function uploadFinancialFiles(){
        require_once APP."Libs/FancyFileUploaderHelper.php";

        header("Content-Type: application/json");

        $allowedexts = array("jpg" => true, "png" => true, "pdf" => true);

        $files = FancyFileUploaderHelper::NormalizeFiles("file-upload");

        if (!isset($files[0]))  $result = array("success" => false, "error" => "File data was submitted but is missing.", "errorcode" => "bad_input");
        else if (!$files[0]["success"])  $result = $files[0];
        else if (!isset($allowedexts[strtolower($files[0]["ext"])])) {
            $result = array(
                "success" => false,
                "error" => "Invalid file extension.  Must be '.jpg', '.png' or '.pdf'.",
                "errorcode" => "invalid_file_ext"
            );
        }
        else
        {
            // For chunked file uploads, get the current filename and starting position from the incoming headers.
            $name = FancyFileUploaderHelper::GetChunkFilename();
            if ($name !== false) {
                $startpos = FancyFileUploaderHelper::GetFileStartPosition();
            }
            else {
                // [Do stuff with the file here.]
                $tname = explode(".", $files[0]["name"]);
                $tname = $tname[0].".".time().'.'.$files[0]["ext"];

                copy($files[0]["file"], __DIR__ . "/../../public/uploads/financials/" . strtolower($tname));
            }

            $result = array(
                "success" => true,
                "filename" => strtolower($tname),
                "url" => URL . 'uploads/financials/'
            );
        }

        echo json_encode($result, JSON_UNESCAPED_SLASHES);
        exit();
        //}
    }

    public function deleteShelter(){
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["shelter_id"])) {
            $Shelter = new Shelter();
            $shelterinfo = $Shelter->getShelter($_POST["shelter_id"]);
            $result->response = $Shelter->deleteShelter($_POST["shelter_id"]);
            Helper::addLog("delete-shelter", $session['user_id'], $shelterinfo->shelter_name);
        }

        echo json_encode($result);
    }


    public function report($shelter = null)
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $custom_js = URL . "js/shelters.js";
        $State = new State();
        $Animal = new Animal();
        $Shelter = new Shelter();
        $datatables = true;

        $states = $State->getAllStates();
        $animals = $Animal->getAllAnimals();

        $title = "Shelter Report";

        if($shelter != null){
            $shelterInfo = $Shelter->getShelter($shelter);
            $sheltersState = $Shelter->getSheltersByStateID($shelterInfo->states_id);
            $reportData = $this->getShelterReport($shelter);
            $title .= ": " . Helper::getTheCorrectShelterName($shelterInfo->shelter_name);
            $title .= ", " . $State->getStateNameById($shelterInfo->states_id);
        }

        $current_page = "shelter-report";

        require APP . 'view/_templates/header.php';
        require APP . 'view/shelters/report.php';
        require APP . 'view/_templates/footer.php';
    }

    public function checkYearInAnimalData($year, $animalData){
        foreach ($animalData as $data){
            if($data->year == $year)
                return true;
        }

        return false;
    }
}
