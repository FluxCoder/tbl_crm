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
     * Fetch user by a column
     *
     * @param string $col
     * @param string $value
     * @return object
     */
    public function get_by($col, $value){

        // Check if the col is allowed
        $this->allowed_cols($col);

        // Load database
        $this->load->database();

        // Build query
        $sql = "SELECT * FROM users WHERE $col = ? LIMIT 1";
        $query = $this->db->query($sql, array($value));

        // Return object version of the response, I prefer objects, coming from Laravel.
        return (object)$query->row();
    }

}