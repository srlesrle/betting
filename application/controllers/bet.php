<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bet extends User {
    public function __construct() {
        parent::__construct();
		$this->load->model('admin_game');
    }
	public function add() {
		if($this->session->userdata('u_id') == "" ){ redirect(base_url());  }
		//	$this->load->library('fbconnect');
                //        $fb_user = $this->fbconnect->user;
                //        if (!$fb_user) {
		//		redirect(base_url('login/facebook_redirect'));
                //        }
	
		$this->load->model('admin_game');
		$score = array(
                  'x'  => 'x',
                  '1'  => '1',
                  '2'  => '2'
                );

		$this->load->library('form_validation');
		$this->form_validation->set_rules('score', 'score', 'trim|required|xss_clean');
		$this->form_validation->set_rules('game', 'game', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)  {
			redirect(base_url());
		} else {
			$did_play = $this->db->query("SELECT * FROM users_bet WHERE game_id = ? AND user_id = ".$this->session->userdata('u_id'), $this->input->post('game'));
			if($did_play->num_rows() == 0){
				$game = $this->db->query("SELECT h_yu_name, g_yu_name, time_of_game FROM games WHERE id = ?", $this->input->post('game'));
				$g = $game->row();
				$this->load->helper('date');
				$now = time();
				$time = unix_to_human($now, FALSE, 'us');
				$time_of_game = $g->time_of_game;
				$time = strftime('%Y-%m-%d %H:%M:%S');
				if($time < $time_of_game){
					if($this->admin_game->user_game_CU()) {
						redirect(base_url());
					} else {
						echo 'could not add';
					} 
				} else {
					redirect(base_url());
				}
				
			} else {
				redirect(base_url());
			}
		}
	}
}
