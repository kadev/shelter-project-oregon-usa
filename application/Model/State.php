<?php

namespace Mini\Model;

use Mini\Core\Model;

class State extends Model
{
    private $_table = "states";

    /**
     * Get a state from database
     * @param integer $state_id
     */
    public function getState($state_id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE id = :state_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':state_id' => $state_id);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Get all pages from database
     */
    public function getAllStates()
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table ORDER BY name ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getStateNameById($id)
    {
        $table = $this->_table;
        $sql = "SELECT name FROM $table WHERE id = :state_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':state_id' => $id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        $query->rowcount() ? $result = $query->fetch() : $result = false;
        return ($result != false ? $result->name : false );
    }

    public function getStateNameByCode($code)
    {
        $table = $this->_table;
        $sql = "SELECT name FROM $table WHERE StateAbbreviation = :code LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':code' => $code);

        $query->execute($parameters);

        $query->rowcount() ? $result = $query->fetch() : $result = false;
        return ($result != false ? $result->Name : false );
    }

    public function getLastRecord(){
        $table = $this->_table;
        $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Add a state to database
     * @param array $data States data (name, short_name, order, published)
     */
    public function addState($data)
    {
        $table = $this->_table;
        $sql = "INSERT INTO $table (name, short_name, `order`, published)
                VALUES (:name, :short_name, :orderstate, :published)";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':name' => $data['state-name'],
            ':short_name' => $data['short-name'],
            ':orderstate' => $data['order'],
            ':published' => $data['published']
        );

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }

    /**
     * Update an state in database
     * @param array $data Data
     */
    public function updateState($data)
    {
        $table = $this->_table;
        $sql = "UPDATE $table SET name=:name, short_name=:short_name, `order`=:orderstate, published=:published WHERE id=:state_id";
        $query = $this->db->prepare($sql);

        $parameters = array(
            ':name' => $data['state-name'],
            ':short_name' => $data['short-name'],
            ':orderstate' => $data['order'],
            ':published' => $data['published'],
            ':state_id' => $data['id'],
        );

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }

    /**
     * Delete a State in the database
     * states/deleteState/ stuff!
     * @param int $state_id Id of user
     */
    public function deleteState($state_id)
    {
        $table = $this->_table;
        $sql = "DELETE FROM $table WHERE id = :state_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':state_id' => $state_id);

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }

}
