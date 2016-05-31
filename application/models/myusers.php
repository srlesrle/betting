<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myusers extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
	
    public function get_users(){
		$query = 'SELECT * FROM users';
		$result = $this->db->query($query);
		return ($result->num_rows() > 0 ? $result->result() : FALSE); 
    }
	public function get_user($id){
		$query = 'SELECT * FROM users WHERE u_id = ?';
		$result = $this->db->query($query, $id);
		return ($result->num_rows() > 0 ? $result->result() : FALSE); 
    }
	
	public function get_user_games($id){
		$query = 'SELECT games.h_yu_name AS h_yu_name, games.g_yu_name AS g_yu_name, games.title as title,
					users.fname AS fname, users.lname AS lname, users.fb_id as fb_id, users.u_id as u_id,
					users_bet.score AS score
					FROM users_bet
					LEFT JOIN games ON users_bet.game_id = games.id
					LEFT JOIN users ON users_bet.user_id = users.u_id
					WHERE users.u_id = ?
					ORDER BY users_bet.score_added DESC 
					LIMIT 0 , 50';
		$result = $this->db->query($query, $id);
		return ($result->num_rows() > 0 ? $result->result() : FALSE); 
    }
}

