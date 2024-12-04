<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Register extends CI_Controller {

	function __construct() {
		parent::__construct ();
		$this->load->model('Register_model');
		$this->load->helper ( 'form' );
		$this->load->helper ( 'url' );
	}

	public function index()
	{
		$this->load->view('/register');
		/* if($this->session->userdata('role_type') !='ADMIN'){
		}else{
			redirect('login');	
		}	 */
	}

    public function check_unique() {
        $field = $this->input->post('field');
        $value = $this->input->post('value');

        $exists = $this->Register_model->check_exists($field, $value);
        echo json_encode(['exists' => $exists]);
    }

    public function save_user() {
        $data = [
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT), // Encrypt the password
            'role' => "teacher" // Optional, depending on your setup
        ];

        $inserted = $this->Register_model->save_user($data);

        if ($inserted) {
            echo json_encode(['status' => 'success', 'redirect' => site_url('login')]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save data.']);
        }
    }

    public function get_divisions_by_circle() {
        $circle_id = $this->input->post('circle_id'); // Get circle ID from AJAX request    
        $divisions = $this->Register_model->get_divisions_by_circle($circle_id); // Fetch divisions
    
        // Return data as JSON
        echo json_encode($divisions);
    }

}
