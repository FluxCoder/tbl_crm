<?php

class Settings extends CI_Controller {


    /**
     * Index for settings page
     *
     * @return void
     */
    public function index(){
        $this->load->view('admin/includes/header', ['page_title' => 'Settings']);
        $this->load->view('admin/settings');
        $this->load->view('admin/includes/footer');
    }


    /**
     * Updates the user's password, as long as the current password is correct.
     *
     * @return void
     */
    public function update_password(){

        // Make sure that the password fields are filled in.


    }

}