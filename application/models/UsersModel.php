<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersModel extends CI_Model {

    /* Columns */
    private $cols = [
        'id',
        'name',
        'email',
        'password'
    ];

    /* Locked columns */
    private $locked_cols = [
        'id'
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
     * Fetch user by a column
     *
     * @param string $col
     * @param string $value
     * @return object|boolean
     */
    public function get_by($col, $value){

        // Check if the col is allowed
        $this->allowed_cols($col);

        // Build query
        $sql = "SELECT * FROM users WHERE $col = ? LIMIT 1";
        $query = $this->db->query($sql, array($value));

        // Check if we have a user to return
        if($query->num_rows() > 0){            
            // Return object version of the response, I prefer objects, coming from Laravel.
            return (object)$query->row();
        } else {
            return false;
        }
    }


    /**
     * Updates password, hashes it first before changing the password in the database
     *
     * @param integer $user_id
     * @param string $password
     * @return void
     */
    public function update_password($user_id, $password){

        // Check if the user ID is valid
        if($this->get_by('id', $user_id)){

            // $sql = 'UPDATE users SET `password` = ? WHERE id = ?';
            // $query = $this->db->query($sql, array($password, $user_id));

            // Load password librarry
            $this->load->library('password');

            // Hash and prepare password for database
            $password_hashed = $this->password->hash($password);

            // Start creating DB query
            $this->db->set('password', $password_hashed);
            $this->db->where('id', $user_id);

            // Update database
            $this->db->update('users'); 

            return true;



        } else {
            return false;
        }

    }

}