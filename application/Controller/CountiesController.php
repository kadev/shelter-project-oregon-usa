<?php

namespace Mini\Controller;

use Mini\Libs\Helper;
use Mini\Model\County;
use Mini\Model\State;

class CountiesController
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/pages/index
     */
    public function index()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Counties";
        $current_page = "counties";
        $County = new County();
        $custom_js = URL."js/counties.js";
        $datatables = true;

        $counties = $County->getAllCounties();

        require APP . 'view/_templates/header.php';
        require APP . 'view/counties/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function getCountiesData(){
        $session = Helper::getSession();
        $County = new County();
        $State = new State();
        $result = array();
        $result['data'] = array();

        $counties = $County->getAllCounties();

        foreach ($counties as $county){
            $actions = "";
            $temp = array(
                "<a href='".URL."counties/edit/".$county->CountyID."'>".$county->CountyID."</a>",
                "<a href='".URL."counties/edit/".$county->CountyID."'>".$county->Name."</a>",
                $county->StateAbbreviation
            );

            $actions .= '<div class="btn-icon-list">';
            $actions .= '<a href="' . URL . 'counties/edit/' . $county->CountyID . '" class="btn ripple btn-info btn-sm"><i class="fe fe-edit"></i></a>';
            $actions .= '<span data-county="' . $county->CountyID . '" class="btn ripple btn-danger btn-sm delete-county"><i class="fe fe-trash"></i></span>';
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
        $title = "Create county";
        $current_page = "counties";
        $custom_js = array(
            0 => URL . "js/counties.js"
        );

        $State = new State();

        $states = $State->getAllStates();

        require APP . 'view/_templates/header.php';
        require APP . 'view/counties/create.php';
        require APP . 'view/_templates/footer.php';
    }

    public function addCounty()
    {
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_county"])) {
            $params = array();
            parse_str($_POST["data_county"], $params);

            $County = new County();
            $State = new State();

            $state = $State->getState($params['state-id']);

            if(!empty($state) OR $state != false){
                $params['state-code'] = $state->short_name;
                $result->response = $County->add($params);
                $last = Helper::getLastRecord("counties");
                Helper::addLog("create-county", $session['user_id'], $last->CountyID);
            }
        }

        echo json_encode($result);
    }

    public function edit($county_id)
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Edit county";
        $current_page = "counties";
        $custom_js = array(
            0 => URL . "js/counties.js"
        );

        $State = new State();
        $states = $State->getAllStates();

        $County = new County();
        $county = $County->getCounty($county_id);

        require APP . 'view/_templates/header.php';
        require APP . 'view/counties/edit.php';
        require APP . 'view/_templates/footer.php';
    }

    public function updateCounty()
    {
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_county"]) and isset($_POST["county_id"])) {
            $params = array();
            parse_str($_POST["data_county"], $params);
            $County = new County();
            $State = new State();

            $state = $State->getState($params["state-id"]);
            $params['id'] = $_POST["county_id"];
            $params['state-code'] = $state->short_name;
            $result->response = $County->updateCounty($params);

            Helper::addLog("update-county", $session['user_id'], $_POST["county_id"]);
        }

        echo json_encode($result);
    }

    public function deleteCounty()
    {
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["county_id"])) {
            $County = new County();
            $countyInfo = $County->getCounty($_POST["county_id"]);
            $result->response = $County->deleteCounty($_POST["county_id"]);
            Helper::addLog("delete-county", $session['user_id'], $countyInfo->Name);
        }

        echo json_encode($result);
    }
}