<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller {

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
        check_role('teacher');

    }

    public function dashboard(){
        $data['count'] = $this->User_model->get_user_counts_by_teacher($this->user_id);

        $this->load->view('teacher/header',$data);
        $this->load->view('teacher/dashboard');
        $this->load->view('teacher/footer');
    }
    
    ////////////////////////////

public function parent(){
    $data["parent_js_script"] = true;
    
    $data['blood_groups'] = get_blood_groups();
    $data['circle'] = $this->User_model->get_circle_by_id($this->circle_id);
    $data['division'] = $this->User_model->get_division_by_id($this->circle_id);
    $data['all_teacher'] = $this->User_model->get_users_by_role_and_parent("teacher",$this->user_id);
    $this->load->view('teacher/header', $data);
    $this->load->view('teacher/parent');
    $this->load->view('teacher/footer');
}

public function parent_edit_profile($user_id){
    $data["parent_js_script_edit"] = true;
    
    $data['user_data'] = $this->User_model->get_user_by_id($user_id);
    $data['blood_groups'] = get_blood_groups();
    $data['circle'] = $this->User_model->get_circle_by_id($this->circle_id);
    $data['division'] = $this->User_model->get_division_by_id($this->circle_id);
    $data['all_teacher'] = $this->User_model->get_users_by_role_and_parent("teacher",$this->user_id);
    $this->load->view('teacher/header', $data);
    $this->load->view('teacher/parent-edit', $data);
    $this->load->view('teacher/footer');
}

public function parent_list(){
    
    $parent['parent'] = $this->User_model->get_active_users_by_my_id_parent("parent",$this->user_id);
    $this->load->view('teacher/header', $data);
    $this->load->view('teacher/parent_list', $parent);
    $this->load->view('teacher/footer');
}

// Controller method for displaying the specific user profile
public function parent_profile($user_id) {
    // Fetch the user's data from the model based on user ID
    $parent['parent_user'] = $this->User_model->get_user_by_id($user_id);
    
    
    // Check if user data exists
    if (empty($parent['parent_user'])) {
        show_404();  // Show 404 if the user is not found
    }
    
    $parent['parent'] = $this->User_model->get_users_by_role_and_parent('parent', $user_id);
    $parent['blood_groups'] = get_blood_groups();
    // Pass user data to the view
    $this->load->view('teacher/header',$data);
    $this->load->view('teacher/parent_profile', $parent);  // Pass user data to the view
    $this->load->view('teacher/footer');
}

public function save_parent() {
    // Load necessary libraries and helpers
    $this->load->library('upload');
    $this->load->model('User_model');  // Make sure to load the model

    // Set upload configuration
    $config['upload_path']   = './assets/img/profile_photo/'; // Path to save the uploaded image
    $config['allowed_types'] = 'jpg|jpeg|png|gif'; // Allowed file types
    $config['max_size']      = 2048; // Max size in KB

    // Initialize the upload library with the config
    $this->upload->initialize($config);

    // Check if the file is uploaded
    if ($this->upload->do_upload('profile_photo')) {
        // File upload was successful
        $upload_data = $this->upload->data();  // Get the uploaded file data

        // Get file path for the database (relative to web root)
        $file_path = 'assets/img/profile_photo/' . $upload_data['file_name'];

        // Prepare the data to insert into the database
        $data = array(
            'first_name'   => $this->input->post('first_name'),
            'last_name'    => $this->input->post('last_name'),
            'email'        => $this->input->post('email'),
            'password'     => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            'role'         => $this->input->post('role'),
            'phone'        => $this->input->post('phone'),
            'DOB'          => $this->input->post('DOB'),
            'blood_group'  => $this->input->post('blood_group'),
            'Address'      => $this->input->post('Address'),
            'state'        => $this->input->post('state'),
            'circle'       => $this->input->post('circle'),
            'division'     => $this->input->post('division'),
            'latitude'     => $this->input->post('latitude'),
            'longitude'    => $this->input->post('longitude'),
            'profile_photo'=> $file_path,
            'active'       => $this->input->post('status'),  // Assuming the user is active by default
            'created_at'   => date('Y-m-d H:i:s')
        );

        // Save the data in the database (using model)
        $user_id = $this->User_model->insert_user($data);
        
        $map_data = array(
            "parent_id" => $this->user_id,
            "child_id" => $user_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        // save map user 
        $map_id = $this->User_model->insert_map($map_data);

        if ($user_id) {
            echo json_encode(['status' => 'success', 'message' => 'User added successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add user']);
        }

    } else {
        // If file upload failed
        echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
    }
}

public function edit_parent($user_id) {
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
        'first_name'   => $this->input->post('first_name'),
        'last_name'    => $this->input->post('last_name'),
        'email'        => $this->input->post('email'),
        'role'         => $this->input->post('role'),
        'phone'        => $this->input->post('phone'),
        'DOB'          => $this->input->post('DOB'),
        'blood_group'  => $this->input->post('blood_group'),
        'Address'      => $this->input->post('Address'),
        'state'        => $this->input->post('state'),
        'circle'       => $this->input->post('circle'),
        'division'     => $this->input->post('division'),
        'latitude'     => $this->input->post('latitude'),
        'longitude'    => $this->input->post('longitude'),
        'active'       => $this->input->post('status'),  // Assuming the user is active by default
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
    
    
    $map_data = array(
        "parent_id" => $this->user_id,
        "child_id" => $user_id,
        'updated_at' => date('Y-m-d H:i:s')
    );
    $map_id_old = $this->input->post('old_map_id');
    // save map user 
    $map_id = $this->User_model->update_map($map_id_old, $map_data);

    if ($update_status) {
        echo json_encode(['status' => 'success', 'message' => 'User updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update user']);
    }
}

   ////////////////////////////

public function child(){
    $data["child_js_script"] = true;
    
    $data['blood_groups'] = get_blood_groups();
    $data['gender'] = get_gender();
    $data['school_standards'] = $this->User_model->get_school_standards();
    $data['all_parent'] = $this->User_model->get_all_users_by_teacher("parent",$this->user_id);
    $this->load->view('teacher/header', $data);
    $this->load->view('teacher/child');
    $this->load->view('teacher/footer');
}

public function child_edit_profile($child_id){
    $data["child_js_script_edit"] = true;
    
    $data['child_data'] = $this->User_model->get_child_by_id($child_id);
    $data['blood_groups'] = get_blood_groups();    
    $data['gender'] = get_gender();
    $data['school_standards'] = $this->User_model->get_school_standards();
    $data['all_parent'] = $this->User_model->get_all_users_by_teacher("parent",$this->user_id);
    $this->load->view('teacher/header', $data);
    $this->load->view('teacher/child-edit', $data);
    $this->load->view('teacher/footer');
}

public function child_list(){
    
    $child['child'] = $this->User_model->get_active_child_by_teacher($this->user_id);
    $this->load->view('teacher/header', $data);
    $this->load->view('teacher/child_list', $child);
    $this->load->view('teacher/footer');
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
    $this->load->view('teacher/header',$data);
    $this->load->view('teacher/child_profile', $child);  // Pass user data to the view
    $this->load->view('teacher/footer');
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
        'parent_id'       => $this->input->post('parent_id'),
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
        'parent_id'       => $this->input->post('parent_id'),
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


   ////////////////////////////

   public function attendees(){

    $data["attendees_js_script"] = true;
    $data['all_child'] = $this->User_model->get_all_child_by_teacher($this->user_id);
    $data['dfo_id'] = $this->User_model->get_dfo_id_by_teacher_id($this->user_id);
    $data['section'] = $this->Section_model->get_all_sections_id($data['dfo_id']);
    $this->load->view('teacher/header', $data);
    $this->load->view('teacher/attendees');
    $this->load->view('teacher/footer');
}

public function attendees_edit_profile($section_id){
    $data["attendees_js_script_edit"] = true;
    $data['attendees'] = $this->User_model->get_attendees_section_details_by_id($section_id);
    $data['all_child'] = $this->User_model->get_all_child_by_teacher($this->user_id);
    $data['dfo_id'] = $this->User_model->get_dfo_id_by_teacher_id($this->user_id);
    $data['section'] = $this->Section_model->get_all_sections_id($data['dfo_id']);
    $this->load->view('teacher/header', $data);
    $this->load->view('teacher/attendees-edit');
    $this->load->view('teacher/footer');
}

public function attendees_list(){
    
    $attend['attend'] = $this->User_model->get_attended_child_by_teacher($this->user_id);
    $this->load->view('teacher/header', $data);
    $this->load->view('teacher/attendees_list', $attend);
    $this->load->view('teacher/footer');
}

// Controller method for displaying the specific user profile
public function attendees_profile($section_id) {
    // Fetch the user's data from the model based on user ID
    $detail['attend_detail'] = $this->User_model->get_section_attended_detail_by_id($section_id);
    
    
    // Check if user data exists
    if (empty($detail['attend_detail'])) {
        show_404();  // Show 404 if the user is not found
    }
    // Pass user data to the view
    $this->load->view('teacher/header',$data);
    $this->load->view('teacher/attendees_profile', $detail);  // Pass user data to the view
    $this->load->view('teacher/footer');
}

public function save_attendees() {
    // Load upload library
    $config['upload_path']   = './assets/img/sections/';
    $config['allowed_types'] = 'jpg|jpeg|png|gif'; // Allowed file types
    $config['max_size']      = 2048; // Max size in KB (2MB)
    $config['encrypt_name']  = true; // Use unique file names
    
    $this->load->library('upload', $config);

    $file_names = [];
    $files = $_FILES['section_details'];
    
    if (!empty($files['name'][0])) {
        // Loop through each file
        for ($i = 0; $i < count($files['name']); $i++) {
            $_FILES['file']['name']     = $files['name'][$i];
            $_FILES['file']['type']     = $files['type'][$i];
            $_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
            $_FILES['file']['error']    = $files['error'][$i];
            $_FILES['file']['size']     = $files['size'][$i];

            // Initialize upload for each file
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {
                // Successfully uploaded
                $upload_data = $this->upload->data();
                $file_names[] = $upload_data['file_name']; // Save file name
            } else {
                // Handle upload error
                echo $this->upload->display_errors();
                return;
            }
        }
    }

    // Save to database
    $data = [
        'section_id' => $this->input->post('section_id'),
        'dfo_id'     => $this->input->post('dfo_id'),
        'teacher_id'     => $this->user_id,
        'parent_id'     => $this->input->post('parent_id'),
        'child_id'   => $this->input->post('child_id'),
        'section_details' => json_encode($file_names), // Store file names as JSON
    ];

    $result = $this->User_model->insert_attendees($data);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Section documents details uploaded successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to uploaded documents']);
    }
}



public function edit_attendees($id) {
    // Load upload library
    $config['upload_path']   = './assets/img/sections/';
    $config['allowed_types'] = 'jpg|jpeg|png|gif'; // Allowed file types
    $config['max_size']      = 2048; // Max size in KB (2MB)
    $config['encrypt_name']  = true; // Use unique file names
    
    $this->load->library('upload', $config);

    $file_names = [];
    $files = $_FILES['section_details'];
    
    if (!empty($files['name'][0])) {
        // Loop through each file
        for ($i = 0; $i < count($files['name']); $i++) {
            $_FILES['file']['name']     = $files['name'][$i];
            $_FILES['file']['type']     = $files['type'][$i];
            $_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
            $_FILES['file']['error']    = $files['error'][$i];
            $_FILES['file']['size']     = $files['size'][$i];

            // Initialize upload for each file
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {
                // Successfully uploaded
                $upload_data = $this->upload->data();
                $file_names[] = $upload_data['file_name']; // Save file name
            } else {
                // Handle upload error
                echo $this->upload->display_errors();
                return;
            }
        }
    }
    
    // Save to database
    $data = [
        'section_id' => $this->input->post('section_id'),
        'dfo_id'     => $this->input->post('dfo_id'),
        'parent_id'     => $this->input->post('parent_id'),
        'child_id'   => $this->input->post('child_id')
    ];
    if(!empty($file_names)){

        $data["section_details"] = json_encode($file_names);
    }

    $result = $this->User_model->update_attendees($id,$data);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Section documents details updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to updated documents']);
    }
}


public function attendees_delete($id) {
    $this->User_model->delete_attendees($id,$this->user_id);
    redirect($_SERVER['HTTP_REFERER']);
}


//////////////////

public function section_list(){

    $dfo_id = $this->User_model->get_dfo_id_by_teacher_id($this->user_id);
    $section = array();
    if($dfo_id!=NULL){
        $section['section'] = $this->Section_model->get_all_sections_id($dfo_id);
    }
    $this->load->view('teacher/header', $data);
    $this->load->view('teacher/section_list', $section);
    $this->load->view('teacher/footer');
}



public function section_details($section_id) {
    // Fetch the user's data from the model based on user ID
    $section['section'] = $this->Section_model->get_section_by_id($section_id);
    
    print_r($section[0]);
    // Check if user data exists
    if (empty($section['section'])) {
        show_404();  // Show 404 if the user is not found
    }
    // Pass user data to the view
    $this->load->view('teacher/header',$data);
    $this->load->view('teacher/section_details', $section);  // Pass user data to the view
    $this->load->view('teacher/footer');
}


    

public function user_edit_profile(){
    $data["user_js_script_edit"] = true;
    
    $user_id = $this->session->userdata('user_id');
    $data['user_data'] = $this->User_model->get_user_by_id($user_id);    
    $data['blood_groups'] = get_blood_groups();
    $data['circle'] = $this->User_model->get_circle_by_id($this->circle_id);
    $data['division'] = $this->User_model->get_division_by_id($this->circle_id);

    $this->load->view('teacher/header', $data);
    $this->load->view('teacher/profile-edit');
    $this->load->view('teacher/footer');
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