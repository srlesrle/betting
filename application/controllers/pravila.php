<?php
class Pravila extends User {

    function __construct() {
        parent::__construct();
    }

    function index(){
                $data['rules'] = 'Svaka opklada donosi minus bodove ili plus bodove. <br>Ako niste pogodili idete za tu kvotu u minus, a ako ste pogodili za tu kvotu u plus.';
                $data['title'] = 'Pravila fenomenalno besplatno kladjenje';
                $data['main_content'] = 'pravila';
                $this->load->view('includes/template', $data);
    }
}

