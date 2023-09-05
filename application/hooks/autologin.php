<?php


/**
 * This hook is used to check if the user is logged in, this is the main point where all the auth checks are done.
 */
class autologin
{
    protected $CI;

    public function __construct(){
        $this->CI = &get_instance();
        $this->CI->load->library('session');
        $this->CI->load->helper('url');
    }

    /**
     * Checks if a user is logged in & if viewing an auth page
     *
     * @return void
     */
    public function check(){

        // Check if there is a user logged in.
        if (!$this->userLoggedIn()) {

            // If they are not logged in, then redirct them to the auth page, if they are not already on it.
            if (!in_array(strtolower($this->CI->router->fetch_class()), ['auth'])) {

                // Redirect the user to the login page
                redirect('auth/login');
            }
        }

        // Check if they are logged in and are viewing the login page, we should redirect them automatically.
        if ($this->userLoggedIn()) {

            // If they are not logged in, then redirct them to the auth page, if they are not already on it.
            if (in_array(strtolower($this->CI->router->fetch_class()), ['auth']) && $this->CI->router->fetch_method() !== 'logout') {

                // Redirect the user to the login page
                redirect('/');
            }
        }

    }

    /**
     * Checks if a user is logged in, also checks if the current session password hash is valid or not
     *
     * @return boolean
     */
    public function userLoggedIn(){
        
        if ($this->CI->session->is_logged_in) {
            // Check password, if the password is not correct, logout the user.
            if($this->passwordCheck()){
                return true;
            } else {
                $this->CI->load->library('session');
                $this->CI->load->helper('url');
        
                // Delete session data
                $this->CI->session->sess_destroy();
        
                // Redirect back to the login page
                redirect('/auth/login');
            }
        } else {
            return false;
        }

    }


    /**
     * Checks if the currently logged in user has the corect password hash
     *
     * @return void
     */
    function passwordCheck(){
        $this->CI->load->model('UsersModel');

        // Check if user is logged in first (If we need to)
        if($this->CI->session->userdata('user_id') !== null){
            // Get password hash
            $password_session_hash = $this->CI->session->userdata('password_hash');
            
            // Get the user
            $user = $this->CI->UsersModel->get_by('id', $this->CI->session->userdata('user_id'));

            // Check if we actually have the user
            if( ! $user){
                return false;
            }

        // Check if hte password hashes match
            $password_hash = md5($user->password);

            if($password_hash == $password_session_hash){
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }

    }
}
