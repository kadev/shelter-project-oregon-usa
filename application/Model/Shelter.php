<?php

namespace Mini\Model;

use Mini\Core\Model;

class Shelter extends Model
{
    private $_table = "shelter";
    private $_table_notes = "shelter_notes";
    private $_table_financial_files = "shelter_financial_files";

    /**
     * Get a shelter from database
     * @param integer $shelter_id
     */
    public function getShelter($shelter_id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE id = :shelter_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':shelter_id' => $shelter_id);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Get a shelter notes by year from database
     * @param integer $shelter_id
     * @param integer $year
     */
    public function getShelterNotesByYear($shelter_id, $year)
    {
        $table = $this->_table_notes;
        $sql = "SELECT * FROM $table WHERE shelter_id = :shelter_id AND year = :year LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':shelter_id' => $shelter_id,
            ':year' => $year
        );

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    public function getShelterNotesByNoteID($note_id)
    {
        $table = $this->_table_notes;
        $sql = "SELECT * FROM $table WHERE note_id = :note_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':note_id' => $note_id
        );

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Get all shelters from database
     */
    public function getAllShelters()
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * Get shelters by search from database
     */
    public function getSheltersBySearch($string)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE shelter_name LIKE '%$string%'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * Get total shelters from database
     */
    public function getTotalShelters()
    {
        $table = $this->_table;
        $sql = "SELECT COUNT(*) FROM $table";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetch(\PDO::FETCH_BOTH);
        return $result[0];
    }

    public function getSheltersByStateID($state_id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE states_id = :state_id ORDER BY shelter_name ASC";
        $query = $this->db->prepare($sql);
        $parameters = array(':state_id' => $state_id);

        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function getSheltersByTypeOfEntry($type)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE type_of_entry = :typeid";
        $query = $this->db->prepare($sql);
        $parameters = array(':typeid' => $type);

        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function getLastModifiedShelters()
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table ORDER BY updated_date DESC LIMIT 5";
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

    public function getFinancialFiles($shelter_id, $relatedTable){
        $table = $this->_table_financial_files;
        $sql = "SELECT * FROM $table WHERE shelter_id = :shelter_id AND related_table=:related";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':shelter_id' => $shelter_id,
            ':related' => $relatedTable
        );

        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function getByTypeOfEntry($type)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE type_of_entry = :type_of_entry";
        $query = $this->db->prepare($sql);
        $parameters = array(':type_of_entry' => $type);

        $query->execute($parameters);
        return $query->fetchAll();
    }

    public function getStateTotal($state_id){
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE states_id='$state_id' AND type_of_entry='2' ORDER BY id DESC LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Add a shelter to database
     * @param array $data Shelter data (shelter_name, contact_name, contact_title, street_address, city, states_id, zip, countries_id, phone_numner,
     * email_address, website, logo county, published, open_shelter, address_unknown)
     */
    public function addShelter($data)
    {
        $table = $this->_table;
        $sql = "INSERT INTO $table (shelter_name, contact_name, contact_title, street_address, city, states_id, zip,
                phone_numner, email_address, website, logo, image, type_shelter, designated_no_kill, importing_shelter,
                 financials, shelter_data, county, published, open_shelter, address_unknown, type_of_entry, programs)
                VALUES (:shelter_name, :contact_name, :contact_title, :street_address, :city, :states_id, :zip,
                :phone_numner, :email, :website, :logo, :image, :type_shelter, :designated_no_kill, :importing_shelter, 
                :financials, :shelter_data, :county, :published, :open_shelter, :address_unknown, :type_of_entry, :programs)";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':shelter_name' => $data['shelter-name'],
            ':contact_name' => $data['contact-name'],
            ':contact_title' => $data['contact-title'],
            ':street_address' => $data['street-address'],
            ':city' => $data['city'],
            ':states_id' => $data['state'],
            ':zip' => $data['zip-code'],
            ':phone_numner' => $data['phone-number'],
            ':email' => $data['email'],
            ':website' => $data['website'],
            ':logo' => strtolower($data['shelter-logo']),
            ':image' => strtolower($data['shelter-image']),
            ':type_shelter' => $data['type-shelter'],
            ':designated_no_kill' => $data['designated-no-kill'],
            ':financials' => $data['financials'],
            ':shelter_data' => $data['shelter-data'],
            ':importing_shelter' => $data['importing-shelter'],
            ':county' => $data['county'],
            ':published' => $data['published'],
            ':open_shelter' => $data['open-door-shelter'],
            ':address_unknown' => $data['address-unknown'],
            ':type_of_entry' => $data['type-of-entry'],
            ':programs' => $data['programs']
        );

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }

    public function addFinancialFile($data, $relatedTable)
    {
        $table = $this->_table_financial_files;
        $sql = "INSERT INTO $table (type, title, link, shelter_id, related_table) VALUES (:type, :title, :link, :shelter, :related)";
        $query = $this->db->prepare($sql);

        $parameters = array(
            ':type' => $data['type'],
            ':title' => $data['title'],
            ':link' => $data['file'],
            ':shelter' => $data['shelter_id'],
            ':related' => $relatedTable
        );

        return $query->execute($parameters);
    }

    /**
     * Update an shelter in database
     * @param array $data Data
     */
    public function updateShelter($data)
    {
        $table = $this->_table;
        $sql = "UPDATE $table SET shelter_name=:shelter_name, contact_name=:contact_name, contact_title=:contact_title, 
                street_address=:street_address, city=:city, states_id=:states_id, zip=:zip, phone_numner=:phone_numner, 
                email_address=:email, website=:website, logo=:logo, image=:image, county=:county, published=:published,
                open_shelter=:open_shelter, type_shelter=:type_shelter, designated_no_kill=:designated_no_kill, 
                importing_shelter=:importing_shelter, financials=:financials, shelter_data=:shelter_data, address_unknown=:address_unknown,
                type_of_entry=:type_of_entry, programs=:programs, updated_date=:updated_date WHERE id = :shelter_id";
        $query = $this->db->prepare($sql);

        $parameters = array(
            ':shelter_name' => $data['shelter-name'],
            ':contact_name' => $data['contact-name'],
            ':contact_title' => $data['contact-title'],
            ':street_address' => $data['street-address'],
            ':city' => $data['city'],
            ':states_id' => $data['state'],
            ':zip' => $data['zip-code'],
            ':phone_numner' => $data['phone-number'],
            ':email' => $data['email'],
            ':website' => $data['website'],
            ':logo' => strtolower($data['shelter-logo']),
            ':image' => strtolower($data['shelter-image']),
            ':county' => $data['county'],
            ':published' => $data['published'],
            ':open_shelter' => $data['open-door-shelter'],
            ':type_shelter' => $data['type-shelter'],
            ':designated_no_kill' => $data['designated-no-kill'],
            ':importing_shelter' => $data['importing-shelter'],
            ':financials' => $data['financials'],
            ':shelter_data' => $data['shelter-data'],
            ':address_unknown' => $data['address-unknown'],
            ':type_of_entry' => $data['type-of-entry'],
            ':shelter_id' => $data['id'],
            ':programs' => $data['programs'],
            ':updated_date' => date("Y-m-d")
        );

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }

    /**
     * Add a shelter to database
     * @param integer $shelter_id
     * @param integer $year
     * @param varchar $notes
     */
    public function addShelterNotes($shelter_id, $year, $notes)
    {
        $table = $this->_table_notes;
        $sql = "INSERT INTO $table (shelter_id, note, year) VALUES (:shelter_id, :note, :year)";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':shelter_id' => $shelter_id,
            ':note' => $notes,
            ':year' => $year
        );

        return $query->execute($parameters);
    }

    /**
     * Update an shelter in database
     * @param array $data Data
     */
    public function updateShelterNotes($notes_id, $notes)
    {
        $table = $this->_table_notes;
        $sql = "UPDATE $table SET note=:notes WHERE note_id=:notes_id";
        $query = $this->db->prepare($sql);

        $parameters = array(
            ':notes' => $notes,
            ':notes_id' => $notes_id,
        );

        return $query->execute($parameters);
    }

    public function ChangeCurrentFilesToRollback($shelter_id, $rollback_id){
        $table = $this->_table_financial_files;
        $sql = "UPDATE $table SET related_table='rollback', shelter_id=:rollback_id WHERE shelter_id=:shelter_id AND related_table='shelter'";
        $query = $this->db->prepare($sql);

        $parameters = array(
            ':shelter_id' => $shelter_id,
            ':rollback_id' => $rollback_id
        );

        return $query->execute($parameters);
    }

    public function ChangeUpdatesFilesToCurrent($update_id, $shelter_id){
        $table = $this->_table_financial_files;
        $sql = "UPDATE $table SET related_table='shelter', shelter_id=:shelter_id WHERE shelter_id=:update_id AND related_table='updates'";
        $query = $this->db->prepare($sql);

        $parameters = array(
            ':update_id' => $update_id,
            ':shelter_id' => $shelter_id
        );

        return $query->execute($parameters);
    }

    /**
     * Delete a shelter in the database
     * shelters/deleteShelter/ stuff!
     * @param int $shelter_id Id of shelter
     */
    public function deleteShelter($shelter_id)
    {
        $table = $this->_table;
        $sql = "DELETE FROM $table WHERE id = :shelter_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':shelter_id' => $shelter_id);

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }

    public function destroyFinancialFiles($shelter_id, $relatedTable)
    {
        $table = $this->_table_financial_files;
        $sql = "DELETE FROM $table WHERE shelter_id = :shelter_id AND related_table=:related";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':shelter_id' => $shelter_id,
            ':related' => $relatedTable
        );

        return $query->execute($parameters);
    }

    public function clearImageColumn($shelter_id, $column = null){
        $table = $this->_table;

        if($column == null){
            $sql = "UPDATE $table SET logo = '' WHERE id = :shelter_id";
        }else{
            $sql = "UPDATE $table SET $column = '' WHERE id = :shelter_id";
        }

        $query = $this->db->prepare($sql);
        $parameters = array(
            ':shelter_id' => $shelter_id
        );
        return $query->execute($parameters);
    }

}
