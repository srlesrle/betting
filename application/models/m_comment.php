<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_comment extends CI_Model {

    public function __construct()
    {
        parent::__construct();
                $this->load->library('session');
    }

    public function CU(){
		$this->load->helper('date');
        	$now = time();
                $time = unix_to_human($now, TRUE, 'us');
		//adding update time for bets on comments
		$d = array('update' => $now);
		$this->db->where('id', $this->input->post('bet_id'));
		$this->db->update('users_bet', $d);
		
                $data = array('comment'                   => $this->input->post('comment'),
				'bet_id'		  => $this->input->post('bet_id'),
                                'right_wrong'             => ($this->input->post('right') != false ? 'r' : 'w'),
                                //'time_added'              => time(),
                                'user_id'                 => $this->session->userdata['u_id']
                              );

                return ($this->db->insert('comments', $data) ? TRUE : FALSE);
    }
}

