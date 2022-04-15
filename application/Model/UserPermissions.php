<?php

namespace Mini\Model;

use Mini\Core\Model;

class UserPermissions extends Model
{
    private $_table = "user_permissions";

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

    public function getByKeynameAndUserID($keyname, $user_id, $expectedResult = "last") //expectedResuilt -> "all" or "last"
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE keyname=:keyname AND user_id = :user_id ORDER BY id ASC";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id, ':keyname' => $keyname);

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result

        if($expectedResult == "all"){
            return $query->fetchAll();
        }else{
            $query->rowcount() ? $result = $query->fetch() : $result = false;
            return ($result != false ? $result->states_id : false );
        }
    }

    public function getLastRecord(){
        $table = $this->_table;
        $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return ($query->rowcount() ? $query->fetch() : false);
    }

    public function add($keyname, $user_id, $state, $years)
    {
        $table = $this->_table;
        $sql = "INSERT INTO $table (keyname, user_id, value, other_value)
                VALUES (:keyname, :user_id, :value, :other_value)";

        $query = $this->db->prepare($sql);
        $parameters = array(
            ':keyname' => $keyname,
            ':user_id' => $user_id,
            ':value' => $state,
            ':other_value' => $years
        );

        return $query->execute($parameters);
    }

    public function update($id, $state)
    {
        $table = $this->_table;
        $sql = "UPDATE $table SET state_id=:state_id WHERE id=:id";
        $query = $this->db->prepare($sql);

        $parameters = array(
            ':state_id' => $state,
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

    public function deleteByKeynameAndUserID($keyname, $user_id){
        $table = $this->_table;
        $sql = "DELETE FROM $table WHERE keyname=:keyname AND user_id=:user_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id, ':keyname' => $keyname );

        return $query->execute($parameters);
    }

}
