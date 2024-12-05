<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

	function __construct() {
		parent::__construct ();
		
		$this->load->helper ( 'form' );
		$this->load->helper ( 'url' );
		$this->load->library('session');
	}

	public function index()
	{
		// Check if the user is logged in
		if ($this->session->userdata('user_id')) {
			// Get the user role from the session
			$role = $this->session->userdata('role');

			// Determine the redirection URL based on the user role
			switch ($role) {
				case 'admin':
					$redirect = site_url('admin/dashboard');
					break;
				case 'dfo':
					$redirect = site_url('dfo/dashboard');
					break;
				case 'teacher':
					$redirect = site_url('teacher/dashboard');
					break;
				case 'parent':
					$redirect = site_url('parentcontroller/dashboard');
					break;
				default:
					// If the role doesn't match any, redirect to login (fallback)
					$redirect = site_url('login');
					break;
			}

			// Redirect to the corresponding dashboard based on the user role
			redirect($redirect);
		} else {
			// If the user is not logged in, show the login page
			$this->load->view('login');
		}
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
