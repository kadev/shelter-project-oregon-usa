<?php

namespace Mini\Controller;

//use Mini\Libs\FancyFileUploaderHelper;
use Mini\Libs\Helper;
use Mini\Model\Animal;
use Mini\Model\AnimalData;
use Mini\Model\DataChart;
use Mini\Model\Shelter;
use Mini\Model\State;

use Phpml\Regression\LeastSquares;
use Phpml\Regression\SVR;
use Phpml\SupportVectorMachine\Kernel;

class DataChartsController
{
    private $_animaldata, $_datachart, $_state, $_shelter, $_animal;

    function __construct() {
        $this->_animaldata = new AnimalData();
        $this->_datachart = new DataChart();
        $this->_state = new State();
        $this->_shelter = new Shelter();
        $this->_animal = new Animal();
    }

    public function index()
    {
        Helper::verifyUserSession();

        $session = Helper::getSession();

        header("Location: ".URL);
    }

    public function getDataChart($keyname){
        Helper::verifyUserSession();
        $session = Helper::getSession();
        $result = new \stdClass();
        $result->response = false;

        $dataChart = $this->_datachart->getBykeyname($keyname);

        if($dataChart){
            $result->response = true;
            $result->dataGraph = json_decode($dataChart->data);
            if($dataChart->updated_at OR $dataChart->updated_at != '0000-00-00 00:00:00'){
                $result->last_updated = date("F j, Y, g:i a", strtotime($dataChart->updated_at));
            }else{
                $result->last_updated = date("F j, Y, g:i a", strtotime($dataChart->created_at));
            }
        }

        echo json_encode($result);
    }

    public function saveAnimalDataGraph($animal = null){
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

        foreach ($columns as $column) {
            $dataColumn = new \stdClass();
            $dataColumn->label = $column['name'];
            $dataColumn->data = array();

            for ($i = ($currentYear - 8); $i <= ($currentYear-1); $i++) {
                if($animal == null){
                    $animalDataByYear = $this->_animaldata->getAnimalDataByYear($i);
                }else{
                    $animalInfo = $this->_animal->getAnimalByName(ucfirst($animal));
                    $animalDataByYear = $this->_animaldata->getAnimalDataByYearAndAnimalID($i, $animalInfo->id);
                }

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

        for ($i = ($currentYear - 8); $i <= ($currentYear-1); $i++) {
            array_push($result->years, $i);
        }

        if (!empty($result->dataGraph) and $result->dataGraph != NULL) {
            $result->response = true;
        }

        if($animal == null) $dataChart = $this->_datachart->getBykeyname("animal-data-graph");
        if($animal != null) $dataChart = $this->_datachart->getBykeyname("animal-data-graph-".$animal);

        $resultJSON = json_encode($result);

        if($dataChart){
            $this->_datachart->updateData($dataChart->id, $resultJSON);
            $response->response = true;
        }else{
            if($animal == null) $this->_datachart->add("animal-data-graph", $resultJSON);
            if($animal != null) $this->_datachart->add("animal-data-graph-".$animal, $resultJSON);
            $response->response = true;
        }

        echo json_encode($response);
    }

    public function saveTopStatesWithMostAnimalsReceived($animal = "animals", $year = 2019){
        $response = new \stdClass();
        if($animal == "animals"){
            $data = $this->_animaldata->getAnimalDataByYear($year);
        }else{
            $animalInfo = $this->_animal->getAnimalByName(ucfirst($animal));
            $data = $this->_animaldata->getAnimalDataByYearAndAnimalID($year, $animalInfo->id);
        }

        $states = $this->_state->getAllStates();
        $resultStates = array();
        $resultStatesTotals = array();

        foreach ($states as $state){
            $stateTotal = $this->_shelter->getStateTotal($state->id);

            if($stateTotal){
                $resultStatesTotals[$state->id] = 0;

                if($animal == "animals"){
                    $stateTotalData = $this->_animaldata->getAnimalDataByShelterAndYear($stateTotal->id, $year);

                    foreach ($stateTotalData as $item){
                        $itemShelter = $this->_shelter->getShelter($item->shelter_id);
                        $resultStatesTotals[$state->id] = $resultStatesTotals[$state->id] + $item->received;
                    }
                }else{
                    $stateTotalData = $this->_animaldata->getAnimalDataByShelterYearAndAnimalID($stateTotal->id, $year, $animalInfo->id);
                    if($stateTotalData){
                        $resultStatesTotals[$state->id] = $resultStatesTotals[$state->id] + $stateTotalData->received;
                    }
                }
            }else{
                $resultStates[$state->id] = 0;
            }
        }

        foreach ($data as $item){
            $itemShelter = $this->_shelter->getShelter($item->shelter_id);

            if($itemShelter){
                if (array_key_exists($itemShelter->states_id,$resultStates)){
                    $resultStates[$itemShelter->states_id] = $resultStates[$itemShelter->states_id] + $item->received;
                }
            }
        }

        $resultStates = array_merge($resultStates, $resultStatesTotals);
        arsort($resultStates, SORT_REGULAR);

        //var_dump($resultStates); echo "<br><br>"; var_dump($resultStatesTotals); exit();

        $dataChart = $this->_datachart->getBykeyname("top-states-with-most-". $animal ."-received-".$year);
        $result = json_encode($resultStates);

        if($dataChart){
            $this->_datachart->updateData($dataChart->id, $result);
        }else{
            $this->_datachart->add("top-states-with-most-". $animal ."-received-".$year, $result);
        }

        $response->response = true;
        echo json_encode($response);
    }

    public function saveTopStatesWithMostAnimalsEuthanized($animal = "animals", $year = 2019){
        $response = new \stdClass();

        if($animal == "animals"){
            $data = $this->_animaldata->getAnimalDataByYear($year);
        }else{
            $animalInfo = $this->_animal->getAnimalByName(ucfirst($animal));
            $data = $this->_animaldata->getAnimalDataByYearAndAnimalID($year, $animalInfo->id);
        }

        $states = $this->_state->getAllStates();
        $resultStates = array();
        $resultStatesTotals = array();

        foreach ($states as $state){
            $stateTotal = $this->_shelter->getStateTotal($state->id);

            if($stateTotal){
                $resultStatesTotals[$state->id] = 0;

                if($animal == "animals"){
                    $stateTotalData = $this->_animaldata->getAnimalDataByShelterAndYear($stateTotal->id, $year);

                    foreach ($stateTotalData as $item){
                        $itemShelter = $this->_shelter->getShelter($item->shelter_id);
                        $resultStatesTotals[$state->id] = $resultStatesTotals[$state->id] + $item->euthanized;
                    }
                }else{
                    $stateTotalData = $this->_animaldata->getAnimalDataByShelterYearAndAnimalID($stateTotal->id, $year, $animalInfo->id);
                    if($stateTotalData){
                        $resultStatesTotals[$state->id] = $resultStatesTotals[$state->id] + $stateTotalData->euthanized;
                    }
                }
            }else{
                $resultStates[$state->id] = 0;
            }
        }

        foreach ($data as $item){
            $itemShelter = $this->_shelter->getShelter($item->shelter_id);

            if($itemShelter){
                if (array_key_exists($itemShelter->states_id,$resultStates)){
                    $resultStates[$itemShelter->states_id] = $resultStates[$itemShelter->states_id] + $item->euthanized;
                }
            }
        }

        $resultStates = array_merge($resultStates, $resultStatesTotals);
        arsort($resultStates, SORT_REGULAR);

        $dataChart = $this->_datachart->getBykeyname("top-states-with-most-". $animal ."-euthanized-".$year);
        $result = json_encode($resultStates);

        if($dataChart){
            $this->_datachart->updateData($dataChart->id, $result);
        }else{
            $this->_datachart->add("top-states-with-most-". $animal ."-euthanized-".$year, $result);
        }

        $response->response = true;
        echo json_encode($response);
    }

    public function saveTopStatesWithMostAnimalsReturned($animal = "animals", $year = 2019){
        $response = new \stdClass();

        if($animal == "animals"){
            $data = $this->_animaldata->getAnimalDataByYear($year);
        }else{
            $animalInfo = $this->_animal->getAnimalByName(ucfirst($animal));
            $data = $this->_animaldata->getAnimalDataByYearAndAnimalID($year, $animalInfo->id);
        }

        $states = $this->_state->getAllStates();
        $resultStates = array();
        $resultStatesTotals = array();

        foreach ($states as $state){
            $stateTotal = $this->_shelter->getStateTotal($state->id);

            if($stateTotal){
                $resultStatesTotals[$state->id] = 0;

                if($animal == "animals"){
                    $stateTotalData = $this->_animaldata->getAnimalDataByShelterAndYear($stateTotal->id, $year);

                    foreach ($stateTotalData as $item){
                        $itemShelter = $this->_shelter->getShelter($item->shelter_id);
                        $resultStatesTotals[$state->id] = $resultStatesTotals[$state->id] + $item->returned;
                    }
                }else{
                    $stateTotalData = $this->_animaldata->getAnimalDataByShelterYearAndAnimalID($stateTotal->id, $year, $animalInfo->id);
                    if($stateTotalData){
                        $resultStatesTotals[$state->id] = $resultStatesTotals[$state->id] + $stateTotalData->returned;
                    }
                }
            }else{
                $resultStates[$state->id] = 0;
            }
        }

        foreach ($data as $item){
            $itemShelter = $this->_shelter->getShelter($item->shelter_id);

            if($itemShelter){
                if (array_key_exists($itemShelter->states_id,$resultStates)){
                    $resultStates[$itemShelter->states_id] = $resultStates[$itemShelter->states_id] + $item->returned;
                }
            }
        }

        $resultStates = array_merge($resultStates, $resultStatesTotals);
        arsort($resultStates, SORT_REGULAR);

        $dataChart = $this->_datachart->getBykeyname("top-states-with-most-". $animal ."-returned-".$year);
        $result = json_encode($resultStates);

        if($dataChart){
            $this->_datachart->updateData($dataChart->id, $result);
        }else{
            $this->_datachart->add("top-states-with-most-". $animal ."-returned-".$year, $result);
        }

        $response->response = true;
        echo json_encode($response);
    }

    public function saveTopStatesWithMostAnimalsTransfered($animal = "animals", $year = 2019){
        $response = new \stdClass();
        if($animal == "animals"){
            $data = $this->_animaldata->getAnimalDataByYear($year);
        }else{
            $animalInfo = $this->_animal->getAnimalByName(ucfirst($animal));
            $data = $this->_animaldata->getAnimalDataByYearAndAnimalID($year, $animalInfo->id);
        }

        $states = $this->_state->getAllStates();
        $resultStates = array();
        $resultStatesTotals = array();

        foreach ($states as $state){
            $stateTotal = $this->_shelter->getStateTotal($state->id);

            if($stateTotal){
                $resultStatesTotals[$state->id] = 0;

                if($animal == "animals"){
                    $stateTotalData = $this->_animaldata->getAnimalDataByShelterAndYear($stateTotal->id, $year);

                    foreach ($stateTotalData as $item){
                        $itemShelter = $this->_shelter->getShelter($item->shelter_id);
                        $resultStatesTotals[$state->id] = $resultStatesTotals[$state->id] + $item->transfered;
                    }
                }else{
                    $stateTotalData = $this->_animaldata->getAnimalDataByShelterYearAndAnimalID($stateTotal->id, $year, $animalInfo->id);
                    if($stateTotalData){
                        $resultStatesTotals[$state->id] = $resultStatesTotals[$state->id] + $stateTotalData->transfered;
                    }
                }
            }else{
                $resultStates[$state->id] = 0;
            }
        }

        foreach ($data as $item){
            $itemShelter = $this->_shelter->getShelter($item->shelter_id);

            if($itemShelter){
                if (array_key_exists($itemShelter->states_id,$resultStates)){
                    $resultStates[$itemShelter->states_id] = $resultStates[$itemShelter->states_id] + $item->transfered;
                }
            }
        }

        $resultStates = array_merge($resultStates, $resultStatesTotals);
        arsort($resultStates, SORT_REGULAR);

        $dataChart = $this->_datachart->getBykeyname("top-states-with-most-". $animal ."-transfered-".$year);
        $result = json_encode($resultStates);

        if($dataChart){
            $this->_datachart->updateData($dataChart->id, $result);
        }else{
            $this->_datachart->add("top-states-with-most-". $animal ."-transfered-".$year, $result);
        }

        $response->response = true;
        echo json_encode($response);
    }

    public function saveTopStatesWithMostAnimalsTransferedOut($animal = "animals", $year = 2019){
        $response = new \stdClass();
        if($animal == "animals"){
            $data = $this->_animaldata->getAnimalDataByYear($year);
        }else{
            $animalInfo = $this->_animal->getAnimalByName(ucfirst($animal));
            $data = $this->_animaldata->getAnimalDataByYearAndAnimalID($year, $animalInfo->id);
        }

        $states = $this->_state->getAllStates();
        $resultStates = array();
        $resultStatesTotals = array();

        foreach ($states as $state){
            $stateTotal = $this->_shelter->getStateTotal($state->id);

            if($stateTotal){
                $resultStatesTotals[$state->id] = 0;

                if($animal == "animals"){
                    $stateTotalData = $this->_animaldata->getAnimalDataByShelterAndYear($stateTotal->id, $year);

                    foreach ($stateTotalData as $item){
                        $itemShelter = $this->_shelter->getShelter($item->shelter_id);
                        $resultStatesTotals[$state->id] = $resultStatesTotals[$state->id] + $item->transfered_out;
                    }
                }else{
                    $stateTotalData = $this->_animaldata->getAnimalDataByShelterYearAndAnimalID($stateTotal->id, $year, $animalInfo->id);

                    if($stateTotalData){
                        $resultStatesTotals[$state->id] = $resultStatesTotals[$state->id] + $stateTotalData->transfered_out;
                    }
                }
            }else{
                $resultStates[$state->id] = 0;
            }
        }

        foreach ($data as $item){
            $itemShelter = $this->_shelter->getShelter($item->shelter_id);

            if($itemShelter){
                if (array_key_exists($itemShelter->states_id,$resultStates)){
                    $resultStates[$itemShelter->states_id] = $resultStates[$itemShelter->states_id] + $item->transfered_out;
                }
            }
        }

        $resultStates = array_merge($resultStates, $resultStatesTotals);
        arsort($resultStates, SORT_REGULAR);

        $dataChart = $this->_datachart->getBykeyname("top-states-with-most-". $animal ."-transfered-out-".$year);
        $result = json_encode($resultStates);

        if($dataChart){
            $this->_datachart->updateData($dataChart->id, $result);
        }else{
            $this->_datachart->add("top-states-with-most-". $animal ."-transfered-out-".$year, $result);
        }

        $response->response = true;
        echo json_encode($response);
    }

    public function saveTopSheltersWithMostAnimals($animal = "animals", $column = "received", $year = 2019){
        $response = new \stdClass();
        if($animal == "animals"){
            $data = $this->_animaldata->getAnimalDataByYear($year);
        }else{
            $animalInfo = $this->_animal->getAnimalByName(ucfirst($animal));
            $data = $this->_animaldata->getAnimalDataByYearAndAnimalID($year, $animalInfo->id);
        }

        $shelters = $this->_shelter->getAllShelters();
        $resultShelters = array();

        foreach ($shelters as $shelter){
            $resultShelters[$shelter->id] = 0;
        }

        foreach ($data as $item){
            //$itemShelter = $this->_shelter->getShelter($item->shelter_id);

            if (array_key_exists($item->shelter_id, $resultShelters)){
                $temp = 0;

                switch ($column) {
                    case "received": $temp = $item->received; break;
                    case "returned": $temp = $item->returned; break;
                    case "euthanized": $temp = $item->euthanized; break;
                    case "transfered": $temp = $item->transfered; break;
                    case "transfered-out": $temp = $item->transfered_out; break;
                }

                $resultShelters[$item->shelter_id] = $resultShelters[$item->shelter_id] + $temp;
            }

        }

        arsort($resultShelters, SORT_REGULAR);

        $dataChart = $this->_datachart->getBykeyname("top-shelters-with-most-".$animal."-".$column."-".$year);
        $result = json_encode($resultShelters);

        if($dataChart){
            $this->_datachart->updateData($dataChart->id, $result);
        }else{
            $this->_datachart->add("top-shelters-with-most-".$animal."-".$column."-".$year, $result);
        }

        $response->response = true;
        echo json_encode($response);
    }

    public function savePercentageOfAnimalsPerYear($column = null, $year = 2019){
        $response = new \stdClass();
        if($column != null){
            $data = $this->_animaldata->getAllAnimalDataByYear($year); //this function does not filter repeating years
            $animals = $this->_animal->getAllAnimals();
            $resultAnimals = array();
            $result = array();

            foreach ($animals as $animal){
                $resultAnimals[$animal->id] = 0;
            }

            foreach ($data as $item){
                $temp = 0;
                switch ($column) {
                    case "received": $temp = $item->received; break;
                    case "returned": $temp = $item->returned; break;
                    case "euthanized": $temp = $item->euthanized; break;
                }

                if (array_key_exists($item->animal_id, $resultAnimals)){
                    $resultAnimals[$item->animal_id] = $resultAnimals[$item->animal_id] + $temp;
                }
            }

            foreach ($resultAnimals as $key => $value){
                $animal = $this->_animal->getAnimal($key);

                if($animal){
                    $tempArray = array(
                        'label' => $animal->name,
                        'value' => $value
                    );

                    array_push($result, $tempArray);
                }
            }

            $dataChart = $this->_datachart->getBykeyname("percentage-of-animals-".$column."-".$year);
            $result = json_encode($result);

            if($dataChart){
                $this->_datachart->updateData($dataChart->id, $result);
            }else{
                $this->_datachart->add("percentage-of-animals-".$column."-".$year, $result);
            }

            $response->response = true;
        }else{
            $response->response = false;
            $response->message = "An error has occurred with the request, please try again later.";
        }

        echo json_encode($response);
    }

    public function savePercentagePerShelterType(){
        $response = new \stdClass();
        $result = array();
        $types = array(
            0 => "Shelters",
            1 => "Maddie's Fund",
            2 => "State Totals"
        );

        foreach ($types as $key => $value){
            $shelters = $this->_shelter->getSheltersByTypeOfEntry($key);
            $temp = array(
                "label" => $value,
                "value" => count($shelters)
            );

            array_push($result, $temp);
        }

        $dataChart = $this->_datachart->getBykeyname("percentage-of-shelters-by-type");
        $result = json_encode($result);

        if($dataChart){
            $this->_datachart->updateData($dataChart->id, $result);
        }else{
            $this->_datachart->add("percentage-of-shelters-by-type", $result);
        }

        $response->response = true;
        echo json_encode($response);
    }

    public function saveNumberOfAnimalsPerYear($animal = "all", $column = "received", $lastYear = 2019, $nyears = 6){
        $response = new \stdClass();
        $result = array();
        $data = array();

        for($i = ($lastYear-$nyears); $i <= $lastYear; $i++){
            $temp = array(
                "label" => "$i",
                "value" => 0
            );

            if($animal == "all") $data = $this->_animaldata->getAnimalDataByYear($i);
            if($animal != "all"){
                $animalInfo = $this->_animal->getAnimalByName(ucfirst($animal));
                $data = $this->_animaldata->getAnimalDataByYearAndAnimalID($i, $animalInfo->id);
            }

            foreach ($data as $d){
                switch ($column){
                    case "received":
                        $temp["value"] = $temp['value'] + $d->received;
                        break;
                    case "returned":
                        $temp["value"] = $temp['value'] + $d->returned;
                        break;
                    case "euthanized":
                        $temp["value"] = $temp['value'] + $d->euthanized;
                        break;
                    case "transfered":
                        $temp["value"] = $temp['value'] + $d->transfered;
                        break;
                    case "transfered-out":
                        $temp["value"] = $temp['value'] + $d->transfered_out;
                        break;
                }
            }

            array_push($result, $temp);
        }

        if($animal == "all") $key = "number-of-animals-".$column."-from-".($lastYear-$nyears)."-to-".$lastYear;
        if($animal != "all") $key = "number-of-".$animal."-".$column."-from-".($lastYear-$nyears)."-to-".$lastYear;

        $dataChart = $this->_datachart->getBykeyname($key);
        $result = json_encode($result);

        if($dataChart){
            $this->_datachart->updateData($dataChart->id, $result);
        }else{
            $this->_datachart->add($key, $result);
        }

        $response->response = true;
        echo json_encode($response);
    }

    public function saveAnimalDataPrediction1($column = "received", $previousYears = 5, $middleYear = 2019, $nextYears = 5){
        $result = array();
        $firstYear = $middleYear-$previousYears;
        $lastYear = $middleYear+$nextYears;
        $categories = array();
        $categories['category'] = array();
        $samples = array();
        $targets = array();

        for($i = $firstYear; $i <= $lastYear; $i++){
            array_push($categories['category'], array("label" => "$i"));

            if($i <= $middleYear)
                array_push($samples, array($i));// Training data
        }

        $dataset = array(
            "seriesname" => "Previous data",
            "data" => array()
        );

        for($i = $firstYear; $i <= $middleYear; $i++){
            $temp = 0;
            $data = $this->_animaldata->getAnimalDataByYear($i);

            foreach ($data as $d){
                switch ($column){
                    case "received":
                        $temp = $temp + $d->received;
                        break;
                    case "returned":
                        $temp = $temp + $d->returned;
                        break;
                    case "euthanized":
                        $temp = $temp + $d->euthanized;
                        break;
                    case "transfered":
                        $temp = $temp + $d->transfered;
                        break;
                    case "transfered-out":
                        $temp = $temp + $d->transfered_out;
                        break;
                }
            }

            array_push($targets, $temp);// Training data
            array_push($dataset['data'], array("value" => "$temp"));
        }

        for($i = ($middleYear+1); $i <= $lastYear; $i++){
            array_push($dataset['data'], array("value" => ""));
        }

        $predictiveDataset = array(
            "dashed" => "1",
            "seriesname" => "Predictive data",
            "data" => array()
        );

        for($i = $firstYear; $i < $middleYear; $i++){
            array_push($predictiveDataset['data'], array("value" => ""));
        }

        $temph = $dataset["data"][5]["value"];
        array_push($predictiveDataset['data'], array("value" => "$temph"));

        $regression = new LeastSquares();// Initialize regression engine
        $regression->train( $samples, $targets); // Train engine

        for($i = $middleYear+1; $i <= $lastYear; $i++){
            $predictiveValue = $regression->predict([$i]); // Predict using trained engine
            array_push($predictiveDataset['data'], array("value" => "$predictiveValue"));
            //array_push($samples, $i);
            //array_push($targets, $predictiveValue);
        }

        $result['response'] = true;
        $result['categories'] = $categories;
        $result['realDataset'] = $dataset;
        $result['predictiveDataset'] = $predictiveDataset;
        $result['dataset'] = array();
        array_push($result['dataset'], $dataset);
        array_push($result['dataset'], $predictiveDataset);
        echo json_encode($result);
        //$key = "number-of-animals-".$column."-from-".($lastYear-$nyears)."-to-".$lastYear;
        //$dataChart = $this->_datachart->getBykeyname($key);
        //$result = json_encode($result);

        //if($dataChart){
        //$this->_datachart->updateData($dataChart->id, $result);
        //}else{
        //$this->_datachart->add($key, $result);
        //}
    }

    public function saveAnimalDataPrediction($column = "received", $previousYears = 5, $middleYear = 2019, $nextYears = 5, $variation = 0.5){
        $result = array();
        $resultOp = array();
        $predectiveValues = array();
        $firstYear = $middleYear-$previousYears;
        $lastYear = $middleYear+$nextYears;
        $categories = array();
        $categories['category'] = array();
        $samples = array();
        $targets = array();
        $response = new \stdClass();

        for($i = $firstYear; $i <= $lastYear; $i++){
            array_push($categories['category'], array("label" => "$i"));

            if($i <= $middleYear)
                array_push($samples, array($i));// Training data
        }

        $dataset = array(
            "seriesname" => "Previous data",
            "data" => array()
        );

        $predictiveDataset = array(
            "dashed" => "1",
            "seriesname" => "Predictive data",
            "data" => array()
        );

        $predictiveYears = array();

        for($i = $firstYear; $i < $middleYear; $i++){
            array_push($predictiveDataset['data'], array("value" => ""));
        }

        array_push($predictiveDataset['data'], array("value" => "0"));

        $ih = 1;
        for($i = $firstYear; $i <= $middleYear; $i++){
            $temp = 0;
            $temp2 = 0;
            $data = $this->_animaldata->getAnimalDataByYear($i);
            $predictiveYear = ($middleYear-1)+$ih; array_push($predictiveYears, $predictiveYear);

            foreach ($data as $d){
                switch ($column){
                    case "received":
                        $temp = $temp + $d->received;
                        break;
                    case "returned":
                        $temp = $temp + $d->returned;
                        break;
                    case "euthanized":
                        $temp = $temp + $d->euthanized;
                        break;
                    case "transfered":
                        $temp = $temp + $d->transfered;
                        break;
                    case "transfered-out":
                        $temp = $temp + $d->transfered_out;
                        break;
                }
            }

            if($i == $firstYear){
                $dataB = $this->_animaldata->getAnimalDataByYear($predictiveYear);

                foreach ($dataB as $d){
                    switch ($column){
                        case "received":
                            $temp2 = $temp2 + $d->received;
                            break;
                        case "returned":
                            $temp2 = $temp2 + $d->returned;
                            break;
                        case "euthanized":
                            $temp2 = $temp2 + $d->euthanized;
                            break;
                        case "transfered":
                            $temp2 = $temp2 + $d->transfered;
                            break;
                        case "transfered-out":
                            $temp2 = $temp2 + $d->transfered_out;
                            break;
                    }
                }
            }else{
                $temp2 = end($predectiveValues);
            }

            $predictiveValue = ($variation*$temp)+($variation*$temp2);
            array_push($predectiveValues, $predictiveValue);

            array_push($targets, $temp);// Training data
            array_push($dataset['data'], array("value" => "$temp"));
            array_push($resultOp, $predictiveYear.": ".(0.5*$temp)."+".(0.5*$temp2)."=".$predictiveValue);
            array_push($predictiveDataset['data'], array("value" => "$predictiveValue"));
            $ih++;
        }

        for($i = ($middleYear+1); $i <= $lastYear; $i++){
            array_push($dataset['data'], array("value" => ""));
        }

        $temph = $dataset["data"][5]["value"];
        $predictiveDataset["data"][5]["value"] =$temph;

        $result['response'] = true;
        $result['operations'] = $resultOp;
        $result['categories'] = $categories;
        $result['predictiveYears'] = $predictiveYears;
        $result['realDataset'] = $dataset;
        $result['predictiveDataset'] = $predictiveDataset;
        $result['dataset'] = array();
        array_push($result['dataset'], $dataset);
        array_push($result['dataset'], $predictiveDataset);

        //echo json_encode($result);

        $key = "prediction-of-animals-".$column."-from-".($middleYear-$previousYears)."-to-".($middleYear+$nextYears);
        $dataChart = $this->_datachart->getBykeyname($key);
        $result = json_encode($result);

        if($dataChart){
            $this->_datachart->updateData($dataChart->id, $result);
        }else{
            $this->_datachart->add($key, $result);
        }

        $response->response = true;
        echo json_encode($response);
    }
}
