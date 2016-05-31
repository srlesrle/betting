<?php
class Terms extends User {

    function __construct() {
        parent::__construct();
    }

    function index(){
                $data['title'] = 'Pravila i uslovi koriscenja fenomenalno';
                $data['main_content'] = 'terms';
                $this->load->view('includes/template', $data);
    }
}

