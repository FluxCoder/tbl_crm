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
    }



    /**
     *    first_name: 
     *    last_name: 
     *    email: 
     *    phone: 
     *    notes: 
     *
     * @return void
     */
    public function create(){
        $this->load->model('ContactsModel');
        $this->load->helper(['api', 'url']);
        $this->load->library(['customencryption','session','form_validation']);

        // Set validation rules - notes are not required, no point adding that here.
        $this->form_validation->set_rules('first_name', 'First name', 'required');
        $this->form_validation->set_rules('last_name', 'Last name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required');

        // Check form validation
        if ($this->form_validation->run() == FALSE){
            // print_r(validation_errors());
            APIError($this->form_validation->error_array(), true, 'Please fix the issues displayed on the form');
        }

        // Insert that contact into the database, getting the details back from the function might be fun?
        $contact_id = $this->ContactsModel->insert(
            $this->input->post('first_name'),
            $this->input->post('last_name'),
            $this->input->post('email'),
            $this->input->post('phone')
        );

        // Check that we have got something back
        if( ! $contact_id){
            APIError('Something went wrong, please try again later');
        }

        $notes = $this->input->post('notes');

        // Check if we need to create notes or not
        if( ! empty($notes)){
            $this->load->model('NotesModel');

            // Insert new note into the database
            $this->NotesModel->insert($contact_id, $notes);
        }

        // Encrypt the contact id, and then redirect the user to the view contact page
        $encrypted_id = $this->customencryption->encrypt($contact_id);
        APIFinish(['message' => 'New contact created', 'url' =>  '/contacts/view/'.$encrypted_id]);

    }



    public function view($contact_id){
        // Get the contacts information.
    }

}