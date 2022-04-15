<?php

namespace Mini\Controller;

use Mini\Libs\Helper;
use Mini\Model\State;

class StatesController
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/pages/index
     */
    public function index()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "States";
        $current_page = "states";
        $State = new State();
        $custom_js = URL."js/states.js";
        $datatables = true;

        $states = $State->getAllStates();

        require APP . 'view/_templates/header.php';
        require APP . 'view/states/index.php';
        require APP . 'view/_templates/footer.php';
    }


    public function create()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Create";
        $current_page = "states";
        $custom_js = array(
            0 => URL."js/states.js"
        );

        require APP . 'view/_templates/header.php';
        require APP . 'view/states/create.php';
        require APP . 'view/_templates/footer.php';
    }

    public function addState(){
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

    public function edit($state_id)
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Edit state";
        $current_page = "states";
        $custom_js = array(
            0 => URL."js/states.js"
        );
        $State = new State();
        $state = $State->getState($state_id);

        require APP . 'view/_templates/header.php';
        require APP . 'view/states/edit.php';
        require APP . 'view/_templates/footer.php';
    }

    public function updateState()
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

    public function deleteState(){
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
