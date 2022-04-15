<?php

/**
 * Class HomeController
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Mini\Controller;
use Mini\Libs\Helper;
use Mini\Model\Animal;
use Mini\Model\AnimalData;
use Mini\Model\Article;
use Mini\Model\Page;
use Mini\Model\Shelter;
use Mini\Model\ShelterUpdates;
use Mini\Model\State;


class HomeController
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        $title = "Log in";

        session_start();

        if (Helper::sessionIsLive()) {
            header('Location: ' . URL . 'home/dashboard');
        } else {
            require APP . 'view/home/index.php';
        }
    }

    /**
     * PAGE: exampleone
     * This method handles what happens when you move to http://yourproject/home/exampleone
     * The camelCase writing is just for better readability. The method name is case-insensitive.
     */
    public function dashboard()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Dashboard";
        $current_page = "dashboard";
        $custom_js = array(
            0 => URL . "plugins/chart.js/Chart.min.js",
            1 => URL . "plugins/peity/jquery.peity.min.js",
            2 => URL . "js/index.js",
            3 => URL . "js/circle-progress.min.js",
            4 => URL . "js/dashboard.js"
        );

        $Shelter = new Shelter();
        $ShelterUpdates = new ShelterUpdates();
        $AnimalData = new AnimalData();
        $Page = new Page();
        $Article = new Article();
        $State = new State();

        $dashboard = new \stdClass();
        $dashboard->totalShelters = $Shelter->getTotalShelters();

        // load views
        require APP . 'view/_templates/header.php';

        if($session['privilege'] == 1 OR $session['privilege'] == 2){
            //For superadmins & adminitrators
            $dashboard->totalPages = $Page->getTotalPages();
            $dashboard->totalArticles = $Article->getTotalArticles();
            $dashboard->lastModifiedShelters = $Shelter->getLastModifiedShelters();
            $dashboard->dataRegistrationAdvance = Helper::AnimalDataRegistrationAdvanced($AnimalData->getAnimalDataByYear(date("Y")), $dashboard->totalShelters);

            require APP . 'view/home/dashboard.php';
        }elseif($session['privilege'] == 3){
            //For Shelter editors
            $dashboard->approvedUpdates = $ShelterUpdates->getQuantityOfApprovedRequest($session['user_id']);
            $dashboard->pendingUpdates = $ShelterUpdates->getQuantityOfPendingRequest($session['user_id']);
            $dashboard->lastModifiedShelters = $ShelterUpdates->getLastUpdatedShelters($session['user_id']);
            $dashboard->dataRegistrationAdvance = Helper::AnimalDataRegistrationAdvanced($AnimalData->getAnimalDataByYear(date("Y")), $dashboard->totalShelters);;

            require APP . 'view/home/editor_dashboard.php';
        }

        require APP . 'view/_templates/footer.php';
    }

    public function getAnimalDataGraph()
    {
        $result = new \stdClass();
        $result->response = false;
        $AnimalData = new AnimalData();
        $currentYear = date("Y");
        $columns = array(
            0 => array("name" => "received", "borderColor" => "#19b159"),
            1 => array("name" => "returned", "borderColor" => "#ebb348"),
            2 => array("name" => "placed", "borderColor" => "#4680ff"),
            3 => array("name" => "transfered", "borderColor" => "#6c757d"),
            4 => array("name" => "euthanized", "borderColor" => "#dc3545"),
            5 => array("name" => "transfered_out", "borderColor" => "#6c757d")
        );

        $result->dataGraph = array();
        $result->years = array();

        foreach ($columns as $column) {
            $dataColumn = new \stdClass();
            $dataColumn->label = $column['name'];
            $dataColumn->data = array();

            for ($i = ($currentYear - 8); $i <= $currentYear; $i++) {
                $animalDataByYear = $AnimalData->getAnimalDataByYear($i);
                $dataYear = 0;

                foreach ($animalDataByYear as $item) {
                    //$dataYear = $item;
                    foreach ($item as $key => $value) {
                        //$dataYear = $key;
                        if ($key == $dataColumn->label) {
                            $dataYear += $value;
                            break;
                        }
                    }
                }

                array_push($dataColumn->data, $dataYear);
            }

            //data: [100, 210, 180, 454, 454, 230, 230,656,656,350,350, 210],

            $dataColumn->borderWidth = 3;
            $dataColumn->backgroundColor = 'transparent';
            $dataColumn->borderColor = $column['borderColor'];
            $dataColumn->pointBackgroundColor = '#ffffff';
            $dataColumn->pointRadius = 0;
            $dataColumn->type = 'line';

            array_push($result->dataGraph, $dataColumn);
        }

        for ($i = ($currentYear - 8); $i <= $currentYear; $i++) {
            array_push($result->years, $i);
        }

        if (!empty($result->dataGraph) and $result->dataGraph != NULL) {
            $result->response = true;
        }

        echo json_encode($result);
    }
}
