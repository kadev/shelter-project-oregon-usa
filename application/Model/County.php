<?php

namespace Mini\Model;

use Mini\Core\Model;

class County extends Model
{
    private $_table = "county";

    public function getCounty($county_id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE CountyID = :county_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':county_id' => $county_id);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Get all countries from database
     */
    public function getAllCounties()
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table ORDER BY Name ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getCountyNameById($id)
    {
        $table = $this->_table;
        $sql = "SELECT name FROM $table WHERE id = :county_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':county_id' => $id);

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        $query->rowcount() ? $result = $query->fetch() : $result = false;
        return ($result != false ? $result->countries_id : false );
    }

    public function getByStateCode($code){
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE StateAbbreviation='$code' ORDER BY Name ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getLastRecord(){
        $table = $this->_table;
        $sql = "SELECT * FROM $table ORDER BY CountyID DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return ($query->rowcount() ? $query->fetch() : false);
    }

    public function add($data)
    {
        $table = $this->_table;
        $sql = "INSERT INTO $table (`Name`, StateAbbreviation, `State`)
                VALUES (:name, :state_abbreviation, :v_state)";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':name' => $data['name'],
            ':state_abbreviation' => $data['state-code'],
            ':v_state' => $data['state-id']
        );

        return $query->execute($parameters);
    }

    public function updateCounty($data)
    {
        $table = $this->_table;
        $sql = "UPDATE $table SET Name=:name, StateAbbreviation=:state_abbreviation, `State`=:v_state WHERE CountyID=:county_id";
        $query = $this->db->prepare($sql);

        $parameters = array(
            ':name' => $data['name'],
            ':state_abbreviation' => $data['state-code'],
            ':v_state' => $data['state-id'],
            ':county_id' => $data['id'],
        );

        return $query->execute($parameters);
    }

    public function deleteCounty($county_id)
    {
        $table = $this->_table;
        $sql = "DELETE FROM $table WHERE CountyID = :county_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':county_id' => $county_id);

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }
}
