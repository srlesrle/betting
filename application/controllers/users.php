<?php
class Users extends User {

    function __construct() {
        parent::__construct();
		$this->load->model('myusers');
    }

    function index(){
		$data['title'] = '&#268;lanovi ';
		$data['users'] = $this->myusers->get_users();
        	$data['main_content'] = 'users';
		$this->load->view('includes/template', $data);
    }
    public function logout(){
	$this->session->sess_destroy();
	redirect($this->logout_url);
    }
}
