<?php

namespace Mini\Model;

use Mini\Core\Model;

class AnimalDataUpdates extends Model
{
    private $_table = "shelter_data_updates";
    private $_table_no_data = "shelter_no_data";
    private $_table_shelter = "shelter";

    /**
     * Get
     * @param integer $shelter_id
     */
    public function getByShelter($shelter_id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE shelter_id = :shelter_id ORDER BY `year` DESC";
        $query = $this->db->prepare($sql);
        $parameters = array(':shelter_id' => $shelter_id);

        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function get($id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE id = :id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    public function getByUserID($user_id){
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE user_id = :id ORDER BY id DESC";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $user_id);

        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function getByStatus($status){
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE request_status=:status ORDER BY id DESC";
        $query = $this->db->prepare($sql);
        $parameters = array(':status' => $status);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function getAnimalNoDataById($id){
        $table = $this->_table_no_data;
        $sql = "SELECT * FROM $table WHERE id = :id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    public function getAnimalDataByShelterAndYear($shelter_id, $year = null)
    {
        $table = $this->_table;

        if($year == null){
            $sql = "SELECT * FROM $table WHERE shelter_id = :shelter_id ORDER BY `year` DESC";
            $query = $this->db->prepare($sql);
            $parameters = array(':shelter_id' => $shelter_id);

            $query->execute($parameters);
            $result = $query->fetch();

            if(empty($result->year)){
                return false;
            }

            $year = $result->year;
        }

        $sql = "SELECT * FROM $table WHERE shelter_id = :shelter_id AND year = :year";
        $query = $this->db->prepare($sql);
        $parameters = array(':shelter_id' => $shelter_id, ':year' => $year);

        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function getLastRecord(){
        $table = $this->_table;
        $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return ($query->rowcount() ? $query->fetch() : false);
    }

    public function getLastRecordNoDataTable(){
        $table = $this->_table_no_data;
        $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Add a animal to database
     * @param object $data Users data (username, email, password, group_id, active, banned, activation_code, sal, created_on,
     * last_login, forgotten_password_code, remember_code, ip_address, title, first_name, last_name, user_type, last_updated)
     */
    public function add($data)
    {
        $table = $this->_table;
        $sql = "INSERT INTO $table (shelter_id, year, animal_data, no_data_status, population, note, user_id, request_status)
                VALUES (:shelter_id, :year, :animal_data, :no_data_status, :population, :note, :user_id, :request_status)";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':shelter_id' => $data->shelter,
            ':year' => $data->year,
            ':animal_data' => $data->animal_data,
            ':no_data_status' => $data->no_data,
            ':population' => $data->population,
            ':note' => $data->notes,
            ':user_id' => $data->user_id,
            ':request_status' => $data->request_status
        );

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }

    public function createNoDataShelter($no_data)
    {
        $table = $this->_table_no_data;
        $sql = "INSERT INTO $table (shelter_id, year, status) VALUES (:shelter_id, :year, :status )";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':shelter_id' => $no_data->shelter_id,
            ':year' => $no_data->year,
            ':status' => $no_data->status
        );

        return $query->execute($parameters);
    }

    /**
     * Update an request in database
     * @param object $data
     */
    public function update($data)
    {
        $table = $this->_table;
        $sql = "UPDATE $table SET animal_data=:animal_data, no_data_status=:no_data, population=:population, note=:note 
                WHERE id=:data_id";
        $query = $this->db->prepare($sql);

        $parameters = array(
            ':animal_data' => $data->animal_data,
            ':no_data' => $data->no_data,
            ':population' => $data->population,
            ':note' => $data->notes,
            ':data_id' => $data->id,
        );

        return $query->execute($parameters);
    }

    public function changeRequestStatus($request_id, $status){
        $table = $this->_table;
        $sql = "UPDATE $table SET request_status=:status WHERE id=:request_id";
        $query = $this->db->prepare($sql);

        $parameters = array(':status' => $status, ':request_id' => $request_id);

        return $query->execute($parameters);
    }

    /**
     * Delete an data request in the database
     * @param int $request_id Id of animal
     */
    public function delete($request_id)
    {
        $table = $this->_table;
        $sql = "DELETE FROM $table WHERE id = :request_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':request_id' => $request_id);

        return $query->execute($parameters);
    }
}
