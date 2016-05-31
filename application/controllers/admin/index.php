<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends Admin {

    function __construct() {
        parent::__construct();
    }
    public function index() {
		$data['main_content'] = 'admin/index';
		$this->load->view('admin/includes/template', $data);
    }
}
