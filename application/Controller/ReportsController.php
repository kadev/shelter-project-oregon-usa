<?php

namespace Mini\Controller;

use Mini\Libs\Helper;
use Mini\Model\Animal;
use Mini\Model\AnimalData;
use Mini\Model\DataChart;
use Mini\Model\Shelter;
use Mini\Model\State;
use Mini\Model\Report;

class ReportsController
{
    private $_datachart; private $_shelter; private $_animaldata, $_state, $_report, $_animal;

    function __construct() {
        $this->_datachart = new DataChart();
        $this->_shelter = new Shelter();
        $this->_animal = new Animal();
        $this->_animaldata = new AnimalData();
        $this->_state = new State();
        $this->_report = new Report();
    }

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/pages/index
     */
    public function index()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Reports";
        $current_page = "reports";
        $custom_js = array(
            0 => URL."plugins/jquery-sparkline/jquery.sparkline.min.js",
            1 => URL . "plugins/chart.js/Chart.min.js",
            2 => URL . "plugins/jquery.flot/jquery.flot.js",
            3 => URL . "plugins/jquery.flot/jquery.flot.pie.js",
            4 => URL . "plugins/jquery.flot/jquery.flot.resize.js",
            5 => URL .  "fusioncharts/js/fusioncharts.js",
            6 => URL . "fusioncharts/js/themes/fusioncharts.theme.fint.js",
            7 => URL . "fusioncharts/js/fusioncharts.maps.js",
            8 => URL . "fusioncharts/js/maps/fusioncharts.usa.js",
            9 => URL . "js/reports.js"
        );
        $animal = "animals";

        $statesMostReceived = $this->_datachart->getBykeyname("top-states-with-most-animals-received-2019");
        $statesMostReceivedLastUpdated = ($statesMostReceived) ? date("F j, Y, g:i a", strtotime($statesMostReceived->updated_at)) : false;
        $statesMostReceived = json_decode($statesMostReceived->data);

        $statesMostEuthanized = $this->_datachart->getBykeyname("top-states-with-most-animals-euthanized-2019");
        $statesMostEuthanizedLastUpdated = ($statesMostEuthanized) ? date("F j, Y, g:i a", strtotime($statesMostEuthanized->updated_at)) : false;
        $statesMostEuthanized = json_decode($statesMostEuthanized->data);

        $statesMostReturned = $this->_datachart->getBykeyname("top-states-with-most-animals-returned-2019");
        $statesMostReturnedLastUpdated = ($statesMostReturned) ? date("F j, Y, g:i a", strtotime($statesMostReturned->updated_at)) : false;
        $statesMostReturned = json_decode($statesMostReturned->data);

        $statesMostTransfered = $this->_datachart->getBykeyname("top-states-with-most-animals-transfered-2019");
        $statesMostTransferedLastUpdated = ($statesMostTransfered) ? date("F j, Y, g:i a", strtotime($statesMostTransfered->updated_at)) : false;
        $statesMostTransfered = json_decode($statesMostTransfered->data);

        $statesMostTransferedOut = $this->_datachart->getBykeyname("top-states-with-most-animals-transfered-out-2019");
        $statesMostTransferedOutLastUpdated = ($statesMostTransferedOut) ? date("F j, Y, g:i a", strtotime($statesMostTransferedOut->updated_at)) : false;
        $statesMostTransferedOut = json_decode($statesMostTransferedOut->data);

        $sheltersMostTransfered = $this->_datachart->getBykeyname("top-shelters-with-most-animals-transfered-2019");
        $sheltersMostTransferedLastUpdated = ($sheltersMostTransfered) ? date("F j, Y, g:i a", strtotime($sheltersMostTransfered->updated_at)) : false;
        $sheltersMostTransfered = json_decode($sheltersMostTransfered->data);

        $sheltersMostTransferedOut = $this->_datachart->getBykeyname("top-shelters-with-most-animals-transfered-out-2019");
        $sheltersMostTransferedOutLastUpdated = ($sheltersMostTransferedOut) ? date("F j, Y, g:i a", strtotime($sheltersMostTransferedOut->updated_at)) : false;
        $sheltersMostTransferedOut = json_decode($sheltersMostTransferedOut->data);

        require APP . 'view/_templates/header.php';
        require APP . 'view/reports/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function created(){
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Reports Created";
        $current_page = "reports-created";
        $datatables = true;
        $reports = $this->_report->getAll();

        $custom_js = array(
            0 => URL."js/reports-created.js"
        );

        require APP . 'view/_templates/header.php';
        require APP . 'view/reports/created.php';
        require APP . 'view/_templates/footer.php';
    }

    public function new_report(){
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "New report";
        $current_page = "new-report";
        $states = $this->_state->getAllStates();
        $animals = $this->_animal->getAllAnimals();

        $custom_css = array(
            0 => "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"
        );

        $custom_js = array(
            0 => URL."js/reports-created.js",
            1 => "https://code.jquery.com/ui/1.12.1/jquery-ui.js"
        );

        require APP . 'view/_templates/header.php';
        require APP . 'view/reports/new.php';
        require APP . 'view/_templates/footer.php';
    }

    public function edit($report_id){
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Edit report";
        $current_page = "edit-report";
        $states = $this->_state->getAllStates();
        $report = $this->_report->get($report_id);

        if($report){
            $result = array();
            $shelters = explode(",", $report->shelters);

            foreach ($shelters as $item){
                $shelter = $this->_shelter->getShelter($item);
                if($shelter){
                    array_push($result, $shelter);
                }
            }

            $shelters = (object) $result; unset($result);;

            $custom_css = array(
                0 => "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"
            );

            $custom_js = array(
                0 => URL."js/reports-created.js",
                1 => "https://code.jquery.com/ui/1.12.1/jquery-ui.js"
            );
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/reports/edit.php';
        require APP . 'view/_templates/footer.php';

    }

    public function details($report_id){
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Report Details";
        $current_page = "report-details";

        $report = $this->_report->get($report_id);

        if($report){
            $result = array();
            $shelters = explode(",", $report->shelters);

            foreach ($shelters as $item){
                $shelter = $this->_shelter->getShelter($item);
                if($shelter){
                    array_push($result, $shelter);
                }
            }

            $shelters = (object) $result; unset($result);;

            $custom_css = array(
                0 => "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"
            );

            $custom_js = array(
                0 => "https://code.jquery.com/ui/1.12.1/jquery-ui.js",
                1 => URL . "fusioncharts/js/fusioncharts.js",
                2 => URL . "fusioncharts/js/themes/fusioncharts.theme.fint.js",
                3 => URL . "js/jsPDF/dist/jspdf.min.js",
                4 => URL . "js/html2canvas.min.js",
                5 => URL."js/reports-created.js",
            );
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/reports/report-details.php';
        require APP . 'view/_templates/footer.php';

    }

    public function addReport(){
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_report"])) {
            $params = array();
            parse_str($_POST["data_report"], $params);

            $result->response = $this->_report->create($params, $_POST['shelters']);

            $newreport = Helper::getLastRecord("reports");
            Helper::addLog("create-report", $session['user_id'], $newreport->id);

            $this->generateChartsForReportCreated($newreport->id, "object");
        }

        echo json_encode($result);
    }

    public function updateReport()
    {
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["data_report"]) AND isset($_POST["report_id"])) {
            $params = array();
            parse_str($_POST["data_report"], $params);
            $params['id'] = $_POST["report_id"];
            $result->response = $this->_report->update($params, $_POST['shelters']);
            Helper::addLog("update-report", $session['user_id'], $_POST["report_id"]);
            $this->generateChartsForReportCreated($_POST["report_id"], "object");
        }

        echo json_encode($result);
    }

    public function deleteReport(){
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["report_id"])) {
            $reportInfo = $this->_report->get($_POST["report_id"]);
            $result->response = $this->_report->delete($_POST["report_id"]);
            Helper::addLog("delete-report", $session['user_id'], $reportInfo->title);
        }

        echo json_encode($result);
    }

    public function generateChartsForReportCreated($report_id, $typeOfResponse = "json"){
        if(!$report_id) return false;
        $result = new \stdClass();
        $result->response = false;
        $report = $this->_report->get($report_id);

        if($report->criteria != "all"){
            $report->criteriaLabel = $this->_animal->getAnimal($report->criteria);
            $report->criteriaLabel = strtolower($report->criteriaLabel->name);
        }else{
            $report->criteriaLabel = "all";
        }

        //Chart: All Received Data By Shelters
        $key = $report->criteriaLabel."-received-data-by-shelters-from-report-" . $report->id;
        $chart1 = json_encode($this->getDataForColumnByShelters2('received', $report->criteria, $report->id, "object"));
        $dataChart1 = $this->_datachart->getBykeyname($key);

        if($dataChart1){ $this->_datachart->updateData($dataChart1->id, $chart1); }
        else{ $this->_datachart->add($key, $chart1); }

        //Chart: Criteria Columns Data By Year
        $columns = array(
            0 => "received",
            1 => "returned",
            2 => "placed",
            3 => "transfered",
            4 => "transfered_in_within_area",
            5 => "transfered_in_outside_area",
            6 => "euthanized",
            7 => "transfered_out",
            8 => "transfered_out_within_area",
            9 => "transfered_out_outside_area"
        );

        foreach ($columns as $column){
            $key = $report->criteriaLabel . "-". str_replace("_", "-", $column)."-data-by-year-from-report-" . $report->id;
            $chart2 = json_encode($this->getDataChartForColumn($column, $report->criteria, $report->id, "object"));
            $dataChart2 = $this->_datachart->getBykeyname($key);

            if($dataChart2){ $this->_datachart->updateData($dataChart2->id, $chart2); }
            else{ $this->_datachart->add($key, $chart2); }
        }

        //Table: Shelter Data Details
        $key = "shelters-data-table-".$report->criteriaLabel."-details-from-report-" . $report->id;
        $table1 = json_encode($this->getSheltersDetailsForReport($report->criteria, $report->id, $typeOfReponse = "object"));
        $dataTable1 = $this->_datachart->getBykeyname($key);

        if($dataTable1){ $this->_datachart->updateData($dataTable1->id, $table1); }
        else{ $this->_datachart->add($key, $table1); }

        $result->response = true;

        if($typeOfResponse == "json") echo json_encode($result);
        if($typeOfResponse == "object") return $result;
        return true;
    }

    public function predictive(){
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Predictive Charts";
        $current_page = "predictive-charts";
        $custom_js = array(
            0 => URL."plugins/jquery-sparkline/jquery.sparkline.min.js",
            1 => URL . "plugins/chart.js/Chart.min.js",
            2 => URL . "plugins/jquery.flot/jquery.flot.js",
            3 => URL . "plugins/jquery.flot/jquery.flot.pie.js",
            4 => URL . "plugins/jquery.flot/jquery.flot.resize.js",
            5 => URL .  "fusioncharts/js/fusioncharts.js",
            6 => URL . "fusioncharts/js/themes/fusioncharts.theme.fint.js",
            7 => URL . "fusioncharts/js/fusioncharts.maps.js",
            8 => URL . "fusioncharts/js/maps/fusioncharts.usa.js",
            9 => "//unpkg.com/brain.js",
            10 => URL . "js/predictive-charts.js"
        );

        require APP . 'view/_templates/header.php';
        require APP . 'view/reports/predictive.php';
        require APP . 'view/_templates/footer.php';
    }

    public function animal_report($animal){
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Animal Report";

        if($animal == "dogs") $current_page = "dogs-report";
        if($animal == "cats") $current_page = "cats-report";

        $custom_js = array(
            0 => URL."plugins/jquery-sparkline/jquery.sparkline.min.js",
            1 => URL . "plugins/chart.js/Chart.min.js",
            2 => URL . "plugins/jquery.flot/jquery.flot.js",
            3 => URL . "plugins/jquery.flot/jquery.flot.pie.js",
            4 => URL . "plugins/jquery.flot/jquery.flot.resize.js",
            5 => URL .  "fusioncharts/js/fusioncharts.js",
            6 => URL . "fusioncharts/js/themes/fusioncharts.theme.fint.js",
            7 => URL . "fusioncharts/js/fusioncharts.maps.js",
            8 => URL . "fusioncharts/js/maps/fusioncharts.usa.js",
            9 => "//unpkg.com/brain.js",
            10 => URL . "js/reports.js"
        );

        $statesMostReceived = $this->_datachart->getBykeyname("top-states-with-most-" . $animal . "-received-2019");
        $statesMostReceivedLastUpdated = ($statesMostReceived) ? date("F j, Y, g:i a", strtotime($statesMostReceived->updated_at)) : false;
        $statesMostReceived = ($statesMostReceived) ? json_decode($statesMostReceived->data) : false;

        $statesMostEuthanized = $this->_datachart->getBykeyname("top-states-with-most-" . $animal . "-euthanized-2019");
        $statesMostEuthanizedLastUpdated = ($statesMostEuthanized) ? date("F j, Y, g:i a", strtotime($statesMostEuthanized->updated_at)) : false;
        $statesMostEuthanized = ($statesMostEuthanized) ? json_decode($statesMostEuthanized->data) : false;

        $statesMostReturned = $this->_datachart->getBykeyname("top-states-with-most-" . $animal . "-returned-2019");
        $statesMostReturnedLastUpdated = ($statesMostReturned) ? date("F j, Y, g:i a", strtotime($statesMostReturned->updated_at)) : false;
        $statesMostReturned = ($statesMostReturned) ? json_decode($statesMostReturned->data) : false;

        $statesMostTransfered = $this->_datachart->getBykeyname("top-states-with-most-" . $animal . "-transfered-2019");
        $statesMostTransferedLastUpdated = ($statesMostTransfered) ? date("F j, Y, g:i a", strtotime($statesMostTransfered->updated_at)) : false;
        $statesMostTransfered = ($statesMostTransfered) ? json_decode($statesMostTransfered->data) : false;

        $statesMostTransferedOut = $this->_datachart->getBykeyname("top-states-with-most-" . $animal . "-transfered-out-2019");
        $statesMostTransferedOutLastUpdated = ($statesMostTransferedOut) ? date("F j, Y, g:i a", strtotime($statesMostTransferedOut->updated_at)) : false;
        $statesMostTransferedOut = ($statesMostTransferedOut) ? json_decode($statesMostTransferedOut->data) : false;

        $sheltersMostTransfered = $this->_datachart->getBykeyname("top-shelters-with-most-" . $animal . "-transfered-2019");
        $sheltersMostTransferedLastUpdated = ($sheltersMostTransfered) ? date("F j, Y, g:i a", strtotime($sheltersMostTransfered->updated_at)) : false;
        $sheltersMostTransfered = ($sheltersMostTransfered) ? json_decode($sheltersMostTransfered->data) : false;

        $sheltersMostTransferedOut = $this->_datachart->getBykeyname("top-shelters-with-most-" . $animal . "-transfered-out-2019");
        $sheltersMostTransferedOutLastUpdated = ($sheltersMostTransferedOut) ? date("F j, Y, g:i a", strtotime($sheltersMostTransferedOut->updated_at)) : false;
        $sheltersMostTransferedOut = ($sheltersMostTransferedOut) ? json_decode($sheltersMostTransferedOut->data) : false;

        require APP . 'view/_templates/header.php';
        require APP . 'view/reports/animal-report.php';
        require APP . 'view/_templates/footer.php';
    }

    public function shelters(){
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Shelters Report";
        $current_page = "shelters-report";
        $shelters = $this->_shelter->getAllShelters();
        $sheltersSelected = $this->_datachart->getBykeyname("shelters-selected-for-report");

        if($sheltersSelected){
            if(!empty($sheltersSelected->data)){
                $sheltersSelected = explode(",", $sheltersSelected->data);
            }else{
                $sheltersSelected = array();
            }
        }else{
            $sheltersSelected = array();
        }

        $custom_js = array(
            0 => URL."plugins/jquery-sparkline/jquery.sparkline.min.js",
            1 => URL . "plugins/chart.js/Chart.min.js",
            2 => URL . "plugins/jquery.flot/jquery.flot.js",
            3 => URL . "plugins/jquery.flot/jquery.flot.pie.js",
            4 => URL . "plugins/jquery.flot/jquery.flot.resize.js",
            5 => URL .  "fusioncharts/js/fusioncharts.js",
            6 => URL . "fusioncharts/js/themes/fusioncharts.theme.fint.js",
            7 => URL . "fusioncharts/js/fusioncharts.maps.js",
            8 => URL . "fusioncharts/js/maps/fusioncharts.usa.js",
            9 => "//unpkg.com/brain.js",
            10 => URL . "js/reports.js"
        );

        require APP . 'view/_templates/header.php';
        require APP . 'view/reports/shelters-report.php';
        require APP . 'view/_templates/footer.php';
    }

    public function sheltersv2(){
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Shelters Report v2";
        $current_page = "shelters-report";
        $shelters = $this->_shelter->getAllShelters();
        $states = $this->_state->getAllStates();
        $sheltersSelected = $this->_datachart->getBykeyname("shelters-selected-for-report");
        $countSelectedShelters = 0;
        $datatables = true;

        if($sheltersSelected){
            if(!empty($sheltersSelected->data)){
                $result = array();
                $sheltersSelected = explode(",", $sheltersSelected->data);
                $countSelectedShelters = count($sheltersSelected);

                foreach ($sheltersSelected as $item){
                    $shelter = $this->_shelter->getShelter($item);
                    array_push($result, $shelter);
                }

                $sheltersSelected = (object) $result;

            }else{
                $sheltersSelected = array();
            }
        }else{
            $sheltersSelected = array();
        }

        $custom_css = array(
            0 => "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"
        );

        $custom_js = array(
            0 => URL."plugins/jquery-sparkline/jquery.sparkline.min.js",
            1 => URL . "plugins/chart.js/Chart.min.js",
            2 => URL . "plugins/jquery.flot/jquery.flot.js",
            3 => URL . "plugins/jquery.flot/jquery.flot.pie.js",
            4 => URL . "plugins/jquery.flot/jquery.flot.resize.js",
            5 => URL .  "fusioncharts/js/fusioncharts.js",
            6 => URL . "fusioncharts/js/themes/fusioncharts.theme.fint.js",
            7 => URL . "fusioncharts/js/fusioncharts.maps.js",
            8 => URL . "fusioncharts/js/maps/fusioncharts.usa.js",
            9 => "https://code.jquery.com/ui/1.12.1/jquery-ui.js",
            10 => URL . "js/shelters-report.js"

        );

        require APP . 'view/_templates/header.php';
        require APP . 'view/reports/shelters-report-v2.php';
        require APP . 'view/_templates/footer.php';
    }

    public function sheltersv3(){
        Helper::verifyUserSession();

        $session = Helper::getSession();
        $title = "Shelters Report v3";
        $current_page = "shelters-report";
        $shelters = $this->_shelter->getAllShelters();
        $states = $this->_state->getAllStates();
        $sheltersSelected = $this->_datachart->getBykeyname("shelters-selected-for-report");
        $countSelectedShelters = 0;

        if($sheltersSelected){
            if(!empty($sheltersSelected->data)){
                $result = array();
                $sheltersSelected = explode(",", $sheltersSelected->data);
                $countSelectedShelters = count($sheltersSelected);

                foreach ($sheltersSelected as $item){
                    $shelter = $this->_shelter->getShelter($item);
                    array_push($result, $shelter);
                }

                $sheltersSelected = (object) $result;

            }else{
                $sheltersSelected = array();
            }
        }else{
            $sheltersSelected = array();
        }

        $custom_css = array(
            0 => "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"
        );

        $custom_js = array(
            0 => URL."plugins/jquery-sparkline/jquery.sparkline.min.js",
            1 => URL . "plugins/chart.js/Chart.min.js",
            2 => URL . "plugins/jquery.flot/jquery.flot.js",
            3 => URL . "plugins/jquery.flot/jquery.flot.pie.js",
            4 => URL . "plugins/jquery.flot/jquery.flot.resize.js",
            5 => URL .  "fusioncharts/js/fusioncharts.js",
            6 => URL . "fusioncharts/js/themes/fusioncharts.theme.fint.js",
            7 => URL . "fusioncharts/js/fusioncharts.maps.js",
            8 => URL . "fusioncharts/js/maps/fusioncharts.usa.js",
            9 => "https://code.jquery.com/ui/1.12.1/jquery-ui.js",
            10 => URL . "js/shelters-report.js"
        );

        require APP . 'view/_templates/header.php';
        require APP . 'view/reports/shelters-report-v3.php';
        require APP . 'view/_templates/footer.php';
    }

    public function saveSelectedShelterForReportSection(){
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["shelters"])) {
            $sheltersSelectedForReport = $this->_datachart->getBykeyname("shelters-selected-for-report");

            if($sheltersSelectedForReport){
                $result->response = $this->_datachart->updateData($sheltersSelectedForReport->id, $_POST["shelters"]);
            }else{
                $result->response = $this->_datachart->add("shelters-selected-for-report", $_POST["shelters"]);
            }
        }

        echo json_encode($result);
    }

    public function percentageOfSheltersByType(){
        $response = new \stdClass();
        $result = array();
        $types = array(
            0 => "Shelters",
            1 => "Maddie's Fund",
            2 => "State Totals"
        );

        $sheltersSelected = $this->_datachart->getBykeyname("shelters-selected-for-report");

        if($sheltersSelected){
            if(!empty($sheltersSelected->data)){
                foreach ($types as $key => $value){
                    $shelters = $this->_shelter->getSheltersByTypeOfEntry($key, $sheltersSelected->data);
                    $temp = array(
                        "label" => $value,
                        "value" => count($shelters)
                    );

                    array_push($result, $temp);
                }
            }else{
                $result = false;
            }

        }else{
            $result = false;
        }

        $response->dataGraph = $result;
        $response->response = true;
        echo json_encode($response);
    }

    public function animalDataGraph(){
        $result = new \stdClass();
        $response = new \stdClass();
        $response->response = false;
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

        $sheltersSelected = $this->_datachart->getBykeyname("shelters-selected-for-report");

        if($sheltersSelected){
            if(!empty($sheltersSelected->data)){
                foreach ($columns as $column) {
                    $dataColumn = new \stdClass();
                    $dataColumn->label = $column['name'];
                    $dataColumn->data = array();

                    for ($i = ($currentYear - 8); $i <= $currentYear; $i++) {
                        $animalDataByYear = $this->_animaldata->getAnimalDataByYear($i, $sheltersSelected->data);
                        $dataYear = 0;

                        foreach ($animalDataByYear as $item) {
                            foreach ($item as $key => $value) {
                                if ($key == $dataColumn->label) {
                                    $dataYear += $value;
                                    break;
                                }
                            }
                        }

                        array_push($dataColumn->data, $dataYear);
                    }

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
            }else{
                $result = false;
            }
        }else{
            $result = false;
        }

        $response->dataGraph = $result;
        $response->response = true;

        echo json_encode($response);
    }

    public function animalDataGraph2(){
        $result = new \stdClass();
        $response = new \stdClass();
        $response->response = false;
        $currentYear = date("Y");
        $table = "<tbody>";

        $columns = array(
            0 => array("name" => "received", "borderColor" => "#19b159"),
            1 => array("name" => "returned", "borderColor" => "#ebb348"),
            2 => array("name" => "placed", "borderColor" => "#4680ff"),
            3 => array("name" => "transfered", "borderColor" => "#6c757d"),
            4 => array("name" => "euthanized", "borderColor" => "#dc3545"),
            5 => array("name" => "transfered_out", "borderColor" => "#6c757d")
        );

        $result->dataset = array();
        $result->categories = array();
        $result->categories[0]['category'] = array();

        $sheltersSelected = $this->_datachart->getBykeyname("shelters-selected-for-report");

        if($sheltersSelected){
            if(!empty($sheltersSelected->data)){
                foreach ($columns as $column) {
                    $dataColumn = new \stdClass();
                    $dataColumn->seriesname = $column['name'];
                    $dataColumn->data = array();

                    for ($i = ($currentYear - 9); $i <= $currentYear; $i++) {
                        $animalDataByYear = $this->_animaldata->getAnimalDataByYear($i, $sheltersSelected->data);
                        $resultYear = array();
                        $resultYear['value'] = 0;

                        foreach ($animalDataByYear as $item) {
                            foreach ($item as $key => $value) {
                                if ($key == $column['name']) {
                                    $resultYear['value'] = $resultYear['value'] + $value;
                                    break;
                                }
                            }
                        }

                        array_push($dataColumn->data, $resultYear);
                    }

                    array_push($result->dataset, $dataColumn);
                }

                for ($i = ($currentYear - 9); $i <= $currentYear; $i++) {
                    $resultCategory = array();
                    $resultCategory['label'] = "$i";
                    array_push($result->categories[0]['category'], $resultCategory);
                }

                if (!empty($result->dataset) and $result->dataset != NULL) {
                    $result->response = true;
                }
            }else{
                $result = false;
            }
        }else{
            $result = false;
        }

        $response->data = $result;
        $response->response = true;

        echo json_encode($response);
    }

    public function getDataForColumnByShelters($column){
        $result = new \stdClass();
        $response = new \stdClass();
        $response->response = false;
        $currentYear = date("Y");


        $result->dataset = array();
        $result->categories = array();
        $result->categories[0]['category'] = array();

        $sheltersSelected = $this->_datachart->getBykeyname("shelters-selected-for-report");

        if($sheltersSelected){
            if(!empty($sheltersSelected->data)){
                $sheltersSelected = explode(",", $sheltersSelected->data);

                foreach ($sheltersSelected as $item){
                    $shelter = $this->_shelter->getShelter($item);
                    $dataColumn = new \stdClass();
                    $dataColumn->seriesname = $shelter->shelter_name;
                    $dataColumn->data = array();

                    for ($i = ($currentYear - 9); $i <= $currentYear; $i++) {
                        $animalDataByYear = $this->_animaldata->getAnimalDataByShelterAndYear($shelter->id, $i);
                        $resultYear = array();
                        $resultYear['value'] = 0;

                        foreach ($animalDataByYear as $item) {
                            foreach ($item as $key => $value) {
                                if ($key == $column) {
                                    $resultYear['value'] = $resultYear['value'] + $value;
                                    break;
                                }
                            }
                        }

                        array_push($dataColumn->data, $resultYear);
                    }

                    array_push($result->dataset, $dataColumn);
                }


                for ($i = ($currentYear - 9); $i <= $currentYear; $i++) {
                    $resultCategory = array();
                    $resultCategory['label'] = "$i";
                    array_push($result->categories[0]['category'], $resultCategory);
                }

                if (!empty($result->dataset) and $result->dataset != NULL) {
                    $result->response = true;
                }
            }else{
                $result = false;
            }
        }else{
            $result = false;
        }

        $response->data = $result;
        $response->response = true;

        echo json_encode($response);
    }

    public function getDataForColumnByShelters2($column, $criteria = "all", $report_id = null, $typeOfReponse = "json"){
        $result = new \stdClass();
        $response = new \stdClass();
        $response->response = false;
        $currentYear = date("Y");

        $result->dataset = array();
        $result->categories = array();
        $result->categories[0]['category'] = array();

        if($report_id == null){
            $sheltersSelected = $this->_datachart->getBykeyname("shelters-selected-for-report");
            $from = $currentYear - 9;
            $to = $currentYear;
        }else{
            $reportData = $this->_report->get($report_id);
            $sheltersSelected = new \stdClass();
            $sheltersSelected->data = $reportData->shelters;
            $from = $reportData->from_year;
            $to = $reportData->to_year;
        }


        if($sheltersSelected){
            if(!empty($sheltersSelected->data)){
                $sheltersSelected = explode(",", $sheltersSelected->data);

                foreach ($sheltersSelected as $item){
                    $shelter = $this->_shelter->getShelter($item);
                    $dataColumn = new \stdClass();
                    $dataColumn->seriesname = $shelter->shelter_name;
                    $dataColumn->data = array();

                    for ($i = $from; $i <= $to; $i++) {
                        $noData = $this->_animaldata->getShelterNoDataByShelterAndYear($shelter->id, $i);
                        $resultYear = array();
                        $resultYear['value'] = "";

                        if(!$noData){
                            $noData = new \stdClass();
                            $noData->status = 0;
                        }

                        if($noData->status == 0){
                            if($criteria == "all"){
                                $totalColumn = $this->_animaldata->getTotalAnimalDataShelterByColumnAndYear($shelter->id, $column, $i);
                            }else{
                                $totalColumn = $this->_animaldata->getShelterCriteriaTotalByColumnAndYear($shelter->id, $criteria, $column, $i);
                            }

                            if($totalColumn){
                                $resultYear['value'] = $totalColumn->total;
                            }

                            //$resultYear['value'] = ($totalColumn->total != NULL) ? $totalColumn->total : 0;
                        }

                        array_push($dataColumn->data, $resultYear);
                    }

                    array_push($result->dataset, $dataColumn);
                }

                for ($i = $from; $i <= $to; $i++) {
                    $resultCategory = array();
                    $resultCategory['label'] = "$i";

                    array_push($result->categories[0]['category'], $resultCategory);
                }

                if (!empty($result->dataset) and $result->dataset != NULL) {
                    $result->response = true;
                }
            }else{
                $result = false;
            }
        }else{
            $result = false;
        }

        $response->data = $result;
        $response->response = true;

        if($typeOfReponse == "json") echo json_encode($response);
        if($typeOfReponse == "object") return $response->data;
    }

    public function getDataChartForColumn($column, $criteria = "all", $report_id = null, $typeOfReponse = "json"){
        $result = new \stdClass();
        $response = new \stdClass();
        $response->response = false;
        $currentYear = date("Y");

        $result = array();

        if($report_id == null){
            $sheltersSelected = $this->_datachart->getBykeyname("shelters-selected-for-report");
            $from = $currentYear - 9;
            $to = $currentYear;
        }else{
            $reportData = $this->_report->get($report_id);
            $sheltersSelected = new \stdClass();
            $sheltersSelected->data = $reportData->shelters;
            $from = $reportData->from_year;
            $to = $reportData->to_year;
        }

        if($sheltersSelected){
            if(!empty($sheltersSelected->data)){

                for ($i = $from; $i <= $to; $i++) {
                    if($criteria == "all"){
                        $animalDataByYear = $this->_animaldata->getAnimalDataByYear($i, $sheltersSelected->data);
                    }else{
                        $animalDataByYear = $this->_animaldata->getCriteriaDataByYear($criteria, $i, $sheltersSelected->data);
                    }

                    $resultYear = array();
                    $resultYear['label'] = "$i";
                    $resultYear['value'] = "";
                    $helperResult = 0;

                    foreach ($animalDataByYear as $item) {
                        $noData = $this->_animaldata->getShelterNoDataByShelterAndYear($item->shelter_id, $i);

                        if(!$noData){
                            $noData = new \stdClass();
                            $noData->status = 0;
                        }

                        if($noData->status == 0){
                            foreach ($item as $key => $value) {
                                if ($key == $column) {
                                    if($resultYear)
                                        $helperResult = (is_numeric($value)) ? $helperResult + $value : $helperResult;
                                    break;
                                }
                            }
                        }
                    }

                    if($helperResult != 0) $resultYear['value'] = $helperResult;

                    array_push($result, $resultYear);
                }
            }else{
                $result = false;
            }
        }else{
            $result = false;
        }

        $response->data = $result;
        $response->response = true;

        if($typeOfReponse == 'json') echo json_encode($response);
        if($typeOfReponse == 'object') return $response->data;
    }

    public function getSheltersByState(){
        $result = new \stdClass();
        $result->response = false;

        if(!empty($_POST['state'])){
            $result->shelters = $this->_shelter->getSheltersByStateID($_POST['state']);
            $result->response = true;
        }

        echo json_encode($result);
    }

    public function getSheltersDetailsForReport($criteria = "all", $report_id = null, $typeOfReponse = "json"){
        $result = new \stdClass();
        $response = new \stdClass();
        $response->response = false;
        $currentYear = date("Y");
        $table = "<tbody>";

        if($report_id == null){
            $sheltersSelected = $this->_datachart->getBykeyname("shelters-selected-for-report");
            $from = $currentYear - 4;
            $to = $currentYear;
        }else{
            $sheltersSelected = new \stdClass();
            $reportData = $this->_report->get($report_id);
            $sheltersSelected->data = $reportData->shelters;
            $from = $reportData->from_year;
            $to = $reportData->to_year;
        }


        if($sheltersSelected){
            if(!empty($sheltersSelected->data)){
                $sheltersSelected = explode(",", $sheltersSelected->data);

                foreach ($sheltersSelected as $item){
                    $shelter = $this->_shelter->getShelter($item);
                    $dataColumn = new \stdClass();
                    $dataColumn->data = array();
                    $table .= '<tr><td colspan="7" style="background-color: #f6f8ff; font-weight: 500;">'.$shelter->shelter_name.'</td></tr>';

                    for ($i = $from; $i <= $to; $i++) {
                        if($criteria == "all"){
                            $animalData = $this->_animaldata->getAnimalDataByShelterAndYear($shelter->id, $i);
                        }else{
                            $animalData = $this->_animaldata->getCriteriaDataByShelterAndYear($criteria, $shelter->id, $i);
                        }

                        $resultYear = array();
                        $table .= '<tr><td style="background-color: #f6f8ff; font-weight: 500;">'.$i.'</td>';

                        $totals = array("received" => 0, "returned" => 0, "placed" => 0,
                            "transfered" => 0, "euthanized" => 0, "transfered_out" => 0);

                        foreach ($animalData as $data){
                            $totals['received'] += ($data->received != NULL) ? $data->received : 0;
                            $totals['returned'] += ($data->returned != NULL) ? $data->returned : 0;
                            $totals['placed'] += ($data->placed != NULL) ? $data->placed : 0;
                            $totals['transfered'] += ($data->transfered != NULL) ? $data->transfered : 0;
                            $totals['euthanized'] += ($data->euthanized != NULL) ? $data->euthanized : 0;
                            $totals['transfered_out'] += ($data->transfered_out != NULL) ? $data->transfered_out : 0;
                        }

                        foreach ($totals as $total){
                            $table .= '<td>' . $total . '</td>';
                        }

                        $table .= '</tr>';
                    }
                }

            }else{
                $table = false;
            }
        }else{
            $table = false;
        }

        $table .= '</tbody>';
        $response->table = $table;
        $response->response = true;

        if($typeOfReponse == "json") echo json_encode($response);
        if($typeOfReponse == "object") return $response->table;
    }
}
