<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Section_model extends CI_Model {

    public function get_all_sections() {
        return $this->db->get('sections')->result_array();
    }
    public function get_all_sections_id($user_id) {
        $this->db->select('us.first_name,us.last_name,s.*');
        $this->db->from('sections s');
        $this->db->join('users us', 'us.id = s.created_by', 'left'); // Left join with circle table
        $this->db->where('s.created_by', $user_id);
        return $this->db->get()->result_array();
    }
    
    public function get_all_sections_by_teacher_id($id) {
        $this->db->where('created_by', $user_id);
        return $this->db->get('sections')->result_array();
    }

    public function get_section_by_id($id) {
        $this->db->select('us.first_name,us.last_name,s.*');
        $this->db->from('sections s');
        $this->db->join('users us', 'us.id = s.created_by', 'left'); // Left join with circle table
        $this->db->where('s.id', $id);
        return $this->db->get()->row_array();
    }


    public function insert_section($data) {
        $this->db->insert('sections', $data);
        return $this->db->insert_id(); 
    }

    public function update_section($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('sections', $data);
    }

    public function delete_section($id,$user_id) {
        $this->db->where('id', $id);
        $this->db->where('created_by', $user_id);
        return $this->db->delete('sections');
    }
}
