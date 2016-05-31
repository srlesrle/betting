<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Game extends CI_Model {

    public function __construct()
    {
        parent::__construct();
		$this->load->library('session');
    }
    
    public function CU(){
    	$this->load->helper('date');
    	$now = time();
		$time = unix_to_human($now, TRUE, 'us');
		
		$this->load->model('admin_club');
		$home = $this->admin_club->get_club_name($this->input->post('h_id'));
		$guest = $this->admin_club->get_club_name($this->input->post('g_id'));
		$guest_name = '';
		$guest_yu_name = '';
		$guest_short_name = '';
		$guest_ext = '';
		foreach($guest as $g){
			$guest_name = $g->name;
			$guest_yu_name = $g->yu_name;
			$guest_short_name = $g->short_name;
			$guest_ext = $g->ext;
		}
		$home_name = '';
		$home_yu_name = '';
		$home_short_name = '';
		$home_ext = '';
		foreach($home as $h){
			$home_name = $h->name;
			$home_yu_name = $h->yu_name;
			$home_short_name = $h->short_name;
			$home_ext = $h->ext;
		}

		$url = $home_name .'-'. $home_yu_name .'-'. $home_short_name .'-'. $guest_name .'-'. $guest_yu_name .'-'. $guest_short_name .'-'. $now;
    	//$url = iconv('ISO 8859-2', 'UTF-8//TRANSLIT//IGNORE', $url);
		//iconv('Windows-1250', 'ASCII//TRANSLIT//IGNORE', "Gracišce");
		$url = $this->slug($url);
		//echo iconv('UTF-8', 'ISO-8859-2//TRANSLIT//IGNORE', $url);
		//var_dump('%C4%8D');
		//$url = str_replace('c','è', $guest_yu_name);

		$data = array('h_id'			=> $this->input->post('h_id'),
		      		  'g_id' 			=> $this->input->post('g_id'),
		      		  'time_of_post' 	=> $time,
		      		  'time_of_game' 	=> $this->input->post('year') .'-'. $this->input->post('month') .'_'. $this->input->post('day') .' '. $this->input->post('hours') .':'. $this->input->post('minutes') .':00',
		      		  'title'			=> $url,
		      		  'user_id'			=> $this->session->userdata('a_id'),
					  'g_name'			=> $guest_name,
					  'g_yu_name'		=> $guest_yu_name,
					  'g_short_name'	=> $guest_short_name,
					  'g_ext'			=> $guest_ext,
					  'h_name'			=> $home_name,
					  'h_yu_name'		=> $home_yu_name,
					  'h_short_name'	=> $home_short_name,
					  'h_ext'			=> $home_ext,
					  'content'			=> $this->input->post('content'),
					'one'		=> $this->input->post('one'),
					'x'		=> $this->input->post('x'),
					'two'		=> $this->input->post('two')
		      		  );
		$id = $this->input->post('id');
    	
    	if($id > 0) {
    		$this->db->where('id', $id);
 			return ($this->db->update('games', $data) ? TRUE : FALSE);
    	} else {
    		return ($this->db->insert('games', $data) ? TRUE : FALSE);
    	}
		
    }
	public function user_game_CU(){
		$this->load->helper('date');
    	$now = time();
		$time = unix_to_human($now, TRUE, 'us');
		$time = mdate('%Y-%m-%d %H:%i:%s', strtotime($time));
		$data = array('score'			=> $this->input->post('score'),
		      		'game_id'		=> $this->input->post('game'),
				'score_added' 		=> $time,
				'user_id'		=> $this->session->userdata('u_id'),
				'update'		=> $now
					  );
		$query = $this->db->query("SELECT fb_token, fname, lname FROM users where u_id = ? LIMIT 1", $this->session->userdata('u_id'));
    	$row = $query->row();
		$game = $this->db->query("SELECT h_yu_name, g_yu_name FROM games WHERE id = ?", $this->input->post('game'));
		$g = $game->row();
		
		$message = 'Svaki mjesec 30 EURA nagrada za prvaka! '.$row->fname .' '. $row->lname .' igra hrabro "'. $this->input->post('score'). '" na '. $g->h_yu_name .' : '. $g->g_yu_name .' Znate bolje? odigraj na www.fenomenalno.com';
		/*require 'application/libraries/facebook.php';
                                $facebook = new Facebook(array(
                                  'appId'  => '432614356751202',
                                  'secret' => '3c223aa593407df2ed474110e41fb60e',
                                ));
		*/
/*
		$this->load->library('fbconnect');
		$facebook = $this->fbconnect->facebook;
		$permissions = $this->fbconnect->api("/me/permissions");
		
		if( array_key_exists('publish_stream', $permissions['data'][0]) ) {
	//	if($row->fb_token != ''){
			$post =  array(
				//'access_token' => $row->fb_token,
				'message' => $message,
				'link'			=> 'http://fenomenalno.com',
				'picture'		=> 'http://fenomenalno.com/img/30-fenomenalno.jpg',
				'name'			=> 'FENOMENALNO',
				'caption'		=> 'fenomenalno.com',
				'description'		=> 'Znate bolje od '. $row->fname .'a odigraj na www.fenomenalno.com'
		
			);

			$res = $facebook->api('/'. $this->user .'/feed', 'POST', $post);
		}*/
		
		return ($this->db->insert('users_bet', $data) ? TRUE : FALSE);
	}
	
	public function Slug($string)
	{
		return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
	}
	public function transliterateString($txt) {
		$transliterationTable = array ('æ' => 'c', 'è' => 'c');
		$txt = str_replace(array_keys($transliterationTable), array_values($transliterationTable), $txt);
		return $txt;
	}
 	public function add_game_result($id) {
		
 		$data = array('score' => $this->input->post('score'));
 		$this->db->where('id', $id);
 		if($this->db->update('games', $data)){
			$score_x_1_2 = $this->input->post('score');
			if($score_x_1_2 == 'x'){
				$s = 'x';
			} elseif($score_x_1_2 == '1') {
				$s = 'one';
			} else{
				$s= 'two';
			}
			$game_score = $this->db->query("SELECT MONTH(time_of_game) AS month, YEAR(time_of_game) AS year, one, two, x FROM games WHERE id = ?", $id);
			$game_score = $game_score->row();
			$date = $game_score->month.$game_score->year;
			
			$query = $this->db->query("SELECT * FROM users_bet WHERE score = ? AND game_id = ".$id, $this->input->post('score'));
			foreach($query->result() as $score) {
				$rank = $this->db->query('SELECT * FROM rankings WHERE user_id = ? AND date = '. intval($date), $score->user_id);
				//var_dump($rank->num_rows());
				if($rank->num_rows() > 0){
					$rank = $rank->row();
					$data = array(
               					'score' => $rank->score + $game_score->$s,
            				);
					$this->db->where('r_id', $rank->r_id);
					$this->db->update('rankings', $data);
				} else {
				
					$data = array(
						'score' 	=> $game_score->$s,
						'ch_id' 	=> '1',
						'user_id'	=> $score->user_id,
						'date'		=> $date
						);
					$this->db->insert('rankings', $data);
				}
			}
		/*	
			$query = $this->db->query("SELECT * FROM users_bet WHERE score != ? AND game_id = ".$id, $this->input->post('score'));
                        foreach($query->result() as $score) {
                                $rank = $this->db->query('SELECT * FROM rankings WHERE user_id = ? AND date = '. intval($date), $score->user_id);
                                $score_x_1_2 = $score->score;
                        	if($score_x_1_2 == 'x'){
                                	$s = 'x';
                        	} elseif($score_x_1_2 == '1') {
                                	$s = 'one';
                        	} else{
                                	$s= 'two';
                        	}

				//var_dump($rank->num_rows());
                                if($rank->num_rows() > 0){
                                        $rank = $rank->row();
                                        $data = array(
                                                'score' => $rank->score - $game_score->$s,
                                        );
                                        $this->db->where('r_id', $rank->r_id);
                                        $this->db->update('rankings', $data);
                                } else {

                                        $data = array(
                                                'score'         => $game_score->$s,
                                                'ch_id'         => '1',
                                                'user_id'       => $score->user_id,
                                                'date'          => $date
                                                );
                                        $this->db->insert('rankings', $data);
                                }
                        }*/
			return TRUE;	
		}
 	}
    public function delete($id = 0){
    	$query = $this->db->query("SELECT yu_name, ext FROM clubs LIMIT 1");
    	$row = $query->row(0);
    	
    	$sizes = array('128', '96', '72', '64', '48', '32', '24');

		foreach ($sizes as $size) {
			unlink('uploads/club/'. $row->yu_name . '-' . $size . $row->ext);
		}
    	$result = $this->db->delete('clubs', array('id' => $id));
    	return ($result ? TRUE : FALSE );
    }
    public function get_1($id){
	$id = intval($id);
	$query = 'SELECT COUNT(score) as score FROM users_bet WHERE game_id = ? AND score = "1"';
	$result = $this->db->query($query, $id);
	return($result->num_rows() > 0 ? $result->result() : FALSE);
    }
    public function get_x($id){
        $id = intval($id);
        $query = 'SELECT COUNT(score) as score FROM users_bet WHERE game_id = ? AND score = "x"';
        $result = $this->db->query($query, $id);
        return($result->num_rows() > 0 ? $result->result() : FALSE);
    }
    public function get_2($id){
        $id = intval($id);
        $query = 'SELECT COUNT(score) as score FROM users_bet WHERE game_id = ? AND score = "2"';
        $result = $this->db->query($query, $id);
        return($result->num_rows() > 0 ? $result->result() : FALSE);
    }    
    public function get_games(){
					// SELECT c.name AS home, 
							// cl.name AS guest,
							// games.time_of_game AS gametime,
							// games.score AS score,
							// games.id AS id 
							// FROM games
					// LEFT JOIN clubs AS c
					// ON games.h_id = c.id 
					// LEFT JOIN clubs AS cl
					// ON games.g_id = cl.id 
					// ORDER BY time_of_post ASC
		$query	 = 'SELECT * FROM games 
					ORDER BY time_of_game DESC limit 0, 50';
		$result = $this->db->query($query);
		return ($result->num_rows() > 0 ? $result->result() : FALSE); 
    }
	
	public function get_user_games(){
					// SELECT c.name AS home, 
							// cl.name AS guest,
							// games.time_of_game AS gametime,
							// games.score AS score,
							// games.id AS id 
							// FROM games
					// LEFT JOIN clubs AS c
					// ON games.h_id = c.id 
					// LEFT JOIN clubs AS cl
					// ON games.g_id = cl.id 
					// ORDER BY time_of_post ASC
					$this->load->library('session');
		$query	 = 'SELECT * FROM games 
					WHERE id NOT IN (SELECT game_id from users_bet where 
					user_id = '. ($this->session->userdata('u_id') == '' ? '0' : $this->session->userdata('u_id')) .') 
					AND time_of_game >= "'.strftime('%Y-%m-%d %H:%M:%S') .'"
					ORDER BY time_of_game DESC';
					//WHERE users_bet.user_id = '. $this->session->userdata('u_id') .'
		$result = $this->db->query($query);
		return ($result->num_rows() > 0 ? $result->result() : FALSE); 
    }
	public function get_game($title) {
		$message = 'SELECT *
					FROM games 
					WHERE title = ?';
		$result = $this->db->query($message, $title);
		return ($result->num_rows() > 0 ? $result->result() : FALSE);
	}
	public function get_game_with_id($id) {
                $message = 'SELECT * FROM games WHERE id = ?';
                $result = $this->db->query($message, $id);
                return ($result->num_rows() > 0 ? $result->result() : FALSE);
        }
	public function get_game_bets($id){
		$message = 'SELECT games.h_yu_name AS h_yu_name, games.g_yu_name AS g_yu_name, games.score AS game_score, 
					users.fname AS fname, users.lname AS lname, users.fb_id as fb_id, users.u_id as u_id,
					users_bet.score AS score
					FROM users_bet
					LEFT JOIN games ON users_bet.game_id = games.id
					LEFT JOIN users ON users_bet.user_id = users.u_id
					WHERE games.id = ?
					ORDER BY users_bet.score_added DESC 
					LIMIT 0 , 10';
		$result = $this->db->query($message, $id);
		return ($result->num_rows() > 0 ? $result->result() : FALSE);
	}
	public function get_bet_updates() {
		$query	 = 'SELECT games.h_yu_name AS h_yu_name, games.g_yu_name AS g_yu_name, games.score AS game_score, games.h_ext AS h_ext, games.g_ext AS g_ext, games.time_of_game AS time_of_game, games.title AS title, 
					users.fname AS fname, users.lname AS lname, users.fb_id as fb_id, users.u_id as u_id,
					users_bet.score AS score, users_bet.id AS bet_id, users_bet.update AS userbet_update
					FROM users_bet
					LEFT JOIN games ON users_bet.game_id = games.id
					LEFT JOIN users ON users_bet.user_id = users.u_id
					WHERE users_bet.score != ""
					ORDER BY userbet_update DESC 

					LIMIT 0 , 40';
		$result = $this->db->query($query);
		return ($result->num_rows() > 0 ? $result->result() : FALSE);
	}
	public function get_last_game(){
 /* SELECT c.name AS home, 
							cl.name AS guest,
							games.time_of_game AS gametime,
							games.score AS score,
							games.id AS id 
							FROM games
					LEFT JOIN clubs AS c
					ON games.h_id = c.id 
					LEFT JOIN clubs AS cl
					ON games.g_id = cl.id 
					ORDER BY time_of_post ASC
					LIMIT 0,  1*/
		$query	 = 'SELECT * FROM games
					ORDER BY time_of_post ASC
					LIMIT 0, 1';
		$result = $this->db->query($query);
		return ($result->num_rows() > 0 ? $result->result() : FALSE); 
    }
    
    public function get_categorie($id){
		$message = 'SELECT *
					FROM categories 
					WHERE id = ?';
		$result = $this->db->query($message, $id);
		if ($result->num_rows() > 0)
		{
		  return $result->result();
		}else{
		  return FALSE;
		}
    }
    
    public function get_numbers($first = 1, $last = 30) {
    	$hours = array();
    	for ( $counter = $first; $counter <= $last; $counter ++) {
    		$hours[$counter] = $counter;
    	}
    	return $hours;
    }
        
    public function check_unique_club(){
    		$this->db->where('name', $this->input->post('name'));
		$query = $this->db->get('clubs');
		return ($query->num_rows > 0 ? TRUE : FALSE);
    }
    
    public function check_unique_yu_club(){
    	$this->db->where('yu_name', $this->input->post('yu_name'));
		$query = $this->db->get('clubs');
		return ($query->num_rows > 0 ? TRUE : FALSE);
    }
    
    public function check_unique_short_name_club(){
                $this->db->where('short_name', $this->input->post('short_name'));
                $query = $this->db->get('clubs');
                return ($query->num_rows > 0 ? TRUE : FALSE);
    }
}

