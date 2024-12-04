<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

///// admin ///////
$route['admin/dfo-profile/(:num)'] = 'admin/dfo_profile/$1'; // Captures the user ID from the URL and passes it to the profile method
$route['admin/dfo-edit-profile/(:num)'] = 'admin/dfo_edit_profile/$1'; // Captures the user ID from the URL and passes it to the profile method

$route['admin/teacher-profile/(:num)'] = 'admin/teacher_profile/$1'; // Captures the user ID from the URL and passes it to the profile method
$route['admin/teacher-edit-profile/(:num)'] = 'admin/teacher_edit_profile/$1'; // Captures the user ID from the URL and passes it to the profile method

$route['admin/parent-profile/(:num)'] = 'admin/parent_profile/$1'; // Captures the user ID from the URL and passes it to the profile method
$route['admin/parent-edit-profile/(:num)'] = 'admin/parent_edit_profile/$1'; // Captures the user ID from the URL and passes it to the profile method

$route['admin/child-profile/(:num)'] = 'admin/child_profile/$1'; // Captures the user ID from the URL and passes it to the profile method
$route['admin/child-edit-profile/(:num)'] = 'admin/child_edit_profile/$1'; // Captures the user ID from the URL and passes it to the profile method

$route['admin/section-details/(:num)'] = 'admin/section_details/$1';
$route['admin/section-edit-profile/(:num)'] = 'admin/section_edit_profile/$1';
$route['admin/section/delete/(:num)'] = 'admin/section_delete/$1';

$route['admin/user-edit-profile'] = 'admin/user_edit_profile';

///// dfo ///////
$route['dfo/teacher-profile/(:num)'] = 'dfo/teacher_profile/$1'; // Captures the user ID from the URL and passes it to the profile method
$route['dfo/teacher-edit-profile/(:num)'] = 'dfo/teacher_edit_profile/$1'; // Captures the user ID from the URL and passes it to the profile method

$route['dfo/parent-profile/(:num)'] = 'dfo/parent_profile/$1'; // Captures the user ID from the URL and passes it to the profile method
$route['dfo/parent-edit-profile/(:num)'] = 'dfo/parent_edit_profile/$1'; // Captures the user ID from the URL and passes it to the profile method

$route['dfo/child-profile/(:num)'] = 'dfo/child_profile/$1'; // Captures the user ID from the URL and passes it to the profile method
$route['dfo/child-edit-profile/(:num)'] = 'dfo/child_edit_profile/$1'; // Captures the user ID from the URL and passes it to the profile method

$route['dfo/section-details/(:num)'] = 'dfo/section_details/$1';
$route['dfo/section-edit-profile/(:num)'] = 'dfo/section_edit_profile/$1';
$route['dfo/section/delete/(:num)'] = 'dfo/section_delete/$1';
$route['dfo/attendees-details/(:num)'] = 'dfo/attendees_profile/$1';

$route['dfo/user-edit-profile'] = 'dfo/user_edit_profile';

///// teacher ///////
$route['teacher/parent-profile/(:num)'] = 'teacher/parent_profile/$1'; // Captures the user ID from the URL and passes it to the profile method
$route['teacher/parent-edit-profile/(:num)'] = 'teacher/parent_edit_profile/$1'; // Captures the user ID from the URL and passes it to the profile method

$route['teacher/child-profile/(:num)'] = 'teacher/child_profile/$1'; // Captures the user ID from the URL and passes it to the profile method
$route['teacher/child-edit-profile/(:num)'] = 'teacher/child_edit_profile/$1'; // Captures the user ID from the URL and passes it to the profile method

$route['teacher/user-edit-profile'] = 'teacher/user_edit_profile';
$route['teacher/section-details/(:num)'] = 'teacher/section_details/$1';
$route['teacher/attendees-details/(:num)'] = 'teacher/attendees_profile/$1';
$route['teacher/attendees-edit/(:num)'] = 'teacher/attendees_edit_profile/$1';
$route['teacher/attendees-delete/(:num)'] = 'teacher/attendees_delete/$1';

///// parent ///////
$route['parentcontroller/child-profile/(:num)'] = 'parentcontroller/child_profile/$1'; // Captures the user ID from the URL and passes it to the profile method
$route['parentcontroller/child-edit-profile/(:num)'] = 'parentcontroller/child_edit_profile/$1'; // Captures the user ID from the URL and passes it to the profile method

$route['parentcontroller/user-edit-profile'] = 'parentcontroller/user_edit_profile';

$route['parentcontroller/section-details/(:num)'] = 'parentcontroller/section_details/$1';
$route['parentcontroller/attendees-details/(:num)'] = 'parentcontroller/attendees_profile/$1';