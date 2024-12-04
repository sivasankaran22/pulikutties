<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function is_logged_in() {
    // check user is logged in else redirect to login
    $CI =& get_instance();
    // We need to use $CI->session instead of $this->session
    $user = $CI->session->userdata('user_id');
    if (!isset($user)) {
        redirect(base_url());
    } else {
        return true;
    }
}