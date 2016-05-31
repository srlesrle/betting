<?php

class Model_mergeusers extends CI_Model {

	public $blank_user;

	function __construct() {
		parent::__construct();
		$this->blank_user = array(
			'id' => '0',
			'private' => 'false', // not currently used
			'email' => ' ',
			'verified' => false,
			'password' => ' ',
			'fullname' => ' '
		);
	}
	 public function CU(){
                //new_id (new use) needs to become old one with old_id
		//copy from new id email and pass delete old email
		//copy new rankings
		//replace all u_id of new_id to old_id in users_beti
		

		//get new_id data
                $result = $this->db->query('SELECT email, pass FROM users WHERE u_id = ?', $this->input->post('new_id'));
		$data = array('email' => $result->row()->email,
			      'pass'  => $result->row()->pass
			);
			
                //return ($result->num_rows() > 0 ? $result->result() : FALSE);
		$this->db->where('u_id', $this->input->post('old_id'));
                $this->db->update('users', $data);

		$this->db->where('u_id', $this->input->post('new_id'));
		$this->db->update('users', array('email' => $result->row()->email.'.old.'.$this->input->post('old_id')));

		$rankings = $this->db->query('SELECT * FROM rankings WHERE user_id = ?', $this->input->post('new_id'));
		
		$old_rankings = $this->db->query('SELECT * FROM rankings WHERE user_id = ?', $this->input->post('old_id'));
		foreach($rankings->result() as $r){
			foreach($old_rankings->result() as $o){
				if($r->date == $o->date){
					echo 'new rankings: '.$r->score;
					echo 'old rankings: '.$o->score;
					$this->db->where('r_id', $o->r_id);
					$this->db->update('rankings', array('score' => $o->score + $r->score));
				}
			}
		}
		
		$bets = $this->db->query('SELECT * FROM users_bet WHERE user_id = ?', $this->input->post('new_id'));

                foreach($bets->result() as $b){
			echo $b->id;
			echo $b->score;
			echo $b->user_id;
                	$this->db->where('id', $b->id);
                        $this->db->update('users_bet', array('user_id' => $this->input->post('old_id'), 'iritating' => $this->input->post('new_id')));        
                }
		return true;
	}
}
?>
