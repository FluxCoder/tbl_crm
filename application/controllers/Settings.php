<?php

class Settings extends CI_Controller {

    public function index(){
        $this->load->view('admin/includes/header', ['page_title' => 'Settings']);
        $this->load->view('admin/settings');
        $this->load->view('admin/includes/footer');
    }

}