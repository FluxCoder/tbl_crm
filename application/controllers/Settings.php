<?php

class Settings extends CI_Controller {


    /**
     * Index for settings page
     *
     * @return void
     */
    public function index(){

        $this->load->model('UsersModel');
        $this->load->library('session');

        // Get the current logged in user
        $user = $this->UsersModel->get_by('id', $this->session->userdata('user_id'));

        // Load view
        $this->load->view('admin/includes/header', ['page_title' => 'Settings']);
        $this->load->view('admin/settings',['user' => $user]);
        return $this->load->view('admin/includes/footer');

    }


    /**
     * Form submit action for settings form on the settings page
     *
     * @return void
     */
    public function submit(){

        $this->load->model('UsersModel');
        $this->load->helper('api');
        $this->load->library('Password');
        $this->load->library('session');
        $this->load->library('form_validation');


        // Set validation rules
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('new_password', 'New password', 'min_length[5]');
        $this->form_validation->set_rules('re_new_password', 'Re new password', 'matches[new_password]');

        // Check form vlidation
        if ($this->form_validation->run() == FALSE){
            // print_r(validation_errors());
            APIError($this->form_validation->error_array(), true, 'Please fix the issues displayed on the form');
        }
        
        // Update everything apart from the password.
        $this->db->set('name', $this->input->post('name'));
        $this->db->set('email', $this->input->post('email'));

        // Check if we are going to be updating the password
        if( ! $this->input->post('password')  == ''){
            // Check if the password is correct.

            $password = $this->input->post('new_password');

            $match = $this->password->verify_hash($this->input->post('password'), $this->session->userdata('password_hash'));
            if($match){

                // Hash the password
                $password_hashed = $this->password->hash($password);

                // Update the password
                $this->db->set('password', $password_hashed);
                $this->session->set_userdata('password_hash', $password_hashed);

            } else {
                APIError(['password' => 'Password is incorrect'], true, 'Password is incorrect');
            }
        }

        // Set where
        $this->db->where('id', $this->session->userdata('user_id'));

        // Update database
        $this->db->update('users'); 

        // Respond
        APIFinish('Account information has been updated');

    }

}