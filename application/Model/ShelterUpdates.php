<?php

namespace Mini\Model;

use Mini\Core\Model;

class ShelterUpdates extends Model
{
    private $_table = "shelter_updates";
    private $_table_notes = "shelter_notes";

    /**
     * Get a shelter update from a database
     * @param integer $update_id
     */
    public function get($update_id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE id = :update_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':update_id' => $update_id);

        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetch() : false);
    }

    /**
     * Get all updates from database
     */
    public function getAll()
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * Get shelter updates by search from database
     */
    public function getUpdatesBySearch($string)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE shelter_name LIKE '%$string%'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * Get total shelter updates from database
     */
    public function getTotalUpdates()
    {
        $table = $this->_table;
        $sql = "SELECT COUNT(*) FROM $table";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetch(\PDO::FETCH_BOTH);
        return $result[0];
    }

    public function getLastModifiedUpdates()
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table ORDER BY updated_date DESC LIMIT 5";
        $query = $this->db->prepare($sql);

        $query->execute();
        return $query->fetchAll();
    }

    public function getLastUpdatedShelters($user_id)
    {
        $table = $this->_table;
        $sql = "SELECT * FROM $table WHERE user_id='$user_id' ORDER BY created_at DESC LIMIT 5";
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
     * Add a shelter update to database
     * @param array $data Pages data (shelter_id, shelter_name, contact_name, contact_title, street_address, city, states_id, zip, countries_id, phone_numner,
     * email_address, website, logo, image, type_shelter, designated_no_kill, importing_shelter, financials, shelter_data,
     * county, published, open_shelter, user_id, request_status)
     */
    public function add($data)
    {
        $table = $this->_table;
        $sql = "INSERT INTO $table (shelter_id, shelter_name, contact_name, contact_title, street_address, city, states_id, zip,
                phone_number, email_address, website, logo, image, type_shelter, designated_no_kill, importing_shelter,
                 financials, shelter_data, county, published, open_shelter, address_unknown, type_of_entry, programs, user_id, request_status)
                VALUES (:shelter_id, :shelter_name, :contact_name, :contact_title, :street_address, :city, :states_id, :zip,
                :phone_numner, :email, :website, :logo, :image, :type_shelter, :designated_no_kill, :importing_shelter, 
                :financials, :shelter_data, :county, :published, :open_shelter, :address_unknown, :type_of_entry, :programs, :user_id, :request_status)";
        $query = $this->db->prepare($sql);
        $parameters = array(
            ':shelter_id' => $data['shelter-id'],
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
            ':programs' => $data['programs'],
            ':user_id' => $data['user-id'],
            ':request_status' => $data['request-status']
        );

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }

    /**
     * Update an shelter in database
     * @param array $data Data
     */
    public function update($data, $update_id)
    {
        $table = $this->_table;
        $sql = "UPDATE $table SET shelter_name=:shelter_name, contact_name=:contact_name, contact_title=:contact_title, 
                street_address=:street_address, city=:city, states_id=:states_id, zip=:zip, phone_number=:phone_numner, 
                email_address=:email, website=:website, logo=:logo, image=:image, county=:county, published=:published,
                open_shelter=:open_shelter, type_shelter=:type_shelter, designated_no_kill=:designated_no_kill, 
                importing_shelter=:importing_shelter, financials=:financials, shelter_data=:shelter_data,
                type_of_entry=:type_of_entry, programs=:programs
                WHERE id = :update_id";
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
            ':type_of_entry' => $data['type-of-entry'],
            ':programs' => $data['programs'],
            ':update_id' => $update_id
        );

        return $query->execute($parameters);
    }

    /**
     * Delete a shelter in the database
     * shelters/deleteShelter/ stuff!
     * @param int $shelter_id Id of shelter
     */
    public function delete($update_id)
    {
        $table = $this->_table;
        $sql = "DELETE FROM $table WHERE id = :update_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':update_id' => $update_id);

        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        return $query->execute($parameters);
    }

    public function getQuantityOfPendingRequest($user_id = null){
        $table = $this->_table;

        if($user_id == null){
            $sql = "SELECT COUNT(*) FROM $table WHERE request_status='pending'";
        }else{
            $sql = "SELECT COUNT(*) FROM $table WHERE request_status='pending' AND user_id='". $user_id ."'";
        }

        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetch(\PDO::FETCH_BOTH);
        return $result[0];
    }

    public function getQuantityOfApprovedRequest($user_id = null){
        $table = $this->_table;

        if($user_id == null){
            $sql = "SELECT COUNT(*) FROM $table WHERE request_status='approved'";
        }else{
            $sql = "SELECT COUNT(*) FROM $table WHERE request_status='approved' AND user_id='". $user_id ."'";
        }

        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetch(\PDO::FETCH_BOTH);
        return $result[0];
    }

    public function changeRequestStatus($update_id, $status){
        $table = $this->_table;
        $sql = "UPDATE $table SET request_status=:status WHERE id = :update_id";
        $query = $this->db->prepare($sql);

        $parameters = array(
            ':update_id' => $update_id,
            ':status' => $status,
        );

        return $query->execute($parameters);
    }

    public function clearImageColumn($update_id, $column = null){
        $table = $this->_table;

        if($column == null){
            $sql = "UPDATE $table SET logo = '' WHERE id = :update_id";
        }else{
            $sql = "UPDATE $table SET $column = '' WHERE id = :update_id";
        }

        $query = $this->db->prepare($sql);
        $parameters = array(
            ':update_id' => $update_id
        );
        return $query->execute($parameters);
    }

}
