
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('is_logged_in')) {
    function is_logged_in() {
        // Get the instance of the CI framework
        $CI =& get_instance();

        // Check if user session exists (make sure you set this session on successful login)
        return $CI->session->userdata('user_id') ? true : false;
    }
}

// Check if user has the correct role
if (!function_exists('check_role')) {
    function check_role($role) {
        $CI =& get_instance();
        $user_role = $CI->session->userdata('role');
        if ($user_role != $role) {
            // If the user doesn't have the correct role, redirect them
            redirect('login');  // Redirect them to login or another page
        }
    }
}
