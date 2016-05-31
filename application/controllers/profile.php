<?php
class Profile extends User {

    function __construct() {
        parent::__construct();
		$this->load->model('myusers');
    }

    function index($id){
		$id = intval($id);
		if($id == 0 ) { redirect(base_url());}
		$data['users'] = $this->myusers->get_user($id);
		if(!$data['users']) { redirect('users'); }
		$data['user_games'] = $this->myusers->get_user_games($id);
		$data['title'] = $data['users'][0]->fname. ' ' .$data['users'][0]->lname;
        	$data['main_content'] = 'profile';
		$this->load->view('includes/template', $data);
    }
}
