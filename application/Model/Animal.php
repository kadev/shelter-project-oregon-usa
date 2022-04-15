<?php

namespace Mini\Model;

use Mini\Core\Model;

class Animal extends Model
{
    private $_table = "animals";

    /**
     * Get a user from database
     * @param integer $user_id
     */
    public function getAnimal($animal_id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE id = :animal_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':animal_id' => $animal_id);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Get all pages from database
     */
    public function getAllAnimals()
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getAnimalNameById($id)
    {
        $table = $this->_table;
        $sql = "SELECT name FROM $table WHERE id = :animal_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':animal_id' => $id);

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        $query->rowcount() ? $result = $query->fetch() : $result = false;
        return ($result != false ? $result->countries_id : false );
    }

    public function getAnimalByName($name){
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE `name` = :animal_name LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':animal_name' => $name);

        $query->execute($parameters);

        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Add a animal to database
     * @param array $data Users data (username, email, password, group_id, active, banned, activation_code, sal, created_on,
     * last_login, forgotten_password_code, remember_code, ip_address, title, first_name, last_name, user_type, last_updated)
     */
    public function addAnimal($data)
    {
        $table = $this->_table;
        $sql = "INSERT INTO $table (name, countries_id, published, `order`)
                VALUES (:name, :countries_id, :published, :orderanimal)";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':name' => $data['animal-name'],
            ':countries_id' => $data['country'],
            ':published' => $data['published'],
            ':orderanimal' => $data['order'],
        );

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }

    public function getLastRecord(){
        $table = $this->_table;
        $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Update an animal in database
     * @param array $data Data
     */
    public function updateAnimal($data)
    {
        $table = $this->_table;
        $sql = "UPDATE $table SET name=:name, countries_id=:countries_id, published=:published, `order`=:orderanimal WHERE id=:animal_id";
        $query = $this->db->prepare($sql);

        $parameters = array(
            ':name' => $data['animal-name'],
            ':countries_id' => $data['country'],
            ':published' => $data['published'],
            ':orderanimal' => $data['order'],
            ':animal_id' => $data['id'],
        );

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
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
