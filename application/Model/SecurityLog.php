<?php

namespace Mini\Model;

use Mini\Core\Model;

class SecurityLog extends Model
{
    private $_table = "security_log";

    /**
     * Get a activity from database
     * @param integer $id
     */
    public function getSecurityLog($id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE id = :id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Get a security log from database by user
     * @param integer $username
     */
    public function getLogsByUser($user)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE user_id = :user ORDER BY id DESC";
        $query = $this->db->prepare($sql);
        $parameters = array(':user' => $user);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetchAll() : false);
    }

    /**
     * Get all users from database
     */
    public function getAllSecurityLogs()
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table ORDER BY id DESC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getAnimalDataLogByDataID($data_id){
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE (activity = 'viewed-animal-data' OR activity = 'create-animal-data' OR activity = 'update-animal-data'
                OR activity = 'change-no-data-shelter') AND other='$data_id' ORDER BY id DESC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * Add a security log to database
     * @param object $data Security log data (activity, user_id, other, status)
     */
    public function addSecurityLog($data)
    {
        $table = $this->_table;
        $sql = "INSERT INTO $table (activity, user_id, other, status)
                VALUES (:activity, :user_id, :other, :status)";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':activity' => $data->activity,
            ':user_id' => $data->user_id,
            ':other' => $data->other,
            ':status' => 1
        );

        return $query->execute($parameters);
    }

    /**
     * Delete a security log in the database
     * @param int $log_id
     */
    public function deleteUser($user_id)
    {
        $table = $this->_table;
        $sql = "DELETE FROM $table WHERE id = :user_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id);

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }
}
