<?php

namespace Mini\Model;

use Mini\Core\Model;

class ShelterRollback extends Model
{
    private $_table = "shelter_rollback";

    /**
     * Get a shelter rollback from a database
     * @param integer $rollback_id
     */
    public function get($rollback_id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE id = :rollback_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':rollback_id' => $rollback_id);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Get all rollbacks from database
     */
    public function getAll()
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getByShelterID($shelter_id){
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE shelter_id='".$shelter_id."' ORDER BY id DESC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * Get total shelter updates from database
     */
    public function getTotalRollbacks($shelter_id = null)
    {
        $table = $this->_table;

        if($shelter_id == null){
            $sql = "SELECT COUNT(*) FROM $table";
        }else{
            $sql = "SELECT COUNT(*) FROM $table WHERE shelter_id='".$shelter_id."'";
        }

        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetch(\PDO::FETCH_BOTH);
        return $result[0];
    }

    public function getLastRecord(){
        $table = $this->_table;
        $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Add a shelter update to database
     * @param object $data Rollback data (shelter_id, shelter_name, contact_name, contact_title, street_address, city, states_id, zip, countries_id, phone_numner,
     * email_address, website, logo, image, type_shelter, designated_no_kill, importing_shelter, financials, shelter_data,
     * county, published, open_shelter, user_id)
     */
    public function add($data, $user_id)
    {
        $table = $this->_table;
        $sql = "INSERT INTO $table (shelter_id, shelter_name, contact_name, contact_title, street_address, city, states_id, zip,
                phone_number, email_address, website, logo, image, type_shelter, designated_no_kill, importing_shelter,
                 financials, type_of_entry, shelter_data, county, published, open_shelter, user_id)
                VALUES (:shelter_id, :shelter_name, :contact_name, :contact_title, :street_address, :city, :states_id, :zip,
                :phone_numner, :email, :website, :logo, :image, :type_shelter, :designated_no_kill, :importing_shelter, 
                :financials, :type_of_entry, :shelter_data, :county, :published, :open_shelter, :user_id)";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':shelter_id' => $data->id,
            ':shelter_name' => $data->shelter_name,
            ':contact_name' => $data->contact_name,
            ':contact_title' => $data->contact_title,
            ':street_address' => $data->street_address,
            ':city' => $data->city,
            ':states_id' => $data->states_id,
            ':zip' => $data->zip,
            ':phone_numner' => $data->phone_numner,
            ':email' => $data->email_address,
            ':website' => $data->website,
            ':logo' => strtolower($data->logo),
            ':image' => strtolower($data->image),
            ':type_shelter' => $data->type_shelter,
            ':designated_no_kill' => $data->designated_no_kill,
            ':financials' => $data->financials,
            ':type_of_entry' => $data->type_of_entry,
            ':shelter_data' => $data->shelter_data,
            ':importing_shelter' => $data->importing_shelter,
            ':county' => $data->county,
            ':published' => $data->published,
            ':open_shelter' => $data->open_shelter,
            ':user_id' => $user_id
        );

        return $query->execute($parameters);
    }
}
