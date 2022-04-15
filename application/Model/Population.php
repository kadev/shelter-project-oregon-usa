<?php

namespace Mini\Model;

use Mini\Core\Model;

class Population extends Model
{
    private $_table = "population";

    /**
     * Get all population from database
     */
    public function getAllRecords()
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * Get a populations by shelter from database
     * @param integer $shelter_id
     */
    public function getPopulationByShelterID($shelter_id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE ShelterID = :shelter_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':shelter_id' => $shelter_id);

        $query->execute($parameters);
        return $query->fetchAll();
    }

    /**
     * Get a populations by shelter from database
     * @param integer $shelter_id
     */
    public function getPopulationByShelterIDAndYear($shelter_id, $year)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE ShelterID = :shelter_id AND PopulationYear = :year";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':shelter_id' => $shelter_id,
            ':year' => $year
        );

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Add a population to database
     * @param integer $shelter_id
     * @param integer $year
     * @param numeric $population
     */
    public function addPopulation($shelter_id, $year, $population)
    {
        $table = $this->_table;
        $sql = "INSERT INTO $table (PopulationYear, Population, ShelterID)
                VALUES (:population_year, :population, :shelterID)";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':population_year' => $year,
            ':population' => $population,
            ':shelterID' => $shelter_id
        );

        return $query->execute($parameters);
    }

    /**
     * Update a population to database
     * @param integer $population_id
     * @param integer $population
     */
    public function updatePopulation($population_id, $population)
    {
        $table = $this->_table;
        $sql = "UPDATE $table SET Population = :population WHERE id=:population_id";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':population' => $population,
            ':population_id' => $population_id
        );

        return $query->execute($parameters);
    }

    /**
     * Update a population in database by shelter id and year
     * @param integer $shelter_id
     * @param integer $year
     * @param varchar $population
     */
    public function updatePopulationByShelterIDAndYear($shelter_id, $year, $population)
    {
        $table = $this->_table;
        $sql = "UPDATE $table SET Population = :population WHERE ShelterID = :shelter_id AND PopulationYear = :year";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':population' => $population,
            ':shelter_id' => $shelter_id,
            ':year' => $year
        );

        return $query->execute($parameters);
    }
}
