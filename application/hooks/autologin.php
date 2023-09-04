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
        if (!$this->CI->session->is_logged_in) {

            // If they are not logged in, then redirct them to the auth page, if they are not already on it.
            if (!in_array(strtolower($this->CI->router->fetch_class()), ['auth'])) {

                // Redirect the user to the login page
                redirect('auth/login');
            }
        }

        // Check if they are logged in and are viewing the login page, we should redirect them automatically.
        if ($this->CI->session->is_logged_in) {

            // If they are not logged in, then redirct them to the auth page, if they are not already on it.
            if (in_array(strtolower($this->CI->router->fetch_class()), ['auth']) && $this->CI->router->fetch_method() !== 'logout') {

                // Redirect the user to the login page
                redirect('/');
            }
        }

    }
}
