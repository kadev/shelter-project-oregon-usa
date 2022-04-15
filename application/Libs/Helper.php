<?php

namespace Mini\Libs;

use Mini\Model\Animal;
use Mini\Model\AnimalData;
use Mini\Model\Article;
use Mini\Model\Country;
use Mini\Model\County;
use Mini\Model\CustomContent;
use Mini\Model\Page;
use Mini\Model\Report;
use Mini\Model\SecurityLog;
use Mini\Model\Shelter;
use Mini\Model\ShelterRollback;
use Mini\Model\ShelterUpdates;
use Mini\Model\State;
use Mini\Model\User;

class Helper
{

    /**
     * debugPDO
     *
     * Shows the emulated SQL query in a PDO statement. What it does is just extremely simple, but powerful:
     * It combines the raw query and the placeholders. For sure not really perfect (as PDO is more complex than just
     * combining raw query and arguments), but it does the job.
     *
     * @author Panique
     * @param string $raw_sql
     * @param array $parameters
     * @return string
     */
    static public function debugPDO($raw_sql, $parameters) {

        $keys = array();
        $values = $parameters;

        foreach ($parameters as $key => $value) {

            // check if named parameters (':param') or anonymous parameters ('?') are used
            if (is_string($key)) {
                $keys[] = '/' . $key . '/';
            } else {
                $keys[] = '/[?]/';
            }

            // bring parameter into human-readable format
            if (is_string($value)) {
                $values[$key] = "'" . $value . "'";
            } elseif (is_array($value)) {
                $values[$key] = implode(',', $value);
            } elseif (is_null($value)) {
                $values[$key] = 'NULL';
            }
        }

        /*
        echo "<br> [DEBUG] Keys:<pre>";
        print_r($keys);

        echo "\n[DEBUG] Values: ";
        print_r($values);
        echo "</pre>";
        */

        $raw_sql = preg_replace($keys, $values, $raw_sql, 1, $count);

        return $raw_sql;
    }

    static public function getTheCorrectShelterName($shelterName) {
        $result = explode(",", $shelterName);

        if(is_array($result)){
            if(isset($result[1])){
                return $result[1];
            }else{
                $result = explode(" ", $shelterName, 2);
                if(isset($result[1])){
                    return $result[1];
                }else{
                    return $shelterName;
                }
            }
        }else{
            return $result;
        }
    }

    static public function AnimalDataRegistrationAdvanced($data, $totalShelters){
        $result = new \stdClass();
        $result->totalShelters = $totalShelters;
        $result->sheltersCompleted = count($data);
        $result->sheltersPending = $totalShelters - $result->sheltersCompleted;
        $result->percentageCompleted = round((($result->sheltersCompleted / $result->totalShelters) * 100), 2);

        return $result;
    }

    static public function getSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        return $_SESSION['session'];
    }

    static public function startSession($data){
        /*if($privilege!=1) {
            $u1 = new MySqlTable();
            $sql = "UPDATE ".$GLOBALS['db_table']['users']." SET last_connect='".date('Y-m-d H:i:s')."' WHERE id='".$user_id."'";
            $u1->executeQuery($sql);
        }*/

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['session']['user_id'] = $data['user_id'];
        $_SESSION['session']['name'] = $data['name'];
        $_SESSION['session']['username'] = $data['username'];
        $_SESSION['session']['email'] = $data['email'];
        $_SESSION['session']['privilege'] = $data['privilege'];
        $_SESSION['session']['start'] = $data['start'];
        $_SESSION['session']['expire'] = $data['expire'];
    }

    static public function verifyUserSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if(!Helper::sessionIsLive()) {
            header('Location: '.URL);
        }
    }

    static public function sessionIsLive() {
        if(isset($_SESSION['session']['user_id']) AND $_SESSION['session']['user_id']!='' ) return true;
        else return false;
    }

    static public function killSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['session'] = array();
        unset($_SESSION);
    }

    static public function stripTags($variables, $allowedTags = null){
        if(is_array($variables)){
            $result = array();
            foreach ($variables as $key => $value){
                $result[$key] = strip_tags($value, $allowedTags);
            }
            return $result;
        }else{
            return strip_tags($variables, $allowedTags);
        }
    }

    static public function addLog($activity, $user, $other = null){
        $securityLog = new SecurityLog();
        $data = new \stdClass();
        $data->activity = $activity;
        $data->user_id = $user;
        $data->other = $other;

        return $securityLog->addSecurityLog($data);
    }

    static public function getBadgeForAmountShelterUpdates(){
        $ShelterUpdates = new ShelterUpdates();
        $session = self::getSession();

        if($session['privilege'] == 1 OR $session['privilege'] == 2){
            $qty = $ShelterUpdates->getQuantityOfPendingRequest();
        }else{
            $qty = $ShelterUpdates->getQuantityOfPendingRequest($session['user_id']);
        }

        return '<span class="badge badge-info ml-2">' . $qty . '</span>';
    }

    static public function getQtyRollbacksByShelterID($shelter_id){
        $ShelterRollback = new ShelterRollback();
        $qty = $ShelterRollback->getTotalRollbacks($shelter_id);

        return $qty;
    }

    static public function getAnimalName($animal_id){
        $Animal = new Animal();
        $animal = $Animal->getAnimal($animal_id);

        if($animal){
            return $animal->name;
        }else{
            return false;
        }

    }

    static public function getStateName($id){
        $State = new State();
        $state = $State->getState($id);

        if($state){
            return $state->name;
        }else{
            return false;
        }
    }

    static public function getShelterName($id){
        $Shelter = new Shelter();
        $shelter = $Shelter->getShelter($id);

        if($shelter){
            return $shelter->shelter_name;
        }else{
            return false;
        }
    }

    static public function getLastRecord($table){
        $result = false;

        switch ($table){
            case 'users':
                $user = new User();
                $result = $user->getLastRecord();
                break;
            case 'pages':
                $page = new Page();
                $result = $page->getLastRecord();
                break;
            case 'articles':
                $article = new Article();
                $result = $article->getLastRecord();
                break;
            case 'shelters':
                $shelter = new Shelter();
                $result = $shelter->getLastRecord();
                break;
            case 'states':
                $state = new State();
                $result = $state->getLastRecord();
                break;
            case 'countries':
                $country = new Country();
                $result = $country->getLastRecord();
                break;
            case 'counties':
                $county = new County();
                $result = $county->getLastRecord();
                break;
            case 'animals':
                $animals = new Animal();
                $result = $animals->getLastRecord();
                break;
            case 'custom-content':
                $customContent = new CustomContent();
                $result = $customContent->getLastRecord();
            case 'reports':
                $report = new Report();
                $result = $report->getLastRecord();
        }

        return $result;
    }

    static public function getUsername($user_id){
        $User = new User();
        $data = $User->getUser($user_id);
        return $data->first_name . ' ' . $data->last_name;
    }

    static public function limitEcho($text, $length){
        if(strlen($text)<=$length) {
            echo $text;
        } else {
            $y=substr($text,0,$length) . '...';
            echo $y;
        }
    }

    static public function countSheltersAreInReport($shelters){
        if(!empty($shelters)){
            $shelters = explode(",", $shelters);
            return count($shelters);
        } else{
            return 0;
        }


    }

    static public function getNameOfCriteria($criteria){
        if($criteria == "all"){
            return "All";
        }else{
            $Animal = new Animal();
            $animalInfo = $Animal->getAnimal($criteria);

            if($animalInfo){
                return strtolower($animalInfo->name);
            }else{
                return "";
            }
        }
    }

    static public function getMessageForLog($log){
        $session = Helper::getSession();

        switch($log->activity){
            case 'log-in':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "Logged in.";
                }else{
                    $message = "You started session.";
                }
                break;
            case 'create-user':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "Created a new user.";
                }else{
                    $message = "You have created a new user.";
                }
                break;
            case 'update-user':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "Updated a user.";
                }else{
                    $message = "You have updated a user.";
                }
                break;
            case 'delete-user':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "Deleted a user({OTHER_VALUE}).";
                }else{
                    $message = "You have deleted a user({OTHER_VALUE}).";
                }
                break;
            case 'update-profile':
                $message = "You updated your user profile.";
                break;
            case 'change-password':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "Updated his password.";
                }else{
                    $message = "You have updated another user's password.";
                }
                break;
            case 'create-page':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "Created a new <a href='".URL."pages/edit/{OTHER_VALUE}' target='_blank'>page</a>.";
                }else{
                    $message = "You created a new <a href='".URL."pages/edit/{OTHER_VALUE}' target='_blank'>page</a>.";
                }
                break;
            case 'update-page':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "Updated a <a href='".URL."pages/edit/{OTHER_VALUE}' target='_blank'>page</a>.";
                }else{
                    $message = "You updated an <a href='".URL."pages/edit/{OTHER_VALUE}' target='_blank'>page</a>.";
                }
                break;
            case 'delete-page':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "Deleted a page ({OTHER_VALUE}).";
                }else{
                    $message = "You deleted a page ({OTHER_VALUE}).";
                }
                break;
            case 'create-article':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "{Created a new <a href='".URL."articles/edit/{OTHER_VALUE}' target='_blank'>article</a>.";
                }else{
                    $message = "You created a new <a href='".URL."articles/edit/{OTHER_VALUE}' target='_blank'>article</a>.";
                }
                break;
            case 'update-article':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "Updated an <a href='".URL."articles/edit/{OTHER_VALUE}' target='_blank'>article</a>.";
                }else{
                    $message = "You updated an <a href='".URL."articles/edit/{OTHER_VALUE}' target='_blank'>article</a>.";
                }
                break;
            case 'delete-article':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "Deleted an article ({OTHER_VALUE}).";
                }else{
                    $message = "You deleted an article ({OTHER_VALUE}).";
                }
                break;
            case 'create-shelter':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "Created a new <strong>Shelter</strong>: <a href='".URL."shelters/edit/{OTHER_VALUE}' target='_blank'>{SHELTER_NAME}</a>.";
                }else{
                    $message = "You created a new <strong>Shelter:</strong> <a href='".URL."shelters/edit/{OTHER_VALUE}' target='_blank'>{SHELTER_NAME}</a>.";
                }
                break;
            case 'update-shelter':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "Updated <strong>Shelter</strong>: <a href='".URL."shelters/edit/{OTHER_VALUE}' target='_blank'>{SHELTER_NAME}</a>.";
                }else{
                    $message = "You updated <strong>Shelter</strong>: <a href='".URL."shelters/edit/{OTHER_VALUE}' target='_blank'>{SHELTER_NAME}</a>.";
                }
                break;
            case 'delete-shelter':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "{USER_NAME} deleted an shelter.";
                }else{
                    $message = "You deleted a shelter.";
                }
                break;
            case 'create-state':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "Created a new <a href='".URL."states/edit/{OTHER_VALUE}' target='_blank'>state</a>.";
                }else{
                    $message = "You created a new <a href='".URL."states/edit/{OTHER_VALUE}' target='_blank'>state</a>.";
                }
                break;
            case 'update-state':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "Updated a <a href='".URL."states/edit/{OTHER_VALUE}' target='_blank'>state</a>.";
                }else{
                    $message = "You updated a <a href='".URL."states/edit/{OTHER_VALUE}' target='_blank'>state</a>.";
                }
                break;
            case 'delete-state':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "Deleted a state.";
                }else{
                    $message = "You deleted a state.";
                }
                break;
            case 'create-country':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "Created a new <a href='".URL."countries/edit/{OTHER_VALUE}' target='_blank'>country</a>.";
                }else{
                    $message = "You created a new <a href='".URL."countries/edit/{OTHER_VALUE}' target='_blank'>country</a>.";
                }
                break;
            case 'update-country':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "Updated a <a href='".URL."countries/edit/{OTHER_VALUE}' target='_blank'>country</a>.";
                }else{
                    $message = "You updated a <a href='".URL."countries/edit/{OTHER_VALUE}' target='_blank'>country</a>.";
                }
                break;
            case 'delete-country':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "Deleted a country.";
                }else{
                    $message = "You deleted a country.";
                }
                break;
            case 'create-animal':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "Created a new <a href='".URL."animals/edit/{OTHER_VALUE}' target='_blank'>animal</a>.";
                }else{
                    $message = "You created a new <a href='".URL."animals/edit/{OTHER_VALUE}' target='_blank'>animal</a>.";
                }
                break;
            case 'update-animal':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "Updated an <a href='".URL."animals/edit/{OTHER_VALUE}' target='_blank'>animal</a>.";
                }else{
                    $message = "You updated an <a href='".URL."animals/edit/{OTHER_VALUE}' target='_blank'>animal</a>.";
                }
                break;
            case 'delete-animal':
                if($session['privilege'] == 1 AND $session['user_id'] != $log->user_id){
                    $message = "Deleted an animal.";
                }else{
                    $message = "You deleted an animal.";
                }
                break;
            case 'create-animal-data':
                $message = 'Created the <strong>Animal data</strong> for the <a href="'.URL.'animalData/goToAnimalData/id/{OTHER_VALUE}" target="_blank">year {ANIMAL_DATA_YEAR} of the shelter {SHELTER_NAME}</a>.';
                break;
            case 'update-animal-data':
                $message = 'Updated <strong>Animal data</strong> for the <a href="'.URL.'animalData/goToAnimalData/id/{OTHER_VALUE}" target="_blank">year {ANIMAL_DATA_YEAR} of the shelter: {SHELTER_NAME}</a>.';
                break;
            case 'change-no-data-shelter':
                $message = '<u>No data has been checked</u> for the <a href="'.URL.'animalData/goToAnimalData/no-data/{OTHER_VALUE}" target="_blank">year {ANIMAL_DATA_YEAR} of the shelter {SHELTER_NAME}</a>.';
                break;
            case 'create-report':
                if($session['user_id'] != $log->user_id){
                    $message = "Created a new <a href='".URL."reports/details/{OTHER_VALUE}' target='_blank'>report</a>";
                }else{
                    $message = "You created a new <a href='".URL."reports/details/{OTHER_VALUE}' target='_blank'>report</a>.";
                }
                break;
            case 'update-report':
                if($session['user_id'] != $log->user_id){
                    $message = "Updated a <a href='".URL."reports/details/{OTHER_VALUE}' target='_blank'>report</a>.";
                }else{
                    $message = "You updated a <a href='".URL."reports/details/{OTHER_VALUE}' target='_blank'>report</a>.";
                }
                break;
            case 'delete-report':
                if($session['user_id'] != $log->user_id){
                    $message = "Deleted a report.";
                }else{
                    $message = "You deleted a report.";
                }
                break;
            case 'update-shelter-notes':
                $message = 'Updated <strong>Shelter notes</strong> for the <a href="'.URL.'animalData/goToAnimalData/notes/{OTHER_VALUE}" target="_blank">year {ANIMAL_DATA_YEAR} of the shelter: {SHELTER_NAME}</a>.';
                break;
            default:
                $message = $log->activity;
        }

        if(strpos($message, '{USER_NAME}') !== false){
            $user = new User();
            $user = $user->getUser($log->user_id);
            $message = str_replace("{USER_NAME}", ($user->first_name.' '.$user->last_name), $message);
        }

        if(strpos($message, '{OTHER_VALUE}') !== false){
            $message = str_replace("{OTHER_VALUE}", $log->other, $message);
        }

        if(strpos($message, '{SHELTER_NAME}') !== false){
            $Shelter = new Shelter();
            $AnimalData = new AnimalData();

            switch($log->activity){
                case 'create-animal-data':
                case 'update-animal-data':
                    $animalDataInfo = $AnimalData->getAnimalData($log->other);

                    if(!empty($animalDataInfo)){
                        $result = $Shelter->getShelter($animalDataInfo->shelter_id);
                        $result = $result->shelter_name;
                        $result_year = $animalDataInfo->year;
                    }else{
                        $result = "<span style='color: red;'>Shelter name not found</span>";
                    }

                    break;
                case 'change-no-data-shelter':
                    $animalNoDataInfo = $AnimalData->getAnimalNoDataById($log->other);
                    $result_year = "<span style='color: red;'>Year not found</span>";

                    if(!empty($animalNoDataInfo)){
                        $result = $Shelter->getShelter($animalNoDataInfo->shelter_id);
                        $result = $result->shelter_name;
                        $result_year = $animalNoDataInfo->year;
                    }else{
                        $result = "<span style='color: red;'>Shelter name not found</span>";
                    }
                    break;
                case 'update-shelter-notes':
                    $noteInfo = $Shelter->getShelterNotesByNoteID($log->other);
                    $result_year = "<span style='color: red;'>Year not found</span>";

                    if(!empty($noteInfo)){
                        $result = $Shelter->getShelter($noteInfo->shelter_id);
                        $result = $result->shelter_name;
                        $result_year = $noteInfo->year;
                    }else{
                        $result = "<span style='color: red;'>Shelter name not found</span>";
                    }
                    break;
                default:
                    $result = $Shelter->getShelter($log->other);

                    if(!empty($result))
                        $result = $result->shelter_name;
                    else
                        $result = "<span style='color: red;'>Shelter name not found</span>";


                    break;
            }

            $message = str_replace("{SHELTER_NAME}", $result, $message);
            if(strpos($message, '{ANIMAL_DATA_YEAR}') !== false){
                if(isset($result_year)):
                    $message = str_replace("{ANIMAL_DATA_YEAR}", $result_year, $message);
                else:
                    $message = str_replace("{ANIMAL_DATA_YEAR}", "<span style='color: red;'>Year not found</span>", $message);
                endif;
            }
        }

        return $message;
    }


}