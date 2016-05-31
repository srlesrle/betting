<?php

class M_users extends CI_Model {

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

	public function login_facebook_user($fb_user) {
		if ($fb_user) {
			$query = $this->db->where('fb_id', $fb_user['id'])->get('users');
		
			if ( $query->num_rows() === 1 ) {
				// user found
				$user =  $query->row();
				if($query->row()->email == ''){
					$data = array(
               					'email' => $fb_user['email']
            				);

					$this->db->where('u_id', $query->row()->u_id);
					$this->db->update('users', $data);
				}
				return (array) $user;

			} else {
				// no such user, signing up
				$user = array();
				$user['fb_id']  = 	(isset($fb_user['id']) 		? $fb_user['id'] 	: '');
				$user['gender'] = 	(isset($fb_user['gender']) 	? $fb_user['gender'] 	: '');
				$user['email']  = 	(isset($fb_user['email']) 	? $fb_user['email'] 	: '');
				$user['fname']  = 	(isset($fb_user['first_name']) 	? $fb_user['first_name']: '');
				$user['lname']  = 	(isset($fb_user['last_name']) 	? $fb_user['last_name'] : '');

				// Inserting user
				$query = $this->db->insert('users', $user); // we don't have id yet...
				$user['u_id'] = $this->db->insert_id();
				$user['signedup'] = 1;
				return $user;

				if ( ! $ok) {
					// Cannot insert user
					// Cannot insert user
					return false;
				}
			}
		} else {
			// empty user passed as parameter
			return false;
		}
	}
}
?>
