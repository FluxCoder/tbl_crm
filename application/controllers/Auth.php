<?php

class Auth extends CI_Controller {


    /**
     * Main login function, this is used both for he login proccess and the view.
     * 
     * @note I didn't want to use this for both view/form submit, but I did :shrug:
     *
     * @return void
     */
    public function login($action = null){

        // Check if the action is set, and if it's not what we want, just display the login page
        if( is_null($action) ||  $action !== 'submit'){
            return $this->load->view('auth/login');
        }

        
        
        /**
         * Use the CodeIgniter form validation function
         * 
         * @notes I've changed a lot within this function, cleaned it up a lot, and I'd like to
         *        to think that I've also made it much more secure than the last revision.
         * 
         * @since 1.0.1
         */
        $this->load->model('UsersModel');
        $this->load->helper('api');
        $this->load->library('Password');
        $this->load->library('session');
        $this->load->library('form_validation');
        // print_r($this->password->hash('password123'));

        // Set validaiton rules
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        // Validate the form, and check for errors
        if ($this->form_validation->run() == FALSE && $action == 'submit'){
            // print_r(validation_errors());
            APIError($this->form_validation->error_array(), true, 'Please fix the issues displayed on the form');
        }

        // Check if the email address exists in the database
        $user = $this->UsersModel->get_by('email', $this->input->post('email'), true);

        // Check if we have a user or not
        if($user == null){
            APIError('Incorrect email address or password');
        }

        // Check if passwords match
        $match = $this->password->verify_hash($this->input->post('password'), $user->password);

        // Check the if they match
        if($match){
            // Set session data
            $this->session->is_logged_in = true;
            $this->session->set_userdata('user_id', $user->id);
            $this->session->set_userdata('password_hash', md5($user->password));

            // This is set so that if someone changes their password, they are logged out from everywhere.
            $this->session->set_userdata('pwhash', md5($user->password)); 

            APIFinish('Welcome back');
        } else {
            APIError('Incorrect email address or password');
        }

    }


    /**
     * Logout function that will destory the session and redirect the user back to the login page
     *
     * @return void
     */
    public function logout(){
        $this->load->library('session');
        $this->load->helper('url');

        // Delete session data
        $this->session->sess_destroy();

        // Redirect back to the login page
        redirect('/auth/login');
    }

}