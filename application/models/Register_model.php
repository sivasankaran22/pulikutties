<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends CI_Model {

    public function check_exists($field, $value) {
        $this->db->where($field, $value);
        $query = $this->db->get('users'); // Replace 'users' with your table name
        return $query->num_rows() > 0; // Returns true if record exists
    }

    public function save_user($data) {
        return $this->db->insert('users', $data); // Replace 'users' with your table name
    }

    public function get_divisions_by_circle($circle_id) {
        $this->db->where('circle_id', $circle_id);
        $query = $this->db->get('division'); // 'divisions' is your table name
        return $query->result_array(); // Return result as an array
    }
}
