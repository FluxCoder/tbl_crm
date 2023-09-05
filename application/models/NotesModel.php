<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotesModel extends CI_Model {

    /* Columns - If you're reading this, these are for the get_by function, I did intend to use it for other stuff, but it's not really needed */
    private $cols = [
        'id',
        'contact_id',
        'created_by',
        'updated_by'
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
     * Fetch note by a column
     *
     * @param string $col
     * @param string $value
     * @return object|boolean
     */
    public function get_by($col, $value){

        // Check if the col is allowed
        $this->allowed_cols($col);

        // Build query
        $sql = "SELECT * FROM notes WHERE $col = ? LIMIT 1";
        $query = $this->db->query($sql, array($value));

        // Check if we have a note to return
        if($query->num_rows() > 0){            
            // Return object version of the response, I prefer objects, coming from Laravel.
            return (object)$query->row();
        } else {
            return false;
        }
    }




    /**
     * Inserts a new note into the database, but it'll first encrypt the notes contents, because why not.
     *
     * @param integer $contact_id
     * @param string $content
     * @param integer $created_by
     * @return mixed
     */
    public function insert($contact_id, $content, $created_by = null){
        $this->load->library('customencryption');

        // Check if we need to get the created_by id
        if($created_by == null){
            $this->load->library('session');
            $created_by = $this->session->userdata('user_id');
        }

        // Insert data into DB with created_at timestamp
        $data = array(
                'contact_id' => $contact_id,
                'content' => $this->customencryption->encrypt($content),
                'created_by' => $created_by,
                'created_at' => time()
        );
        
        // Insert
        $this->db->insert('notes', $data);
        
        // Check if we have the ID of the last inserted note
        $note_id = $this->db->insert_id();
        if($note_id == null){
            return false;
        } else {
            return $note_id;
        }


    }

}