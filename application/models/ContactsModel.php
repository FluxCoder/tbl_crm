<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactsModel extends CI_Model {

    /* Columns */
    private $cols = [
        'id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'created_at'
    ];

    /* Locked columns */
    private $locked_cols = [
        ''
    ];


    /**
     * Check if a column is in the allowed columns array
     *
     * @param string $col
     * @return boolean|void
     */
    function allowed_cols($col){

        // Check if column in allowed
        if(in_array($col, $this->cols)){

            if( ! $this->locked_cols == null){
                if(in_array($col, $this->locked_cols)){
                    die('Disallowed column');
                } else {
                    return true;
                }
            } else {
                return true;
            }

        } else {
            die('Disallowed column');
        }
    }


    /**
     * Loading in required classes
     */
    function __construct(){
        $this->load->database();
    }


    /**
     * Returns most most recently created contacts
     *
     * @param integer $limit
     * @return object
     */
    function get_recent($limit = null){

        // Order by most recently created
        $this->db->order_by('created_at', 'DESC');

        // Check if we are limiting the results
        if( ! $limit == null){
            $this->db->limit($limit);
        }

        // Get contacts from DB
        $query = $this->db->get('contacts');

        return $query->result();
    }


    /**
     * Fetch contact by a column
     *
     * @param string $col
     * @param string $value
     * @return object|boolean
     */
    public function get_by($col, $value){

        // Check if the col is allowed
        $this->allowed_cols($col);

        // Build query
        $sql = "SELECT * FROM contacts WHERE $col = ? LIMIT 1";
        $query = $this->db->query($sql, array($value));

        // Check if we have a contact to return
        if($query->num_rows() > 0){            
            // Return object version of the response, I prefer objects, coming from Laravel.
            return (object)$query->row();
        } else {
            return false;
        }
    }



    /**
     * Creaet a new contact in the database
     *
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $phone
     * @return void
     */
    public function insert($first_name, $last_name, $email, $phone){

        // Insert data into DB with created_at timestamp
        $data = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'phone' => $phone,
                'created_at' => time()
        );
        
        // Insert
        $this->db->insert('contacts', $data);
        
        // Check if we have the ID of the last inserted contact
        $contact_id = $this->db->insert_id();
        if($contact_id == null){
            return false;
        } else {
            return $contact_id;
        }


    }

}