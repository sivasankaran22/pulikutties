
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');

        // Ensure user is logged in
        if (!is_logged_in()) {
            redirect('login');
        }
    }

    // Admin dashboard
    public function admin() {
        check_role('admin'); // Only Admins can access
        $this->load->view('dashboard/admin');
    }

    // Teacher dashboard
    public function teacher() {
        check_role('teacher'); // Only Teachers can access
        $this->load->view('dashboard/teacher');
    }

    // Parent dashboard
    public function parent() {
        check_role('parent'); // Only Parents can access
        $this->load->model('Dashboard_model');
        $user = $this->session->userdata('user');
        $data['students'] = $this->Dashboard_model->get_students_by_parent($user['id']);
        $this->load->view('dashboard/parent', $data);
    }
}
