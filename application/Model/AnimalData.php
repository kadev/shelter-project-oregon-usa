<?php

namespace Mini\Model;

use Mini\Core\Model;

class AnimalData extends Model
{
    private $_table = "shelter_data";
    private $_table_no_data = "shelter_no_data";
    private $_table_shelter = "shelter";

    /**
     * Get a user from database
     * @param integer $shelter_id
     */
    public function getAnimalDataByShelter($shelter_id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE shelter_id = :shelter_id ORDER BY `year` DESC";
        $query = $this->db->prepare($sql);
        $parameters = array(':shelter_id' => $shelter_id);

        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function getAnimalData($id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE data_id = :id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
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

    public function getCriteriaDataByShelterAndYear($criteria, $shelter_id, $year = null){
        $table = $this->_table;

        if($year == null){
            $sql = "SELECT * FROM $table WHERE animal_id=:animal_id AND shelter_id = :shelter_id ORDER BY `year` DESC";
            $query = $this->db->prepare($sql);
            $parameters = array(
                ':shelter_id' => $shelter_id,
                ':animal_id' => $criteria
            );

            $query->execute($parameters);
            $result = $query->fetch();

            if(empty($result->year)){
                return false;
            }

            $year = $result->year;
        }

        $sql = "SELECT * FROM $table WHERE animal_id=:animal_id AND shelter_id = :shelter_id AND year = :year";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':animal_id' => $criteria,
            ':shelter_id' => $shelter_id,
            ':year' => $year
        );

        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function getTotalAnimalDataShelterByColumnAndYear($shelter, $column, $year){
        $table = $this->_table;

        $sql = "SELECT SUM($column) total FROM $table WHERE shelter_id = :shelter_id AND year = :year";
        $query = $this->db->prepare($sql);
        $parameters = array(':shelter_id' => $shelter, ':year' => $year);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    public function getShelterCriteriaTotalByColumnAndYear($shelter, $criteria, $column, $year){
        $table = $this->_table; //3908

        $sql = "SELECT SUM($column) total FROM $table WHERE shelter_id = :shelter_id AND animal_id = :animal_id AND year = :year";
        $query = $this->db->prepare($sql);
        $parameters = array(':shelter_id' => $shelter, ':animal_id' => $criteria, ':year' => $year);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    public function getAnimalDataByShelterYearAndAnimalID($shelter_id, $year, $animal_id)
    {
        $table = $this->_table;

        $sql = "SELECT * FROM $table WHERE shelter_id = :shelter_id AND year = :year AND animal_id=:animal_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':shelter_id' => $shelter_id, ':year' => $year, ':animal_id' => $animal_id);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    public function getAnimalDataByYear($year, $shelters=null){
        $table = $this->_table;
        $table_shelter = $this->_table_shelter;

        if($shelters == null){
            $sql = "SELECT * FROM $table WHERE year = :year AND shelter_id IN (SELECT id FROM $table_shelter WHERE type_of_entry = 0 AND id <> 1208) ORDER BY data_id DESC";
        }else{
            $sql = "SELECT * FROM $table WHERE year = :year AND shelter_id IN ($shelters) ORDER BY data_id DESC";
        }

        $query = $this->db->prepare($sql);
        $parameters = array(':year' => $year);

        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function getCriteriaDataByYear($animal_id, $year, $shelters=null){
        $table = $this->_table;
        $table_shelter = $this->_table_shelter;

        if($shelters == null){
            $sql = "SELECT * FROM $table WHERE animal_id=:animal_id AND year = :year AND shelter_id IN (SELECT id FROM $table_shelter WHERE type_of_entry = 0 AND id <> 1208) ORDER BY data_id DESC";
        }else{
            $sql = "SELECT * FROM $table WHERE animal_id=:animal_id AND year = :year AND shelter_id IN ($shelters) ORDER BY data_id DESC";
        }

        $query = $this->db->prepare($sql);
        $parameters = array(
            ':year' => $year,
            ':animal_id' => $animal_id
        );

        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function getAllAnimalDataByYear($year){
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE year = :year ORDER BY data_id DESC";
        $query = $this->db->prepare($sql);
        $parameters = array(':year' => $year);

        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function getAnimalDataByShelterAndAnimalID($shelter_id, $animal_id){
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE shelter_id=:shelter_id AND animal_id=:animal_id ORDER BY `year` DESC";
        $query = $this->db->prepare($sql);
        $parameters = array(':shelter_id' => $shelter_id, ':animal_id' => $animal_id);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function getShelterNoDataByShelterAndYear($shelter_id, $year){
        $table = $this->_table_no_data;
        $sql = "SELECT * FROM $table WHERE shelter_id=:shelter_id AND year=:year ORDER BY id DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':shelter_id' => $shelter_id, ':year' => $year);
        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    public function getByAnimalShelterIDAndYear($animal_id, $shelter_id, $year){
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE animal_id=:animal_id AND shelter_id=:shelter_id AND year=:year ORDER BY data_id DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':animal_id' => $animal_id, ':shelter_id' => $shelter_id, ':year' => $year);
        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    public function getAnimalDataByYearAndAnimalID($year, $animal_id){
        $table = $this->_table;
        $table_shelter = $this->_table_shelter;
        $sql = "SELECT * FROM $table WHERE animal_id=:animal_id AND year=:year AND shelter_id IN (SELECT id FROM $table_shelter WHERE type_of_entry = 0 AND id <> 1208) ORDER BY data_id DESC";
        $query = $this->db->prepare($sql);
        $parameters = array(':animal_id' => $animal_id, ':year' => $year);
        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function getLastRecord(){
        $table = $this->_table;
        $sql = "SELECT * FROM $table ORDER BY data_id DESC LIMIT 1";
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
     * @param array $data Users data (username, email, password, group_id, active, banned, activation_code, sal, created_on,
     * last_login, forgotten_password_code, remember_code, ip_address, title, first_name, last_name, user_type, last_updated)
     */
    public function addAnimalData($shelter_id, $animal_id, $year, $data)
    {
        $table = $this->_table;
        $sql = "INSERT INTO $table (shelter_id, animal_id, year, received, returned, placed, transfered, euthanized,
                transfered_out, transfered_out_within_area, transfered_out_outside_area, transfered_in_within_area,
                transfered_in_outside_area)
                VALUES (:shelter_id, :animal_id, :year, :received, :returned, :placed, :transfered, :euthanized,
                :transfered_out, :transfered_out_within_area, :transfered_out_outside_area, :transfered_in_within_area,
                :transfered_in_outside_area )";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':shelter_id' => $shelter_id,
            ':animal_id' => $animal_id,
            ':year' => $year,
            ':received' => $data['received'],
            ':returned' => $data['returned'],
            ':placed' => $data['placed'],
            ':transfered' => $data['transfers_in'],
            ':euthanized' => $data['euthanized'],
            ':transfered_out' => $data['transfers_out'],
            ':transfered_out_within_area' => $data['transfers_out_within_area'],
            ':transfered_out_outside_area' => $data['transfers_out_outside_area'],
            ':transfered_in_within_area' => $data['transfers_in_within_area'],
            ':transfered_in_outside_area' => $data['transfers_in_outside_area']
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
     * Update an animal in database
     * @param integer $shelter
     * @param integer $year
     * @param integer $animalID
     * @param array $data
     */
    public function updateAnimalData($data)
    {
        $table = $this->_table;
        $sql = "UPDATE $table SET received=:received, returned=:returned, placed=:placed, transfered=:transfered,
                euthanized=:euthanized, transfered_out=:transfered_out, transfered_out_within_area=:transfered_out_within_area,
                transfered_out_outside_area=:transfered_out_outside_area, transfered_in_within_area=:transfered_in_within_area,
                transfered_in_outside_area=:transfered_in_outside_area WHERE data_id=:data_id";
        $query = $this->db->prepare($sql);

        $parameters = array(
            ':received' => $data['received'],
            ':returned' => $data['returned'],
            ':placed' => $data['placed'],
            ':transfered' => $data['transfers_in'],
            ':euthanized' => $data['euthanized'],
            ':transfered_out' => $data['transfers_out'],
            ':transfered_out_within_area' => $data['transfers_out_within_area'],
            ':transfered_out_outside_area' => $data['transfers_out_outside_area'],
            ':transfered_in_within_area' => $data['transfers_in_within_area'],
            ':transfered_in_outside_area' => $data['transfers_in_outside_area'],
            ':data_id' => $data['data_id'],
        );

        return $query->execute($parameters);
    }

    public function changeNoDataShelter($no_data){
        $table = $this->_table_no_data;
        $sql = "UPDATE $table SET status=:status WHERE id=:id";
        $query = $this->db->prepare($sql);

        $parameters = array(
            ':status' => $no_data->status,
            ':id' => $no_data->id,
        );

        return $query->execute($parameters);
    }

    /**
     * Delete an animal in the database
     * animals/deleteAnimal/ stuff!
     * @param int $animal_id Id of animal
     */
    public function deleteAnimal($animal_id)
    {
        $table = $this->_table;
        $sql = "DELETE FROM $table WHERE id = :animal_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':animal_id' => $animal_id);

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }
}
