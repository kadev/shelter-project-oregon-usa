<?php

namespace Mini\Model;

use Mini\Core\Model;

class Report extends Model
{
    private $_table = "reports";

    /**
     * Get all pages from database
     */
    public function getAll()
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table ORDER BY id DESC";
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
     * Add a report to database
     * @param array $data Report data (title, from_year, to_year, description, published)
     * @param array $shelters Shelters include in the new report
     */
    public function create($data, $shelters)
    {
        $table = $this->_table;
        $sql = "INSERT INTO $table (title, from_year, to_year, description, published, shelters, criteria)
                VALUES (:title, :from_year, :to_year, :description, :published, :shelters, :criteria)";

        $query = $this->db->prepare($sql);

        $parameters = array(
            ':title' => $data['title'],
            ':from_year' => $data['from'],
            ':to_year' => $data['to'],
            ':description' => $data['description'],
            ':published' => $data['published'],
            ':shelters' => $shelters,
            ':criteria' => $data['criteria']
        );

        return $query->execute($parameters);
    }

    /**
     * Get a report from database
     * @param integer $report_id
     */
    public function get($report_id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE id = :report_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':report_id' => $report_id);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Update a report in database
     * @param array $data Data
     */
    public function update($data, $shelters)
    {
        $table = $this->_table;
        $sql = "UPDATE $table SET title = :title, from_year = :from_year, to_year = :to_year, description = :description,
                published = :published, shelters = :shelters, criteria = :criteria WHERE id = :report_id";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':title' => $data['title'],
            ':from_year' => $data['from'],
            ':to_year' => $data['to'],
            ':description' => $data['description'],
            ':published' => $data['published'],
            ':shelters' => $shelters,
            ':criteria' => $data['criteria'],
            ':report_id' => $data['id']);

        return $query->execute($parameters);
    }

    /**
     * Delete a report in the database
     * reports/delete/ stuff!
     * @param int $report_id Id of report
     */
    public function delete($report_id)
    {
        $table = $this->_table;
        $sql = "DELETE FROM $table WHERE id = :report_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':report_id' => $report_id);

        return $query->execute($parameters);
    }
}
