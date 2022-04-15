<?php

namespace Mini\Model;

use Mini\Core\Model;

class CustomContent extends Model
{
    private $_table = "cms_custom_content";

    /**
     * Get all custom content from database
     */
    public function getAllCustomContent()
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table ORDER BY id ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * Get custom content by search from database
     */
    public function getCustomContentBySearch($string)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE name LIKE '%$string%'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * Get total custom content from database
     */
    public function getTotalCustomContent()
    {
        $table = $this->_table;
        $sql = "SELECT COUNT(*) FROM $table";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetch(\PDO::FETCH_BOTH);
        return $result[0];
    }

    public function getLastRecord(){
        $table = $this->_table;
        $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Add a custom content to database
     * @param array $data Custom Content data (name, parent, permalink, content, published, order)
     */
    public function addCustomContent($data)
    {
        $table = $this->_table;
        $sql = "INSERT INTO $table (name, parent, permalink, content, published, `order`)
                VALUES (:name, :parent, :permalink, :content, :published, :ordercustom)";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':name' => $data['name'],
            ':parent' => $data['parent'],
            ':permalink' => $data['permalink'],
            ':content' => $data['content'],
            ':published' => $data['published'],
            ':ordercustom' => $data['order']
        );

        return $query->execute($parameters);
    }

    /**
     * Delete a custom content in the database
     * pages/deleteCustomContent/ stuff!
     * @param int $custom_content_id Id of page
     */
    public function deleteCustomContent($custom_content_id)
    {
        $table = $this->_table;
        $sql = "DELETE FROM $table WHERE id = :custom_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':custom_id' => $custom_content_id);

        return $query->execute($parameters);
    }

    /**
     * Get a custom content from database
     * @param integer $custom_content_id
     */
    public function getCustomContent($custom_content_id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE id = :custom_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':custom_id' => $custom_content_id);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Update a custom content in database
     * @param array $data Data
     */
    public function updateCustomContent($data)
    {
        $table = $this->_table;
        $sql = "UPDATE $table SET name = :name, parent = :parent, permalink = :permalink, content = :content, published = :published, `order` = :ordercustom WHERE id = :custom_id";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':name' => $data['name'],
            ':parent' => $data['parent'],
            ':permalink' => $data['permalink'],
            ':content' => $data['content'],
            ':published' => $data['published'],
            ':ordercustom' => $data['order'],
            ':custom_id' => $data['id']);

        return $query->execute($parameters);
    }
}
