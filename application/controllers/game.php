<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Game extends User {
    public function __construct() {
        parent::__construct();
		$this->load->model('admin_game');
    }

    public function index($title){
		$this->load->helper('security');
		$title = xss_clean($title);
		//var_dump($title);
		$data['game'] = $this->admin_game->get_game($title);
		if(!$data['game']) {
			redirect(base_url());
		}
		$data['game_bets'] = $this->admin_game->get_game_bets($data['game'][0]->id);
		$data['one'] = $this->admin_game->get_1($data['game'][0]->id);
		$data['x'] = $this->admin_game->get_x($data['game'][0]->id);
		$data['two'] = $this->admin_game->get_2($data['game'][0]->id);

		$data['title'] = $data['game'][0]->h_yu_name. ' ' .$data['game'][0]->g_yu_name .' '.date("d-m-Y H:i", strtotime($data['game'][0]->time_of_game));

        	$data['main_content'] = 'game';
		$this->load->view('includes/template', $data);
    }

}
