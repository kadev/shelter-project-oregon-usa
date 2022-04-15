<?php

namespace Mini\Controller;

use Mini\Libs\Helper;
use Mini\Model\County;
use Mini\Model\Shelter;
use Mini\Model\State;

class RescuesController
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/pages/index
     */
    public function index()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Rescues";
        $current_page = "rescues";
        $Shelter = new Shelter();
        $custom_js = URL."js/shelters.js";
        $datatables = true;

        $rescues = $Shelter->getByTypeOfEntry(3);

        require APP . 'view/_templates/header.php';
        require APP . 'view/rescues/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function getRescuesData(){
        $session = Helper::getSession();
        $Shelter = new Shelter();
        $State = new State();
        $result = array();
        $result['data'] = array();

        $rescues = $Shelter->getByTypeOfEntry(3);

        foreach ($rescues as $shelter){
            $actions = "";
            $stateName = ($shelter->states_id == 0) ? '<span class="badge badge-danger">Not assigned</span>' : $State->getStateNameById($shelter->states_id);
            $temp = array(
                "<a href='".URL."rescues/edit/".$shelter->id."'>".$shelter->id."</a>",
                "<a href='".URL."rescues/edit/".$shelter->id."'>".$shelter->shelter_name."</a>",
                $shelter->street_address,
                $stateName
            );

            $actions .= '<div class="btn-icon-list">';
            if($session['privilege'] == 1 OR $session['privilege'] == 2) {
                $actions .= '<a href="' . URL . 'rescues/edit/' . $shelter->id . '" class="btn ripple btn-info btn-sm"><i class="fe fe-edit"></i></a>';
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


    public function create()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Create";
        $current_page = "create-rescue";

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
        require APP . 'view/rescues/create.php';
        require APP . 'view/_templates/footer.php';
    }

    public function addRescue(){
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_state"])) {
            $params = array();
            parse_str($_POST["data_state"], $params);

            $State = new State();
            $result->response = $State->addState($params);
            $last = Helper::getLastRecord("states");
            Helper::addLog("create-state", $session['user_id'], $last->id);

        }

        echo json_encode($result);
    }

    public function edit($shelter_id)
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Edit state";
        $current_page = "states";
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
        require APP . 'view/rescues/edit.php';
        require APP . 'view/_templates/footer.php';
    }

    public function updateRescue()
    {
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_state"]) AND isset($_POST["state_id"])) {
            $params = array();
            parse_str($_POST["data_state"], $params);
            $State = new State();
            $params['id'] = $_POST["state_id"];
            $result->response = $State->updateState($params);
            Helper::addLog("update-state", $session['user_id'], $_POST["state_id"]);

        }

        echo json_encode($result);
    }

    public function deleteRescue(){
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["state_id"])) {
            $State = new State();
            $stateinfo = $State->getState($_POST["state_id"]);
            $result->response = $State->deleteState($_POST["state_id"]);
            Helper::addLog("delete-state", $session['user_id'], $stateinfo->name);
        }

        echo json_encode($result);
    }
}
