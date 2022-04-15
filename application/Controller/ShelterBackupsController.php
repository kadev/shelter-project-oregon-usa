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

class ShelterBackupsController
{
    public function restore(){
        Helper::verifyUserSession();
        $session = Helper::getSession();

        $result = new \stdClass();
        $result->response = false;

        if (isset($_POST["backup_id"])) {
            $ShelterRollback = new ShelterRollback();
            $Shelter = New Shelter();

            $dataBackup = $ShelterRollback->get($_POST['backup_id']);
            $dataFinancials = $Shelter->getFinancialFiles($_POST['backup_id'], 'rollback');

            $shelter = $Shelter->getShelter($dataBackup->shelter_id);

            $params = array(
                'shelter-name' => $dataBackup->shelter_name,
                'contact-name' => $dataBackup->contact_name,
                'contact-title' => $dataBackup->contact_title,
                'street-address' => $dataBackup->street_address,
                'city' => $dataBackup->city,
                'state' => $dataBackup->states_id,
                'zip-code' => $dataBackup->zip,
                'phone-number' => $dataBackup->phone_number,
                'email' => $dataBackup->email_address,
                'website' => $dataBackup->website,
                'shelter-logo' => $dataBackup->logo,
                'shelter-image' => $dataBackup->image,
                'county' => $dataBackup->county,
                'published' => $dataBackup->published,
                'open-door-shelter' => $dataBackup->open_shelter,
                'type-shelter' => $dataBackup->type_shelter,
                'designated-no-kill' => $dataBackup->designated_no_kill,
                'importing-shelter' => $dataBackup->importing_shelter,
                'address-unknown' => $dataBackup->address_unknown,
                'financials' => $dataBackup->financials,
                'type-of-entry' => $dataBackup->type_of_entry,
                'shelter-data' => $dataBackup->shelter_data,
                'programs' => $dataBackup->programs,
                'id' => $shelter->id
            );

            if($Shelter->updateShelter($params)){
                $Shelter->destroyFinancialFiles($shelter->id, 'shelter');

                foreach ($dataFinancials as $file){
                    $file = (array) $file;
                    $file['file'] = $file["link"];
                    $Shelter->addFinancialFile($file, "shelter");
                }

                $result->response = true;
                Helper::addLog("restore-shelter-backup", $session['user_id'], $dataBackup->id);
            }
        }

        echo json_encode($result);
    }
}
