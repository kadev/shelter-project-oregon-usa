<?php

namespace Mini\Model;

use Mini\Core\Model;

class UserStates extends Model
{
    private $_table = "user_states";

    public function get($id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE id = :id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    public function getAll()
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table ORDER BY id DESC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getByUserID($user_id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE user_id = :user_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id);

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        $query->rowcount() ? $result = $query->fetch() : $result = false;
        return ($result != false ? $result : false );
    }

    public function getStatesByUserID($user_id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE user_id = :user_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id);

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        $query->rowcount() ? $result = $query->fetch() : $result = false;
        return ($result != false ? $result->states_id : false );
    }

    public function getLastRecord(){
        $table = $this->_table;
        $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return ($query->rowcount() ? $query->fetch() : false);
    }

    public function add($user_id, $states)
    {
        $table = $this->_table;
        $sql = "INSERT INTO $table (user_id, states_id)
                VALUES (:user_id, :states_id)";

        $query = $this->db->prepare($sql);
        $parameters = array(
            ':user_id' => $user_id,
            ':states_id' => $states
        );

        return $query->execute($parameters);
    }

    public function update($id, $states)
    {
        $table = $this->_table;
        $sql = "UPDATE $table SET states_id=:states_id WHERE id=:id";
        $query = $this->db->prepare($sql);

        $parameters = array(
            ':states_id' => $states,
            ':id' => $id,
        );

        return $query->execute($parameters);
    }

    public function delete($id)
    {
        $table = $this->_table;
        $sql = "DELETE FROM $table WHERE id = :id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        return $query->execute($parameters);
    }

    public function deleteByUserID($user_id){
        $table = $this->_table;
        $sql = "DELETE FROM $table WHERE user_id = :user_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id);

        return $query->execute($parameters);
    }

}
