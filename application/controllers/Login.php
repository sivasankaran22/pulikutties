<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

	function __construct() {
		parent::__construct ();
		
		$this->load->helper ( 'form' );
		$this->load->helper ( 'url' );
	}

	public function index()
	{
		$this->load->view('/login');
		/* if($this->session->userdata('role_type') !='ADMIN'){
		}else{
			redirect('login');	
		}	 */
	}

	public function authenticate()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		// Load your user model
		$this->load->model('User_model');

		// Check user credentials
		$user = $this->User_model->check_login($email, $password);

		if ($user) {

			$this->session->set_userdata('user_id', $user->id);
            $this->session->set_userdata('email', $user->email);
			$this->session->set_userdata('username', ($user->first_name." ".$user->last_name));
            $this->session->set_userdata('role', $user->role);
            $this->session->set_userdata('circle_id', $user->circle);
            $this->session->set_userdata('division_id', $user->division);
            $this->session->set_userdata('profile_image', $user->profile_photo);
			$redirect = '';
			switch ($user->role) {
                case 'admin':
                    $redirect=site_url('admin/dashboard');
                    break;
                case 'dfo':
                    $redirect=site_url('dfo/dashboard');
                    break;
                case 'teacher':
                    $redirect=site_url('teacher/dashboard');
                    break;
                case 'parent':
                    $redirect=site_url('parentcontroller/dashboard');
                    break;
                case 'student':
                    $redirect=site_url('student/dashboard');
                    break;
                default:
				$redirect=site_url('login');
                    break;
            }


			echo json_encode([
				'status' => 'success',
				'redirect_url' => $redirect // Replace with your dashboard URL
			]);
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'Invalid email or password.'
			]);
		}
	}


	public function logout()
	{
		session_destroy();
		redirect(base_url());
	}


}
