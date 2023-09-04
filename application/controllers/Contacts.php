<?php

class Contacts extends CI_Controller {

    function __construct(){

        // Make sure to have the API response helper
        parent::__construct();
        $this->load->helper('api');
        $this->load->helper('url');
        $this->load->model('UsersModel');
    }

    public function index(){
        $data['page_title'] = 'All contacts';  //assign dynamically
        $this->load->view('admin/includes/header', $data);
        $this->load->view('admin/contacts/index');
        $this->load->view('admin/includes/footer');
        // $this->load->helper('api');
        // $user = $this->UsersModel->get_by('name', 'James');
        // APIFinish('That was awesome, '. $user->password);

        

    }

}