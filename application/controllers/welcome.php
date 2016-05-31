<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends User {

    function __construct() {
        parent::__construct();
    }

    function index(){
		$data['title'] = 'Kladjenje, sportski rezultati ';
		//	if($this->session->userdata('u_id') == '') { redirect('/users/logout')}
		$source = $this->input->get('source', TRUE);
		$this->session->set_userdata(array('source' =>  $source));
		$data['signedup_facebook'] = '';
		if($this->session->userdata('signedup') == '1' && $this->session->userdata('source') == 'facebook'){
			$data['signedup_facebook'] = 1;
			$this->session->unset_userdata('signedup');
		}

		$this->load->model('admin_game');
		$data['last_club'] = $this->admin_game->get_last_game();
		if($this->session->userdata('u_id') != ""){
			$data['games'] = $this->admin_game->get_user_games();
		} else {
			$data['games'] = $this->admin_game->get_games();
		}
		$data['updates'] = $this->admin_game->get_bet_updates();
				$data['score'] = array(
                  'x'  => 'x',
                  '1'  => '1',
                  '2'  => '2'
                );
		$data['user'] = $this->user;
        $data['main_content'] = 'view';
		$this->load->view('includes/template', $data);
    }
}

