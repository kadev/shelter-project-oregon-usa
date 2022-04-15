<?php

namespace Mini\Model;

use Mini\Core\Model;

class Country extends Model
{
    private $_table = "countries";

    /**
     * Get a country from database
     * @param integer $country_id
     */
    public function getCountry($country_id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE id = :country_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':country_id' => $country_id);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Get all countries from database
     */
    public function getAllCountries()
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getCountryNameById($id)
    {
        $table = $this->_table;
        $sql = "SELECT name FROM $table WHERE id = :country_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':country_id' => $id);

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        $query->rowcount() ? $result = $query->fetch() : $result = false;
        return ($result != false ? $result->countries_id : false );
    }

    public function getLastRecord(){
        $table = $this->_table;
        $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Add a country to database
     * @param array $data Country data (name, short_name, order, published)
     */
    public function addCountry($data)
    {
        $table = $this->_table;
        $sql = "INSERT INTO $table (name, short_name, `order`, published)
                VALUES (:name, :short_name, :ordercountry, :published)";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':name' => $data['country-name'],
            ':short_name' => $data['short-name'],
            ':ordercountry' => $data['order'],
            ':published' => $data['published']
        );

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }

    /**
     * Update a country in database
     * @param array $data Data
     */
    public function updateCountry($data)
    {
        $table = $this->_table;
        $sql = "UPDATE $table SET name=:name, short_name=:short_name, `order`=:ordercountry, published=:published WHERE id=:country_id";
        $query = $this->db->prepare($sql);

        $parameters = array(
            ':name' => $data['country-name'],
            ':short_name' => $data['short-name'],
            ':ordercountry' => $data['order'],
            ':published' => $data['published'],
            ':country_id' => $data['id'],
        );

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }

    /**
     * Delete a Country in the database
     * countries/deleteCoutry/ stuff!
     * @param int $country_id Id of country
     */
    public function deleteCountry($country_id)
    {
        $table = $this->_table;
        $sql = "DELETE FROM $table WHERE id = :country_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':country_id' => $country_id);

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }
}
