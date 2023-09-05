<?php

class Main extends CI_Controller {

    public function index(){
        $this->load->model('ContactsModel');
        $contacts = $this->ContactsModel->get_recent(5);
        $this->load->view('admin/dashboard', ['contacts' => $contacts]);
    }

}