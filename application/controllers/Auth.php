<?php

class Auth extends CI_Controller {


    /**
     * Main login function, this is used both for he login proccess and the view.
     * 
     * @note I didn't want to use this for both, but I did :shrug:
     *
     * @return void
     */
    public function login(){

        // Check if this is a post request
        if($this->input->post('email') !== null){
            
            $this->load->model('UsersModel');
            $this->load->helper('api');
            $this->load->library('Password');
            $this->load->library('session');

            // Do login logic here 

            $email = $this->input->post('email');

            $user = $this->UsersModel->get_by('email', $email);

            // Check if we have a user or not
            if($user == null){
                APIError('Incorrect email address or password');
            }

            // Check if passwords match
            $match = $this->password->verify_hash($this->input->post('password'), $user->password);
            
            // Check the if they match
            if($match){
                $this->session->is_logged_in = true;

                $this->session->set_userdata('userid', $user->id);

                // This is set so that if someone changes their password, they are logged out from everywhere.
                $this->session->set_userdata('pwhash', md5($user->password)); 

                APIFinish('Welcome back');
            } else {
                APIError('Incorrect email address or password');
            }

        } else {
            $this->load->view('auth/login');
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