<?php
class User_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function check_login($email, $password)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('users'); // Replace 'users' with your table name

        if ($query->num_rows() == 1) {
            $user = $query->row();
            // Assuming passwords are hashed
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
        return false;
    }

     // Function to get active users
     public function get_active_users($role) {

        $this->db->select('us.*,us.id as user_id, c.circle as circle_name, d.division as division_name');
        $this->db->from('users us');
        $this->db->join('circle c', 'us.circle = c.id', 'left'); // Left join with circle table
        $this->db->join('division d', 'us.division = d.id', 'left');
        $this->db->where('us.role', $role); // Condition to get only active users
        $query = $this->db->get();
        
        // Return the result as an array
        return $query->result_array();
    }

    public function get_map_user_ids($user_id) {
        // Fetch child IDs securely
        if (is_array($user_id)) {
            // If $user_id is an array, use IN clause
            $query_ids = $this->db->query("SELECT child_id FROM mappings WHERE parent_id IN ?", [$user_id]);
        } else {
            // If $user_id is a single value, use =
            $query_ids = $this->db->query("SELECT child_id FROM mappings WHERE parent_id = ?", [$user_id]);
        }
        $child_ids = $query_ids->result_array();
        // Extract child IDs into a single array
        $ids_array = array_column($child_ids, 'child_id');
        
        // Return IDs or an empty array
        return !empty($ids_array) ? $ids_array : [];
    }
    public function get_dfo_id_by_teacher_id($user_id) {
        // Fetch parent_id using query builder
        $this->db->select('parent_id');
        $this->db->from('mappings');
        $this->db->where('child_id', $user_id);
        $query = $this->db->get();
    
        // Return the result as an array or null if no data
        $result = $query->row_array();
        return $result ? $result['parent_id'] : null;
    }
    
    
    public function get_active_users_by_my_id($role, $user_id) {
        // Get mapped user IDs
        $ids = $this->get_map_user_ids($user_id);
        // Check if IDs are empty
        if (empty($ids)) {
            return []; // Return an empty result if no IDs are found
        }
        if($role=='parent'){
            $ids = $this->get_map_user_ids($ids);
        }
        if (empty($ids)) {
            return []; // Return an empty result if no IDs are found
        }
    
        // Build query
        $this->db->select('us.*, us.id as user_id, c.circle as circle_name, d.division as division_name');
        $this->db->from('users us');
        $this->db->join('circle c', 'us.circle = c.id', 'left'); // Left join with circle table
        $this->db->join('division d', 'us.division = d.id', 'left');
        $this->db->where('us.role', $role); // Filter by role
        $this->db->where_in('us.id', $ids); // Filter by mapped user IDs
    
        $query = $this->db->get();
    
        // Return the result as an array
        return $query->result_array();
    }

    public function get_active_users_by_my_id_parent($role, $user_id) {
        // Get mapped user IDs
        $ids = $this->get_map_user_ids($user_id);
        // Check if IDs are empty
        if (empty($ids)) {
            return []; // Return an empty result if no IDs are found
        }
        // Build query
        $this->db->select('us.*, us.id as user_id, c.circle as circle_name, d.division as division_name');
        $this->db->from('users us');
        $this->db->join('circle c', 'us.circle = c.id', 'left'); // Left join with circle table
        $this->db->join('division d', 'us.division = d.id', 'left');
        $this->db->where('us.role', $role); // Filter by role
        $this->db->where_in('us.id', $ids); // Filter by mapped user IDs
    
        $query = $this->db->get();
    
        // Return the result as an array
        return $query->result_array();
    }

     // Function to get active users
     public function get_active_child() {

        $this->db->select('chd.full_name,chd.id as child_id, us.*,us.id as user_id, c.circle as circle_name, d.division as division_name');
        $this->db->from('child chd');
        $this->db->join('users us', 'chd.parent_id = us.id', 'left'); // Left join with circle table
        $this->db->join('circle c', 'us.circle = c.id', 'left'); // Left join with circle table
        $this->db->join('division d', 'us.division = d.id', 'left');
        $this->db->where('us.role', 'parent'); // Condition to get only active users
        $query = $this->db->get();
        
        // Return the result as an array
        return $query->result_array();
    }

     // Function to get active users
     public function get_all_child_by_teacher($user_id) {

        // Get mapped user IDs
        $ids = $this->get_map_user_ids($user_id);
        // Check if IDs are empty
        if (empty($ids)) {
            return []; // Return an empty result if no IDs are found
        }
       
        $this->db->select('chd.full_name,chd.id as child_id, us.first_name, us.last_name,us.id as parent_id, c.circle as circle_name, d.division as division_name');
        $this->db->from('child chd');
        $this->db->join('users us', 'chd.parent_id = us.id', 'left'); // Left join with circle table
        $this->db->join('circle c', 'us.circle = c.id', 'left'); // Left join with circle table
        $this->db->join('division d', 'us.division = d.id', 'left');
        $this->db->where('us.role', 'parent'); // Condition to get only active users
        $this->db->where_in('chd.parent_id', $ids); // Filter by mapped user IDs
        $query = $this->db->get();
        
        // Return the result as an array
        return $query->result_array();
    }


     // Function to get active users
     public function get_active_child_by_dfo($user_id) {

        // Get mapped user IDs
        $ids = $this->get_map_user_ids($user_id);
        // Check if IDs are empty
        if (empty($ids)) {
            return []; // Return an empty result if no IDs are found
        }
       
        $ids = $this->get_map_user_ids($ids);
        
        if (empty($ids)) {
            return []; // Return an empty result if no IDs are found
        }

        $this->db->select('chd.full_name,chd.id as child_id, us.*,us.id as user_id, c.circle as circle_name, d.division as division_name');
        $this->db->from('child chd');
        $this->db->join('users us', 'chd.parent_id = us.id', 'left'); // Left join with circle table
        $this->db->join('circle c', 'us.circle = c.id', 'left'); // Left join with circle table
        $this->db->join('division d', 'us.division = d.id', 'left');
        $this->db->where('us.role', 'parent'); // Condition to get only active users
        $this->db->where_in('chd.parent_id', $ids); // Filter by mapped user IDs
        $query = $this->db->get();
        
        // Return the result as an array
        return $query->result_array();
    }

     // Function to get active users
     public function get_active_child_by_teacher($user_id) {
       
        $ids = $this->get_map_user_ids($user_id);
        if (empty($ids)) {
            return []; // Return an empty result if no IDs are found
        }

        $this->db->select('chd.full_name,chd.id as child_id, us.*,us.id as user_id, c.circle as circle_name, d.division as division_name');
        $this->db->from('child chd');
        $this->db->join('users us', 'chd.parent_id = us.id', 'left'); // Left join with circle table
        $this->db->join('circle c', 'us.circle = c.id', 'left'); // Left join with circle table
        $this->db->join('division d', 'us.division = d.id', 'left');
        $this->db->where('us.role', 'parent'); // Condition to get only active users
        $this->db->where_in('chd.parent_id', $ids); // Filter by mapped user IDs
        $query = $this->db->get();
        
        // Return the result as an array
        return $query->result_array();
    }

     // Function to get active users
     public function get_active_child_by_parent($user_id) {
       
        $this->db->select('chd.full_name,chd.id as child_id, us.*,us.id as user_id, c.circle as circle_name, d.division as division_name');
        $this->db->from('child chd');
        $this->db->join('users us', 'chd.parent_id = us.id', 'left'); // Left join with circle table
        $this->db->join('circle c', 'us.circle = c.id', 'left'); // Left join with circle table
        $this->db->join('division d', 'us.division = d.id', 'left');
        $this->db->where('us.role', 'parent'); // Condition to get only active users
        $this->db->where_in('chd.parent_id', $user_id); // Filter by mapped user IDs
        $query = $this->db->get();
        
        // Return the result as an array
        return $query->result_array();
    }

    public function get_user_by_id($user_id) {
        // Perform query to get user data by user ID
        $this->db->select('us.*, c.circle as circle_name, d.division as division_name, m.parent_id, m.id as map_id');
        $this->db->from('users us');
        $this->db->join('circle c', 'us.circle = c.id', 'left');  // Left join with circle table
        $this->db->join('division d', 'us.division = d.id', 'left');  // Left join with division table
        $this->db->join('mappings m', 'us.id = m.child_id', 'left');  // Left join with division table
        $this->db->where('us.id', $user_id);  // Add where condition to fetch data for a specific user
        $query = $this->db->get();  // Execute the query

        // Check if the user exists
        if ($query->num_rows() > 0) {
            return $query->row_array();  // Return user data as an associative array
        }

        return null;  // Return null if no user found
    }

    public function get_child_by_id($child_id) {
        // Perform query to get user data by user ID
        $this->db->select('chd.*,us.*,chd.id as child_id,chd.blood_group as child_blood_group,chd.profile_photo as chd_photo, c.circle as circle_name, d.division as division_name,chd.gender as c_gender');
        $this->db->from('child chd');
        $this->db->join('users us', 'us.id = chd.parent_id', 'left');         
        $this->db->join('circle c', 'us.circle = c.id', 'left');  // Left join with circle table
        $this->db->join('division d', 'us.division = d.id', 'left');  // Left join with division table
        $this->db->where('chd.id', $child_id);  // Add where condition to fetch data for a specific user
        $query = $this->db->get();  // Execute the query

        // Check if the user exists
        if ($query->num_rows() > 0) {
            return $query->row_array();  // Return user data as an associative array
        }

        return null;  // Return null if no user found
    }

    public function get_attended_child_by_teacher($teacher_id) {
        // Perform query to get user data by user ID

        $this->db->select('chd.full_name,parent.first_name as p_f_name,parent.last_name as p_l_name,teacher.first_name as t_f_name,teacher.last_name as t_l_name,dfo.first_name as d_f_name,dfo.last_name as d_l_name,chd.profile_photo as chd_photo,s.title,sa.id,s.start_datetime,s.end_datetime,s.id as section_id');
        $this->db->from('section_attendees sa');
        $this->db->join('users parent', 'parent.id = sa.parent_id', 'left');
        $this->db->join('users teacher', 'teacher.id = sa.teacher_id', 'left');
        $this->db->join('users dfo', 'dfo.id = sa.dfo_id', 'left');
        $this->db->join('sections s', 's.id = sa.section_id', 'left');
        $this->db->join('child chd', 'chd.id = sa.child_id', 'left');
        $this->db->where('teacher.id', $teacher_id);  // Add where condition to fetch data for a 
        $query = $this->db->get();  // Execute the query

        // Check if the user exists
        if ($query->num_rows() > 0) {
            return $query->result_array();  // Return user data as an associative array
        }

        return null;  // Return null if no user found
    }


    public function get_all_attended_child() {
        // Perform query to get user data by user ID

        $this->db->select('chd.full_name,parent.first_name as p_f_name,parent.last_name as p_l_name,teacher.first_name as t_f_name,teacher.last_name as t_l_name,dfo.first_name as d_f_name,dfo.last_name as d_l_name,chd.profile_photo as chd_photo,s.title,sa.id,s.start_datetime,s.end_datetime');
        $this->db->from('section_attendees sa');
        $this->db->join('users parent', 'parent.id = sa.parent_id', 'left');
        $this->db->join('users teacher', 'teacher.id = sa.teacher_id', 'left');
        $this->db->join('users dfo', 'dfo.id = sa.dfo_id', 'left');
        $this->db->join('sections s', 's.id = sa.section_id', 'left');
        $this->db->join('child chd', 'chd.id = sa.child_id', 'left');
        $query = $this->db->get();  // Execute the query

        // Check if the user exists
        if ($query->num_rows() > 0) {
            return $query->result_array();  // Return user data as an associative array
        }

        return null;  // Return null if no user found
    }

    public function get_attended_child_by_parent($parent_id) {
        // Perform query to get user data by user ID

        $this->db->select('chd.full_name,parent.first_name as p_f_name,parent.last_name as p_l_name,teacher.first_name as t_f_name,teacher.last_name as t_l_name,dfo.first_name as d_f_name,dfo.last_name as d_l_name,chd.profile_photo as chd_photo,s.title,sa.id,s.start_datetime,s.end_datetime');
        $this->db->from('section_attendees sa');
        $this->db->join('users parent', 'parent.id = sa.parent_id', 'left');
        $this->db->join('users teacher', 'teacher.id = sa.teacher_id', 'left');
        $this->db->join('users dfo', 'dfo.id = sa.dfo_id', 'left');
        $this->db->join('sections s', 's.id = sa.section_id', 'left');
        $this->db->join('child chd', 'chd.id = sa.child_id', 'left');
        $this->db->where('parent.id', $parent_id);  // Add where condition to fetch data for a 
        $query = $this->db->get();  // Execute the query

        // Check if the user exists
        if ($query->num_rows() > 0) {
            return $query->result_array();  // Return user data as an associative array
        }

        return null;  // Return null if no user found
    }

    public function get_attended_child_by_dfo($dfo_id) {
        // Perform query to get user data by user ID

        $this->db->select('chd.full_name,parent.first_name as p_f_name,parent.last_name as p_l_name,teacher.first_name as t_f_name,teacher.last_name as t_l_name,dfo.first_name as d_f_name,dfo.last_name as d_l_name,chd.profile_photo as chd_photo,s.title,sa.id,s.start_datetime,s.end_datetime');
        $this->db->from('section_attendees sa');
        $this->db->join('users parent', 'parent.id = sa.parent_id', 'left');
        $this->db->join('users teacher', 'teacher.id = sa.teacher_id', 'left');
        $this->db->join('users dfo', 'dfo.id = sa.dfo_id', 'left');
        $this->db->join('sections s', 's.id = sa.section_id', 'left');
        $this->db->join('child chd', 'chd.id = sa.child_id', 'left');
        $this->db->where('dfo.id', $dfo_id);  // Add where condition to fetch data for a 
        $query = $this->db->get();  // Execute the query

        // Check if the user exists
        if ($query->num_rows() > 0) {
            return $query->result_array();  // Return user data as an associative array
        }

        return null;  // Return null if no user found
    }

    public function get_attendees_section_details_by_id($section_id) {
        // Perform query to get user data by user ID

        $this->db->select('sa.*');
        $this->db->from('section_attendees sa');
        $this->db->where('sa.section_id', $section_id);  // Add where condition to fetch data for a 
        $query = $this->db->get();  // Execute the query

        // Check if the user exists
        if ($query->num_rows() > 0) {
            return $query->row_array();  // Return user data as an associative array
        }

        return null;  // Return null if no user found
    }

    public function get_group_attendees_by_section_id($section_id,$teacher_id) {
        // Perform query to get user data by user ID

        $this->db->select('sa.*');
        $this->db->from('section_attendees sa');
        $this->db->where('sa.section_id', $section_id);  // Add where condition to fetch data for a 
        $this->db->where('sa.teacher_id', $teacher_id);  // Add where condition to fetch data for a 
        $query = $this->db->get();  // Execute the query

        // Check if the user exists
        if ($query->num_rows() > 0) {
            return $query->result_array();  // Return user data as an associative array
        }

        return null;  // Return null if no user found
    }

    public function get_section_attended_detail_by_id($section_id) {
        // Perform query to get user data by user ID

        $this->db->select('chd.full_name,parent.first_name as p_f_name,parent.last_name as p_l_name,teacher.first_name as t_f_name,teacher.last_name as t_l_name,dfo.first_name as d_f_name,dfo.last_name as d_l_name,chd.profile_photo as chd_photo,s.*,sa.section_details');
        $this->db->from('section_attendees sa');
        $this->db->join('users parent', 'parent.id = sa.parent_id', 'left');
        $this->db->join('users teacher', 'teacher.id = sa.teacher_id', 'left');
        $this->db->join('users dfo', 'dfo.id = sa.dfo_id', 'left');
        $this->db->join('sections s', 's.id = sa.section_id', 'left');
        $this->db->join('child chd', 'chd.id = sa.child_id', 'left');
        $this->db->where('sa.id', $section_id);  // Add where condition to fetch data for a 
        $query = $this->db->get();  // Execute the query

        // Check if the user exists
        if ($query->num_rows() > 0) {
            return $query->row_array();  // Return user data as an associative array
        }

        return null;  // Return null if no user found
    }

    public function get_users_by_role_and_parent($role, $parent_id) {
        $this->db->select('us.*, c.circle as circle_name, d.division as division_name');
        $this->db->from('users us');
        $this->db->join('circle c', 'us.circle = c.id', 'left');  // Left join with circle table
        $this->db->join('division d', 'us.division = d.id', 'left');  // Left join with division table
        $this->db->join('mappings m', 'us.id = m.child_id');
        $this->db->where('m.parent_id', $parent_id);
        $this->db->where('us.role', $role);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_users_by_role($role) {
        $this->db->select('us.id,us.first_name,us.last_name, c.circle as circle_name, d.division as division_name');
        $this->db->from('users us');
        $this->db->join('circle c', 'us.circle = c.id', 'left');  // Left join with circle table
        $this->db->join('division d', 'us.division = d.id', 'left');  // Left join with division table
        $this->db->where('us.role', $role);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_users_by_role_and_my_id($role,$user_id) {
        $ids = $this->get_map_user_ids($user_id);
        // Check if IDs are empty
        if (empty($ids)) {
            return []; // Return an empty result if no IDs are found
        }
        if($role=='parent'){
            $ids = $this->get_map_user_ids($ids);
        }
        if (empty($ids)) {
            return []; // Return an empty result if no IDs are found
        }


        $this->db->select('us.id,us.first_name,us.last_name, c.circle as circle_name, d.division as division_name');
        $this->db->from('users us');
        $this->db->join('circle c', 'us.circle = c.id', 'left');  // Left join with circle table
        $this->db->join('division d', 'us.division = d.id', 'left');  // Left join with division table
        $this->db->where('us.role', $role);        
        $this->db->where_in('us.id', $ids); // Filter by mapped user IDs
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_users_by_teacher($role,$user_id) {
        $ids = $this->get_map_user_ids($user_id);
        // Check if IDs are empty
        if (empty($ids)) {
            return []; // Return an empty result if no IDs are found
        }


        $this->db->select('us.id,us.first_name,us.last_name, c.circle as circle_name, d.division as division_name');
        $this->db->from('users us');
        $this->db->join('circle c', 'us.circle = c.id', 'left');  // Left join with circle table
        $this->db->join('division d', 'us.division = d.id', 'left');  // Left join with division table
        $this->db->where('us.role', $role);        
        $this->db->where_in('us.id', $ids); // Filter by mapped user IDs
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_circle(){
        $this->db->select('*');
        $this->db->from('circle');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_division(){
        $this->db->select('*');
        $this->db->from('division');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_circle_by_id($id){
        $this->db->select('*');
        $this->db->from('circle');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_division_by_id($id){
        $this->db->select('*');
        $this->db->from('division');
        $this->db->where_in('circle_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_school_standards(){
        $this->db->select('*');
        $this->db->from('school_standards');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_user($data) {
        // Insert user data into the users table
        $this->db->insert('users', $data);
        return $this->db->insert_id();  // Return the inserted user ID
    }

    public function insert_child($data) {
        // Insert user data into the users table
        $this->db->insert('child', $data);
        return $this->db->insert_id();  // Return the inserted user ID
    }

    public function insert_map($data) {
        // Insert user data into the users table
        $this->db->insert('mappings', $data);
        return $this->db->insert_id();  // Return the inserted user ID
    }
    public function insert_attendees($data) {
        // Insert user data into the users table
        $this->db->insert_batch('section_attendees', $data);
        return $this->db->insert_id();  // Return the inserted user ID
    }

    public function update_attendees($id, $data) {
        // Update the user record in the database
        $this->db->where('id', $id);
        return $this->db->update('section_attendees', $data);  // Update the users table
    }

    public function update_user($user_id, $data) {
        // Update the user record in the database
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);  // Update the users table
    }

    public function update_map($map_id, $data) {
        // Update the user record in the database
        $this->db->where('id', $map_id);
        return $this->db->update('mappings', $data);  // Update the users table
    }

    public function update_child($child_id, $data) {
        // Update the user record in the database
        $this->db->where('id', $child_id);
        return $this->db->update('child', $data);  // Update the users table
    }

    public function get_user_counts_by_roles() {
        $query = $this->db->query("
            SELECT 
                (SELECT COUNT(id) FROM `users` WHERE role = 'dfo') AS dfo_count,
                (SELECT COUNT(id) FROM `users` WHERE role = 'teacher') AS teacher_count,
                (SELECT COUNT(id) FROM `users` WHERE role = 'parent') AS parent_count,
                (SELECT COUNT(id) FROM `child` ) AS child_count,
                (SELECT COUNT(id) FROM `sections` ) AS section_count,
                (SELECT COUNT(id) FROM `section_attendees` ) AS attendees_count
        ");
        
        // Return the result as an associative array
        return $query->row_array();
    }

    public function get_user_counts_by_roles_user_id($user_id) {
        // Fetch child IDs securely
        $query_ids = $this->db->query("SELECT child_id FROM mappings WHERE parent_id = ?", [$user_id]);
        $child_ids = $query_ids->result_array();

        // Extract child IDs into a single array
        $ids_array = array_column($child_ids, 'child_id');

        // If no child IDs, return counts as 0
        if (empty($ids_array)) {
            $ids_placeholder = "(NULL)"; // To avoid SQL errors
        } else {
            $ids_placeholder = implode(',', array_map('intval', $ids_array)); // Escaping IDs
        }

        // Build the main query
        $query = $this->db->query("
            SELECT 
                (SELECT COUNT(id) FROM `users` WHERE role = 'dfo' AND id IN ($ids_placeholder)) AS dfo_count,
                (SELECT COUNT(id) FROM `users` WHERE role = 'teacher' AND id IN ($ids_placeholder)) AS teacher_count,
                (SELECT COUNT(id) FROM `users` WHERE role = 'parent' AND id IN ($ids_placeholder)) AS parent_count,
                (SELECT COUNT(id) FROM `child`) AS child_count,
                (SELECT COUNT(id) FROM `sections`) AS section_count
        ");
        // Return the result as an associative array
        return $query->row_array();
    }

    public function get_user_counts_by_dfo($user_id) {
        // Fetch child IDs securely
        $query_ids = $this->db->query("SELECT child_id FROM mappings WHERE parent_id = ?", [$user_id]);
        $child_ids = $query_ids->result_array();

        // Extract child IDs into a single array
        $ids_array = array_column($child_ids, 'child_id');

        // If no child IDs, return counts as 0
        if (empty($ids_array)) {
            $ids_placeholder = "(NULL)"; // To avoid SQL errors
        } else {
            $ids_placeholder = implode(',', array_map('intval', $ids_array)); // Escaping IDs
        }

        // Build the main query
        $query = $this->db->query("
            SELECT 
                (SELECT COUNT(id) FROM `users` WHERE role = 'teacher' AND id IN ($ids_placeholder)) AS teacher_count,
                (SELECT COUNT(id) FROM `mappings` WHERE parent_id IN (SELECT id FROM `users` WHERE role = 'teacher' AND id IN ($ids_placeholder))) AS parent_count,
                (SELECT COUNT(id) FROM `child` where parent_id IN (SELECT child_id FROM `mappings` WHERE parent_id IN (SELECT id FROM `users` WHERE role = 'teacher' AND id IN ($ids_placeholder)))) AS child_count,
                (SELECT COUNT(id) FROM `sections` where created_by = $user_id) AS section_count,
                (SELECT COUNT(id) FROM `section_attendees` where dfo_id = $user_id) AS attendees_count
        ");
        // Return the result as an associative array
        return $query->row_array();
    }

    public function get_user_counts_by_teacher($user_id) {
        // Fetch child IDs securely
        $query_ids = $this->db->query("SELECT child_id FROM mappings WHERE parent_id = ?", [$user_id]);
        $child_ids = $query_ids->result_array();

        // Extract child IDs into a single array
        $ids_array = array_column($child_ids, 'child_id');

        // If no child IDs, return counts as 0
        if (empty($ids_array)) {
            $ids_placeholder = "(NULL)"; // To avoid SQL errors
        } else {
            $ids_placeholder = implode(',', array_map('intval', $ids_array)); // Escaping IDs
        }
        $dfo_id = $this->get_dfo_id_by_teacher_id($user_id);
        // Build the main query
        $query = $this->db->query("
            SELECT 
                (SELECT COUNT(id) FROM `users` WHERE role = 'parent' AND id IN ($ids_placeholder)) AS parent_count,
                (SELECT COUNT(id) FROM `child` WHERE parent_id IN (SELECT id FROM `users` WHERE role = 'parent' AND id IN ($ids_placeholder))) AS child_count,
                (SELECT COUNT(id) FROM `sections` WHERE created_by = $dfo_id) AS section_count,
                (SELECT COUNT(id) FROM `section_attendees` WHERE teacher_id = $user_id) AS attendees_count
        ");
        // Return the result as an associative array
        return $query->row_array();
    }

    public function get_user_counts_by_parent($user_id) {
        
        // Build the main query
        $query = $this->db->query("
            SELECT 
                (SELECT COUNT(id) FROM `child` WHERE parent_id= ? ) AS child_count,
                (SELECT COUNT(id) FROM `sections`) AS section_count,
                (SELECT COUNT(id) FROM `section_attendees` WHERE parent_id= ?) AS attendees_count
        ",[$user_id,$user_id,]);
        // Return the result as an associative array
        return $query->row_array();
    }

    
    public function delete_attendees($id,$user_id) {
        $this->db->where('id', $id);
        $this->db->where('teacher_id', $user_id);
        return $this->db->delete('section_attendees');
    }

    public function delete_child($id, $user_id) {
        // Begin transaction to ensure both deletions succeed or fail together
        $this->db->trans_start();
        
        // Delete from the 'child' table
        $this->db->where('id', $id);
        $this->db->where('parent_id', $user_id);
        $this->db->delete('child');
    
        // Delete related records from the 'section_attendees' table
        $this->db->where('child_id', $id);
        $this->db->delete('section_attendees');
    
        // Complete the transaction
        $this->db->trans_complete();
    
        // Return the transaction status (true if successful, false otherwise)
        return $this->db->trans_status();
    }
    
    public function delete_dublicate_attends_record_by_teacher_id($teacher_id){
        // Construct the raw SQL query
        $sql = "
        DELETE FROM section_attendees 
        WHERE teacher_id = ? 
        AND id NOT IN (
            SELECT MAX(id)
            FROM section_attendees
            WHERE teacher_id = ?
            GROUP BY section_id, dfo_id, parent_id, child_id
        )";
    
        // Execute the query
        return $this->db->query($sql, array($teacher_id, $teacher_id));
    }
    
    
    
    

}
