<?php

namespace Mini\Model;

use Mini\Core\Model;

class User extends Model
{
    private $_table = "users";

    /**
     * Get a user from database
     * @param integer $user_id
     */
    public function getUser($user_id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE id = :user_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Get a user from database by username
     * @param integer $username
     */
    public function getUserByUsername($username)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE username = :username LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':username' => $username);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Get all users from database
     */
    public function getAllUsers()
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getLastRecord(){
        $table = $this->_table;
        $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Add a user to database
     * @param array $data Users data (username, email, password, group_id, active, banned, activation_code, sal, created_on,
     * last_login, forgotten_password_code, remember_code, ip_address, title, first_name, last_name, user_type, last_updated)
     */
    public function addUser($data)
    {
        $table = $this->_table;
        $sql = "INSERT INTO $table (username, title, first_name, last_name, email, password, group_id, active)
                VALUES (:username, :title, :first_name, :last_name, :email, :password, :group_id, :active)";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':username' => $data['email'],
            ':title' => $data['title'],
            ':first_name' => $data['first-name'],
            ':last_name' => $data['last-name'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':group_id' => $data['privilege'],
            ':active' => 1
        );

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }

    /**
     * Update an user in database
     * @param array $data Data
     */
    public function updateUser($data)
    {
        $table = $this->_table;
        $sql = "UPDATE $table SET username=:username, title=:title, first_name=:first_name, last_name=:last_name, 
                email=:email, group_id=:group_id WHERE id=:user_id";
        $query = $this->db->prepare($sql);

        $parameters = array(
            ':username' => $data['email'],
            ':title' => $data['title'],
            ':first_name' => $data['first-name'],
            ':last_name' => $data['last-name'],
            ':email' => $data['email'],
            ':group_id' => $data['privilege'],
            ':user_id' => $data['id'],
        );

        return $query->execute($parameters);
    }

    /**
     * Update an user profile in database
     * @param array $data Data
     */
    public function updateProfile($data)
    {
        $table = $this->_table;
        $sql = "UPDATE $table SET username=:username, biography=:biography, title=:title, first_name=:firstname, last_name=:lastname, 
                email=:email WHERE id=:user_id";
        $query = $this->db->prepare($sql);

        $parameters = array(
            ':username' => $data['username'],
            ':biography' => $data['biography'],
            ':title' => $data['title'],
            ':firstname' => $data['firstname'],
            ':lastname' => $data['lastname'],
            ':email' => $data['email'],
            ':user_id' => $data['id']
        );

        return $query->execute($parameters);
    }

    /**
     * Change password in database
     * @param array $data Data
     */
    public function changePassword($data)
    {
        $table = $this->_table;
        $sql = "UPDATE $table SET password=:password WHERE id=:user_id";
        $query = $this->db->prepare($sql);

        $parameters = array(
            ':password' => password_hash($data['new-password'], PASSWORD_DEFAULT),
            ':user_id' => $data['id']
        );

        return $query->execute($parameters);
    }

    /**
     * Delete a User in the database
     * users/deleteUser/ stuff!
     * @param int $user_id Id of user
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
