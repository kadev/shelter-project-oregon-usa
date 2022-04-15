<?php

namespace Mini\Model;

use Mini\Core\Model;

class Article extends Model
{
    private $_table = "cms_news";

    /**
     * Get a article from database
     * @param integer $article_id
     */
    public function getArticle($article_id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE id = :article_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':article_id' => $article_id);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Get all pages from database
     */
    public function getAllArticles()
    {
        $table = $this->_table;
        $sql = "SELECT id, page_name, permalink, content_short, content, image, published FROM $table";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * Get articles by search from database
     */
    public function getArticlesBySearch($string)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE page_name LIKE '%$string%'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * Get total articles from database
     */
    public function getTotalArticles()
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
     * Add a article to database
     * @param array $data Pages data (page_name, permalink, content_short, content, image,published, order)
     */
    public function addArticle($data)
    {
        $table = $this->_table;
        $sql = "INSERT INTO $table (page_name, permalink, content_short, content, image, published, `order`)
                VALUES (:page_name, :permalink, :content_short, :content, :image, :published, :orderarticle)";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':page_name' => $data['article-name'],
            ':permalink' => $data['permalink'],
            ':content_short' => $data['article-content-short'],
            ':content' => $data['article-content'],
            ':image' => strtolower($data['article-image']),
            ':published' => $data['published'],
            ':orderarticle' => $data['order']
        );

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }

    /**
     * Update an article in database
     * @param array $data Data
     */
    public function updateArticle($data)
    {
        $table = $this->_table;
        $sql = "UPDATE $table SET page_name = :article_name, permalink = :permalink, content_short = :content_short, content = :content, image=:image, published = :published, `order` = :orderarticle WHERE id = :article_id";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':article_name' => $data['article-name'],
            ':permalink' => $data['permalink'],
            ':content_short' => $data['article-content-short'],
            ':content' => $data['article-content'],
            ':image' => strtolower($data['article-image']),
            ':published' => $data['published'],
            ':orderarticle' => $data['order'],
            ':article_id' => $data['id']);

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }

    /**
     * Delete an article in the database
     * articles/deleteArticle/ stuff!
     * @param int $article_id Id of article
     */
    public function deleteArticle($article_id)
    {
        $table = $this->_table;
        $sql = "DELETE FROM $table WHERE id = :article_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':article_id' => $article_id);

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }

    public function clearImageColumn($article_id){
        $table = $this->_table;
        $sql = "UPDATE $table SET image = '' WHERE id = :article_id";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':article_id' => $article_id
        );
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }

}
