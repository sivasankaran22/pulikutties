<?php

abstract class MY_Controller extends CI_Controller{

    protected $show_header;
    protected $show_side_bar_menu;
    protected $enable_fluid_layout;
    protected $js = array();

    /*    Default Contructor    */
    public function __construct(){
        parent::__construct();
        $this->show_header   = TRUE;
        $this->show_side_bar_menu = TRUE;
        $this->enable_fluid_layout = FALSE;
        $this->title = '';
        $this->js = array();
    }
    

    protected function disableLayout()
    {
        $this->show_header = FALSE;
    }
    protected function enableSubMenu( $tab )
    {
        $this->show_side_bar_menu = $tab;
    }
    protected function enableFluidLayout()
    {
        $this->enable_fluid_layout = TRUE;
    }

    private function globalCssFiles()
    {
        return array(
            ''
        );
    }

    private function globalJsFiles()
    {
        return array(
            //'vendor/jquery/jquery-2.1.4.js',
           // 'vendor/q.js',
           // 'vendor/less.js',
           // 'vendor/jquery-ui.js',
           // 'vendor/bootstrap.js',
          //  'vendor/bootstrap-select.js',
          //  'vendor/jquery.tokeninput.js',
          //  'vendor/loadingoverlay.js',
        	//'vendors/angular.1.5.8.js',
            'app/messages.js',
            'app/global.js',
        	'app/common.js'
        	//'app/tabel.js'
        	
        );
    }

    /**
     * Sets the content for <title> tag in the header
     * @param $string
     */
    protected function title( $string ){
        $this->title = $string;
    }
    
    /**
     * Adds a JS file
     * @param $script
     * @param string $type
     */
    protected function addJs( $script ){
        $this->js[] = $script;
    }
    
    protected function addCss( $style , $type='link' ){
        $this->css[] = array('style'=>$style , 'type'=>$type);
    }
    
    /*
     * custom defined function
     *  Purpose : To load all the pages specified  array format
     *  Parameters : 1) $page : this associative array Contains page name to load the required pages
     *  			 2) $data : This array has all the data to be displayed in view
     */
    protected function render( $view , $data=array() , $return=FALSE ){

        $this->template->title( $this->title );
        // Add Javascript Files
        $js_files = array_merge( $this->globalJsFiles() , $this->js );
        for( $x=0 ; $x<count($js_files) ; $x++ ){
            $this->template->append_metadata('<script src="'.base_url( PATH_JS . $js_files[$x] ).'"></script>');
        }

       
        $controller_container_class  = ($this->enable_fluid_layout===TRUE) ? 'container-fluid' : 'container';
        $controller_container_class .= ' ';
        $controller_container_class .= ($this->show_side_bar_menu===FALSE) ? 'header-no-sub-menu' : 'header-with-sub-menu';
        $data['controller_container_class'] = $controller_container_class;
        /*  Load header.php */
        if( $this->show_header === TRUE ) {
            $this->template->set_partial('header', 'layouts/header' , $data );
            $this->template->set_partial('footer', 'layouts/footer' , $data );
        }

        if( $this->show_side_bar_menu !== FALSE ){
            $data['active_sub_menu_item'] = $this->show_side_bar_menu;
            $this->template->set_partial('side_bar_menu', 'layouts/side_bar_menu' , $data );
        }
        /* Load Controller specific views */
        return $this->template->build( $view , $data , $return );
    }

    public function getDropDownHTMLTagsFor($model, $where = '', $visible='') {
        $result = '';
        $key = $model->getKeyName();
        $value = $model->getValueName();

        if (empty ( $where )) {
            $lists = $model->getAll ($value );
        } else {
            $lists = $model->getByKeyValueArray ( $where,  $value );
        }
        foreach ( $lists as $list ) {
            $result .= '<option value="' . $list->$key . '">' . $list->$value . '</option>';
        }
        return $result;
    }
}