<?php

namespace Mini\Model;

use Mini\Core\Model;

class Page extends Model
{
    private $_table = "cms_pages";

    /**
     * Get all pages from database
     */
    public function getAllPages()
    {
        $table = $this->_table;
        $sql = "SELECT id, page_name, cms_pages_id, permalink, content, published FROM $table ORDER BY id DESC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * Get pages by search from database
     */
    public function getPagesBySearch($string)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE page_name LIKE '%$string%'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * Get total pages from database
     */
    public function getTotalPages()
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
     * Add a page to database
     * @param array $data Pages data (page_name, cms_pages_id, permalink, content, published, order)
     */
    public function addPage($data)
    {
        $table = $this->_table;
        $sql = "INSERT INTO $table (page_name, cms_pages_id, permalink, content, published, `order`)
                VALUES (:page_name, :cms_pages_id, :permalink, :content, :published, :orderpage)";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':page_name' => $data['page_name'],
            ':cms_pages_id' => ($data['parent'] == 'NULL') ? NULL: $data['parent'],
            ':permalink' => $data['permalink'],
            ':content' => $data['page-content'],
            ':published' => $data['published'],
            ':orderpage' => $data['order']
        );

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        return $query->execute($parameters);
    }

    /**
     * Delete a page in the database
     * pages/deletePage/ stuff!
     * @param int $page_id Id of page
     */
    public function deletePage($page_id)
    {
        $table = $this->_table;
        $sql = "DELETE FROM $table WHERE id = :page_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':page_id' => $page_id);

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }

    /**
     * Get a page from database
     * @param integer $page_id
     */
    public function getPage($page_id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE id = :page_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':page_id' => $page_id);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Update a page in database
     * @param array $data Data
     */
    public function updatePage($data)
    {
        $table = $this->_table;
        $sql = "UPDATE $table SET page_name = :page_name, cms_pages_id = :parent, permalink = :permalink, content = :content, published = :published, `order` = :orderpage WHERE id = :page_id";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':page_name' => $data['page_name'],
            ':parent' => ($data['parent'] == 'NULL') ? NULL: $data['parent'],
            ':permalink' => $data['permalink'],
            ':content' => $data['page-content'],
            ':published' => $data['published'],
            ':orderpage' => $data['order'],
            ':page_id' => $data['id']);

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }
}
