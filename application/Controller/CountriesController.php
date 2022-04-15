<?php

namespace Mini\Controller;

use Mini\Libs\Helper;
use Mini\Model\Country;

class CountriesController
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/pages/index
     */
    public function index()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Countries";
        $current_page = "countries";
        $Country = new Country();
        $custom_js = URL."js/countries.js";
        $datatables = true;

        $countries = $Country->getAllCountries();

        require APP . 'view/_templates/header.php';
        require APP . 'view/countries/index.php';
        require APP . 'view/_templates/footer.php';
    }


    public function create()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Create country";
        $current_page = "countries";
        $custom_js = array(
            0 => URL . "js/countries.js"
        );

        require APP . 'view/_templates/header.php';
        require APP . 'view/countries/create.php';
        require APP . 'view/_templates/footer.php';
    }

    public function addCountry()
    {
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_country"])) {
            $params = array();
            parse_str($_POST["data_country"], $params);

            $Country = new Country();
            $result->response = $Country->addCountry($params);
            $last = Helper::getLastRecord("countries");
            Helper::addLog("create-country", $session['user_id'], $last->id);
        }

        echo json_encode($result);
    }

    public function edit($country_id)
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Edit country";
        $current_page = "countries";
        $custom_js = array(
            0 => URL . "js/countries.js"
        );
        $Country = new Country();
        $country = $Country->getCountry($country_id);

        require APP . 'view/_templates/header.php';
        require APP . 'view/countries/edit.php';
        require APP . 'view/_templates/footer.php';
    }

    public function updateCountry()
    {
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_country"]) and isset($_POST["country_id"])) {
            $params = array();
            parse_str($_POST["data_country"], $params);
            $Country = new Country();
            $params['id'] = $_POST["country_id"];
            $result->response = $Country->updateCountry($params);
            Helper::addLog("update-country", $session['user_id'], $_POST["country_id"]);
        }

        echo json_encode($result);
    }

    public function deleteCountry()
    {
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["country_id"])) {
            $Country = new Country();
            $countryInfo = $Country->getCountry($_POST["country_id"]);
            $result->response = $Country->deleteCountry($_POST["country_id"]);
            Helper::addLog("delete-country", $session['user_id'], $countryInfo->name);
        }

        echo json_encode($result);
    }
}