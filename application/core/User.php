<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends MY_Controller {
		public $user;
		//public $user_profile;
		//public $getAppID;
		//public $fb_token;
		//public $facebook;
        function __construct(){
		
                parent::__construct();
		if($this->session->userdata('u_id') == "0"){
			 $this->session->set_userdata(array('u_id' => ''));
			$this->session->unset_userdata('u_id');
		}
			$query = $this->db->query('SELECT users.fb_id AS fb_id, users.fname AS fname, users.lname AS lname, users.u_id AS u_id, rankings.score AS score 
                                                                                FROM `rankings`
                                                                                LEFT JOIN users
                                                                                ON users.u_id = rankings.user_id 
										WHERE date = '. date("mY")  .' 
                                                                                ORDER BY rankings.score 
                                                                                DESC limit 0, 100');
			$data = array('ranking' => $query->result());
			$q = $this->db->query('SELECT users.fb_id AS fb_id, users.fname AS fname, users.lname AS lname, users.u_id AS u_id, rankings.score AS score 
                                                                                FROM `rankings`
                                                                                LEFT JOIN users
                                                                                ON users.u_id = rankings.user_id 
                                                                                WHERE date = '. date("mY", strtotime("-1 month"))  .' 
                                                                                ORDER BY rankings.score 
                                                                                DESC limit 0, 1');
			
			$data['champion'] =  array('champion' => ($q->num_rows() > 0 ? $q->result() : 0));
			$this->session->set_userdata($data);
/*			
			
			//if($this->session->userdata('u_id') == ""){	
				require 'application/libraries/facebook.php';
				$this->facebook = new Facebook(array(
				  'appId'  => '432614356751202',
				  'secret' => '3c223aa593407df2ed474110e41fb60e',
				));
				// See if there is a user from a cookie
				//print_r($this->facebook->api('/me'));
				$this->user = $this->facebook->getUser();
				$this->getAppID = $this->facebook->getAppID();
				if ($this->user) {
				  try {
					// Proceed knowing you have a logged in user who's authenticated.
					$this->user_profile = $this->facebook->api('/me');
					/*$query	 = 'SELECT * FROM users
					WHERE fb_id = '. $this->user_profile['id'] .'
					LIMIT 0, 1';
					$result = $this->db->query($query);
					/*if($this->facebook->getAccessToken()){
						$this->fb_token = $this->facebook->getAccessToken();
					} else {
						$this->fb_token = '';
					}
					$row = $result->row();
					if($result->num_rows() == 0){
						$data = array(
							'fb_id' => $this->user_profile['id'],
							'fname' => $this->user_profile['first_name'],
							'lname' => $this->user_profile['last_name'],
							'fb_token' => $this->fb_token,
							'gender'		=> $this->user_profile['gender'],
							'email'			=> $this->user_profile['email'],
							);
						$this->db->insert('users', $data);
						$last_id = $this->db->insert_id();

						$data = array(
							'u_id' => $last_id
						);
						$this->session->set_userdata($data);
					} else {
						$row = $result->row();
						
						if($row->fb_token == '' || $row->email == ''){
							$data = array(
							'fb_token' 		=> $this->fb_token,
                                                        'gender'                => $this->user_profile['gender'],
                                                        'email'                 => $this->user_profile['email'],        
							);
							$this->db->where('u_id', $row->u_id);
							$this->db->update('users', $data);
						} 
						$data = array(
							'u_id' => $row->u_id,
							'fname' => $row->fname,
							'lname' => $row->lname,
							'email'	=> $row->email,
							'fb_id' => $row->fb_id,
						);
						$this->session->set_userdata($data);
					}
				
				  } catch (FacebookApiException $e) {
					//echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
					$user = null;
				  }
				} else {
					$this->session->sess_destroy();
				}
				/*if ($this->user) {
					$this->logout_url = $this->facebook->getLogoutUrl();
				} else {
					$this->login_url = $this->facebook->getLoginUrl(array(
									'scope' => 'publish_stream'
									));
				}*/
        //	}*/
	}
}

