<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stats extends User {
    function __construct() {
        parent::__construct();
    }
    function index(){
	$data['title'] = 'Statistike kladjenja sportskih utakmica ';
        $this->load->model('admin_game');
	$data['games'] = $this->admin_game->get_games();
        $data['updates'] = $this->admin_game->get_bet_updates();
        $data['user'] = $this->user;
        $data['main_content'] = 'stats';
        $this->load->view('includes/template', $data);
    }
}
