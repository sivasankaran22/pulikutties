<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ParentController extends CI_Controller {

    protected $user_id; 
    protected $circle_id; 


    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('auth');
        $this->load->helper('common');
        if (!is_logged_in()) {
            redirect('login');
        }
        
        $this->user_id = $this->session->userdata('user_id');
        $this->circle_id = $this->session->userdata('circle_id');
        $this->load->model('User_model');        
        $this->load->model('Section_model');
        check_role('parent');

    }

    public function dashboard(){
        $data['count'] = $this->User_model->get_user_counts_by_parent($this->user_id);

        $this->load->view('parent/header',$data);
        $this->load->view('parent/dashboard');
        $this->load->view('parent/footer');
    }
    

   ////////////////////////////

public function child(){
    $data["child_js_script"] = true;
    
    $data['blood_groups'] = get_blood_groups();
    $data['gender'] = get_gender();
    $data['school_standards'] = $this->User_model->get_school_standards();
    $this->load->view('parent/header', $data);
    $this->load->view('parent/child');
    $this->load->view('parent/footer');
}

public function child_edit_profile($child_id){
    $data["child_js_script_edit"] = true;
    
    $data['child_data'] = $this->User_model->get_child_by_id($child_id);
    $data['blood_groups'] = get_blood_groups();    
    $data['gender'] = get_gender();
    $data['school_standards'] = $this->User_model->get_school_standards();
    $this->load->view('parent/header', $data);
    $this->load->view('parent/child-edit', $data);
    $this->load->view('parent/footer');
}

public function child_list(){
    
    $child['child'] = $this->User_model->get_active_child_by_parent($this->user_id);
    $this->load->view('parent/header', $data);
    $this->load->view('parent/child_list', $child);
    $this->load->view('parent/footer');
}

// Controller method for displaying the specific user profile
public function child_profile($user_id) {
    // Fetch the user's data from the model based on user ID
    $child['child_user'] = $this->User_model->get_child_by_id($user_id);
    
    
    // Check if user data exists
    if (empty($child['child_user'])) {
        show_404();  // Show 404 if the user is not found
    }
    $child['blood_groups'] = get_blood_groups();
    // Pass user data to the view
    $this->load->view('parent/header',$data);
    $this->load->view('parent/child_profile', $child);  // Pass user data to the view
    $this->load->view('parent/footer');
}

public function save_child() {
    // Load necessary libraries and helpers
    $this->load->library('upload');
    $this->load->model('User_model');  // Load the model

    $file_path = null; // Default file path if no file is uploaded

    // Set upload configuration
    $config['upload_path']   = './assets/img/profile_photo/'; // Path to save the uploaded image
    $config['allowed_types'] = 'jpg|jpeg|png|gif'; // Allowed file types
    $config['max_size']      = 2048; // Max size in KB

    // Initialize the upload library with the config
    $this->upload->initialize($config);

    // Check if a file is uploaded
    if (!empty($_FILES['profile_photo']['name'])) {
        if ($this->upload->do_upload('profile_photo')) {
            // File upload was successful
            $upload_data = $this->upload->data();
            $file_path = 'assets/img/profile_photo/' . $upload_data['file_name'];
        } else {
            // If file upload failed
            echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
            return;
        }
    }

    // Prepare the data to insert into the database
    $data = array(
        'full_name'       => $this->input->post('full_name'),
        'dob'             => $this->input->post('DOB'),
        'blood_group'     => $this->input->post('blood_group'),
        'gender'          => $this->input->post('gender'),
        'parent_id'       => $this->user_id,
        'school_standards_id'=> $this->input->post('school_standards'),
        'profile_photo'   => $file_path
    );

    // Save the data in the database
    $result = $this->User_model->insert_child($data);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Child added successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add child']);
    }
}


public function edit_child($child_id) {
    // Load necessary libraries and helpers
    $this->load->library('upload');
    $this->load->model('User_model');  // Make sure to load the model
    
    // Set upload configuration
    $config['upload_path']   = './assets/img/profile_photo/'; // Path to save the uploaded image
    $config['allowed_types'] = 'jpg|jpeg|png|gif'; // Allowed file types
    $config['max_size']      = 2048; // Max size in KB
    
    // Initialize the upload library with the config
    $this->upload->initialize($config);

    // Prepare data to be updated
    $data = array(
        'full_name'       => $this->input->post('full_name'),
        'dob'             => $this->input->post('DOB'),
        'blood_group'     => $this->input->post('blood_group'),
        'gender'          => $this->input->post('gender'),
        'parent_id'       => $this->user_id,
        'school_standards_id'=> $this->input->post('school_standards')
    );
    
    // Check if a new profile photo is uploaded
    if ($this->upload->do_upload('profile_photo')) {
        // File upload was successful
        $upload_data = $this->upload->data();  // Get the uploaded file data
        $file_path = 'assets/img/profile_photo/' . $upload_data['file_name'];
        $data['profile_photo'] = $file_path; // Set the new profile photo
    }
    
    // Update the user data in the database (using model)
    $update_status = $this->User_model->update_child($child_id, $data);
    
    if ($update_status) {
        echo json_encode(['status' => 'success', 'message' => 'Child updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update user']);
    }
}


//////////////////

public function section_list(){
    
    $section['section'] = $this->Section_model->get_all_sections();
    $this->load->view('parent/header', $data);
    $this->load->view('parent/section_list', $section);
    $this->load->view('parent/footer');
}

public function section_details($section_id) {
    // Fetch the user's data from the model based on user ID
    $section['section'] = $this->Section_model->get_section_by_id($section_id);
    
    
    // Check if user data exists
    if (empty($section['section'])) {
        show_404();  // Show 404 if the user is not found
    }
    // Pass user data to the view
    $this->load->view('parent/header',$data);
    $this->load->view('parent/section_details', $section);  // Pass user data to the view
    $this->load->view('parent/footer');
}

public function section_edit_profile($section_id){
    $data["section_js_script_edit"] = true;
    
    $data['section_data'] = $this->Section_model->get_section_by_id($section_id);
    $this->load->view('parent/header', $data);
    $this->load->view('parent/section-edit', $data);
    $this->load->view('parent/footer');
}

public function user_edit_profile(){
    $data["user_js_script_edit"] = true;
    
    $user_id = $this->session->userdata('user_id');
    $data['user_data'] = $this->User_model->get_user_by_id($user_id);    
    $data['blood_groups'] = get_blood_groups();
    $data['circle'] = $this->User_model->get_circle_by_id($this->circle_id);
    $data['division'] = $this->User_model->get_division_by_id($this->circle_id);

    $this->load->view('parent/header', $data);
    $this->load->view('parent/profile-edit');
    $this->load->view('parent/footer');
}


public function edit_your_profile() {
    // Load necessary libraries and helpers
    $this->load->library('upload');
    $this->load->model('User_model');  // Make sure to load the model
    $user_id = $this->session->userdata('user_id');
    // Set upload configuration
    $config['upload_path']   = './assets/img/profile_photo/'; // Path to save the uploaded image
    $config['allowed_types'] = 'jpg|jpeg|png|gif'; // Allowed file types
    $config['max_size']      = 2048; // Max size in KB
    
    // Initialize the upload library with the config
    $this->upload->initialize($config);

    // Prepare data to be updated
    $data = array(
        'first_name'   => $this->input->post('first_name'),
        'last_name'    => $this->input->post('last_name'),
        'DOB'          => $this->input->post('DOB'),
        'blood_group'  => $this->input->post('blood_group'),
        'Address'      => $this->input->post('Address'),
        'state'        => $this->input->post('state'),
        'circle'       => $this->input->post('circle'),
        'division'     => $this->input->post('division'),
        'latitude'     => $this->input->post('latitude'),
        'longitude'    => $this->input->post('longitude'),
    );
    
    // Check if a new profile photo is uploaded
    if ($this->upload->do_upload('profile_photo')) {
        // File upload was successful
        $upload_data = $this->upload->data();  // Get the uploaded file data
        $file_path = 'assets/img/profile_photo/' . $upload_data['file_name'];
        $data['profile_photo'] = $file_path; // Set the new profile photo
    }
    
    // Update the user data in the database (using model)
    $update_status = $this->User_model->update_user($user_id, $data);
    
    if ($update_status) {
        echo json_encode(['status' => 'success', 'message' => 'User updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update user']);
    }
}
}