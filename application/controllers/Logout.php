<?php
class Logout extends CI_Controller
{
    public function index()
    {
        // Destroy session data
        $this->session->sess_destroy();

        // Redirect to the login page
        redirect(base_url('login'));
    }
}