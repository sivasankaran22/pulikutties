<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_Loader extends CI_Loader{
	
    public function __construct()
    {
        parent::__construct();
    }
    public function controller($file_name)
    {
        $CI = & get_instance();
     	
     	$controller_path = explode("/",$file_name);
     	if(count($controller_path)==1)
     	{
     		$file_path = APPPATH.'controllers/'.$file_name.'.php';
     	}
     	else
     	{
     		$folder_name = $controller_path[0];
     		$file_name = $controller_path[1];
     		$file_path = APPPATH.'controllers/'.$folder_name.'/'.$file_name.'.php';
     	}
     	
        //$file_path = APPPATH.'controllers/'.$file_name.'.php';
        $object_name = $file_name;
        $class_name = ucfirst($file_name);

     	
        if(file_exists($file_path))
        {
            require $file_path; 
            $CI->$object_name = new $class_name();
        }
        else
        {
            show_error("Unable to load the requested controller class: ".$class_name);
        }
    }
}