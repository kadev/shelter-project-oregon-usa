<?php

namespace Mini\Model;

use Mini\Core\Model;

class DataChart extends Model
{
    private $_table = "data_charts";

    public function get($id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE id = :id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    public function getBykeyname($keyname)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE keyname = :keyname ORDER BY id DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':keyname' => $keyname);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    public function getLastRecord(){
        $table = $this->_table;
        $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return ($query->rowcount() ? $query->fetch() : false);
    }

    public function add($keyname, $data)
    {
        $table = $this->_table;
        $sql = "INSERT INTO $table (keyname, data) VALUES (:keyname, :data)";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':keyname' => $keyname,
            ':data' => $data
        );

        return $query->execute($parameters);
    }

    public function updateData($id, $data)
    {
        $table = $this->_table;
        $sql = "UPDATE $table SET data=:data, updated_at=NOW() WHERE id=:id";
        $query = $this->db->prepare($sql);

        $parameters = array(
            ':data' => $data,
            ':id' => $id
        );

        return $query->execute($parameters);
    }

    public function delete($data_id)
    {
        $table = $this->_table;
        $sql = "DELETE FROM $table WHERE id = :data_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':data_id' => $data_id);

        return $query->execute($parameters);
    }


}
