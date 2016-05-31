<?php


/**
 * 1. Main information about the user. This information is stored in the session cookie
 *    Password field is used internally in the model but set to blank when returned to controllers
 */
class dbUser {
	var $u_id = 0;
	var $email = '';
	var $verified = false;
	var $pass = '';
	var $fullname = '';
	var $fname    = '';
	var $lname    = '';
	var $picture_url = '';

	public function copy($data) { // not necessary this class, but same fields
		$this->u_id = $data->u_id;
		$this->email = $data->email;
		$this->verified = $data->verified;
		$this->pass = $data->pass;
		$this->fullname = $data->fullname;
		$this->fname    = $data->fname;
		$this->lname    = $data->lname;
		$this->picture_url = $data->picture_url;
		return $this;
	}
}


/**
 * 2. Same fields as user record in 'users' table
 */
class dbFullUser extends dbUser {
	var $fname = ''; // not currently used
	var $lname = ''; // not currently used

	public function copy($data) { // not necessary this class, but same fields
		parent::copy($data);
		$this->fname = $data->fname;
		$this->lname = $data->lname;

		return $this;
	}

}


/**
 * 3. Same fields as user record in 'user_keys' table. Not currently used
 */
class dbUserKey {
	var $u_id = 0;
	var $userid = 0;
	var $key = '';

	function __constructor($key) {
		$this->key = $key;
	}
}


/**
 * 
 *
 * Model_users class definition
 *
 *
 */
class Model_users extends CI_Model {

	public $blank_user;

	function __construct() {
		parent::__construct();
		$this->blank_user = array(
			'u_id' => '0',
			'email' => ' ',
			'verified' => false,
			'pass' => ' ',
			'fullname' => ' ',
			'fname'	   => ' ',
			'lname'	   => ' '	
		);
	}
	public function get_all_users(){
                $result = $this->db->query('SELECT * FROM users');
                return ($result->num_rows() > 0 ? $result->result() : FALSE);
	}



	/**
	 * 4. Logs user in. Returns dbUser object or false if email/password combination is not found 
	 */
	public function login_user($email, $password) {
		$query = $this->db->where('email', $email)->where('pass', md5($password))->get('users');
		if ( $query->num_rows() == 1 ) {
			$user = new dbUser;
			$user->copy($query->row());
			$user->password = '***';
			return $user;
		} else {
			return false;
		}
	}


	/**
	 * 5. Generates a unique key and stores it in 'user_keys' table (used for email verification)
	 */
	public function unique_key($user_id = 0) {
		do {
			$key = md5(uniqid());
			$query = $this->db->where('key', $key)->get('user_keys');
		} while ($query->num_rows() > 0); // makes sure the key in table is unique :))))

		if ($user_id) {
			// creating key to re-send verification email
			$this->db->insert('user_keys', array('userid' => $user_id, 'key' => $key));
		} else {
			// reserving key for a new user
			$this->db->set('key', $key)->insert('user_keys');
		}
		return $key;
	}


	/**
	 * 5a. Delete all keys for a user - used when email is changed
	 */
	public function delete_keys($user_id) {
		if ($user_id) {
			return $this->db->where('userid', $user_id)->delete('user_keys');
		} else {
			return false;
		}
	}


	/**
	 * 6. Adds user and user key during sign-up. Links user to email key.
	 *    User can use application immediately, but marked as unverified
	 *    Database structure and logic allow requesting many verification emails, any key will verify user
	 */
	public function add_user($user, $key) {
		$user->pass = md5($user->pass);
		$ok = $this->db->insert('users', $user); // add user

		if ($ok) {
			$user->u_id = $this->db->insert_id();
			$user->pass = '***';

			// update key for email verification
			$this->db->where('key', $key)->set('userid',$user->u_id)->update('user_keys');

			return $user;
		} else {
			return false;
		}
	}



	/**
	 * 7. Verifies user.
	 *    Called by verify_email($key) of Signup controller when the link in email is clicked
	 *    Also used for password recovery in Login controller.
	 *    All verification keys for this user are deleted after verificaiton by any key
	 */
	public function verify_user($key) {
		$query = $this->db->where('key', $key)->get('user_keys'); // retrieving user id

		if ( $query->num_rows() == 1 ) {
			$user_key = $query->row();
			
			$success = $this->db->where('u_id', $user_key->userid)->set('verified', true)->update('users');
			if ( $success ) { // delete all keys for this user
				$this->db->where('userid', $user_key->userid)->delete('user_keys');
				return $user_key->userid;
			} else return false;
		} else return false;
	}


	/**
	 * 7a. Checks if email is registered in database.
	 */
	public function check_email($email) {
		$query = $this->db->where('email', $email)->get('users');
		return $query->num_rows(); // raise error if there are more than one
	}


	/**
	 * 7b. Retrieves user information by email
	 *    Returns dbFullUser object
	 *    Password field is set to blank
	 */
	public function get_email_user($email) {
		$query = $this->db->where('email', $email)->get('users');
		if ( $query->num_rows() === 1 ) {
			$user = new dbFullUser;
			$user->copy($query->row());
			$user->pass = ($user->pass ? '***' : '');
			return $user;
		} else return false;
	}

	/**
	 * 8. Retrieves user information - should be called for the current user only
	 *    Returns dbFullUser object
	 *    Password field is set to '' (of not set) or '***' (if it is set)
	 */
	public function get_user($id_or_un, $get_by_username = false, $social_network = 'twitter') {
		if ($get_by_username) {
			$query = $this->db->where($social_network . '_username', $id_or_un)->get('users');
		} else {
			$query = $this->db->where('u_id', $id_or_un)->get('users');
		}
		if ( $query->num_rows() === 1 ) {
			$user = new dbFullUser;
			$user->copy($query->row());
			$user->pass = ($user->pass ? '***' : '');
			return $user;
		} else {
			// no such user
			return false;
		}
	}



	/**
	 * 9. Updates user information
	 *    $id - user id in a database, $user_data - dbFullUser object
	 */
	public function update_user($id, $user_data) {
		$user_array = (array) $user_data;

		// Password field should not be deleted in the database
		unset($user_array['pass']);

		// update people added by other users now connected to this new user
		$this->update_people_user_connections($user_data);

		return $this->db->where('id', $id)->update('users', $user_array);
	}


	/**
	 * 9a. Updates user password
	 *    $id - user id in a database, $password - uncoded password
	 */
	public function update_user_password($id, $password) {
		return $this->db->where('u_id', $id)->set('pass', md5($password))->update('users');
	}


	/**
	 * 9b. Changes user password checking the current one ($old_password - uncoded)
	 *    $id - user id in a database, $new_password - uncoded new password
	 */
	public function change_user_password($id, $old_password, $new_password) {
		$query = $this->db->select('pass')->where('id', $id)->get('users');
		if ( $query->num_rows() === 1 ) {
			if ( md5($old_password) == $query->row()->pass || ( ! $old_password && ! $query->row()->pass)) {
				return $this->db->where('id', $id)->set('pass', md5($new_password))->update('users');
			} else {
				//echo 'password did not match';
				return false;
			}
		} else {
			// user not found
			return false;
		}
	}


	/**
	 * 10. Get user by facebook id (the whole facebook user array is used as parameter)
	 */
	public function get_facebook_user($fb_user) {
		$query = $this->db->where('facebook_id', $fb_user['id'])->get('users');
		if ( $query->num_rows() === 1 ) {
			$user = new dbFullUser;
			$user->copy($query->row());
			$user->password = ($user->password ? '***' : '');;
			return $user;
		} else return false;
	}


	/**
	 * 10a. Checks if there is user with facebook id (the whole facebook user array is used as parameter)
	 */
	public function check_facebook_user($fb_user) {
		$query = $this->db->where('facebook_id', $fb_user['id'])->get('users');
		return $query->num_rows() === 1;
	}


	/**
	 * 10b. Get user by twitter id
	 */
	public function get_twitter_user($tw_id) {
		$query = $this->db->where('twitter_id', $tw_id)->get('users');
		if ( $query->num_rows() === 1 ) {
			$user = new dbFullUser;
			$user->copy($query->row());
			$user->password = ($user->password ? '***' : '');;
			return $user;
		} else return false;
	}


	/**
	 * 10c. Check if there is user with twitter id
	 */
	public function check_twitter_user($tw_id) {
		$query = $this->db->where('twitter_id', $tw_id)->get('users');
		return $query->num_rows() === 1;
	}


	/**
	 * 10d. Check if there is user with linkedin id
	 */
	public function get_linkedin_user($in_id) {
		$query = $this->db->where('linkedin_id', $in_id)->get('users');
		if ( $query->num_rows() === 1 ) {
			$user = new dbFullUser;
			$user->copy($query->row());
			$user->password = ($user->password ? '***' : '');;
			return $user;
		} else return false;
	}


	/**
	 * 10e. Check if there is user with linkedin id
	 */
	public function check_linkedin_user($in_id) {
		$query = $this->db->where('linkedin_id', $in_id)->get('users');
		return $query->num_rows() === 1;
	}


	/**
	 * 11. Logs in / signs up facebook user
	 */
	public function login_facebook_user($fb_user) {
		if ($fb_user) {
			$query = $this->db->where('facebook_id', $fb_user['id'])->get('users');
		
			if ( $query->num_rows() === 1 ) {
				// user found
				$user = new dbUser;
				$user->copy($query->row());
				$user->password = ($user->password ? '***' : '');
				return $user;

			} else {
				// no such user, signing up
				$user = new dbFullUser;
				$user->facebook_id = $fb_user['id'];
				$user->facebook_username = $fb_user['username'];
				$user->facebook_name = $fb_user['name'];
				$user->facebook_img_url = 'https://graph.facebook.com/' . $user->facebook_username . '/picture';
				$user->facebook_gender = $fb_user['gender'];
				$user->fullname = $fb_user['name'];
				$user->firstname = (isset($fb_user['first_name']) ? $fb_user['first_name'] : '');
				$user->lastname = (isset($fb_user['last_name']) ? $fb_user['last_name'] : '');
				$user->bio = (isset($fb_user['bio']) ? $fb_user['bio'] : '');
				$user->location = 
					(isset($fb_user['location']['name']) ? $fb_user['location']['name'] : '');

				$user->picture_url = $user->facebook_img_url;
				$user->big_picture_url = 'https://graph.facebook.com/' . $user->facebook_username . '/picture?type=normal';

				// Inserting user
				$query = $this->db->insert('users', $user); // we don't have id yet...
			
				$user->id = $this->db->insert_id();

				$this->meet_WhoYouMeet_team($user);

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


	/**
	 * 11a. Logs in / signs up twitter user
	 */
	public function login_twitter_user($tw_user_id) {
		if ($tw_user_id) {
			$query = $this->db->where('twitter_id', $tw_user_id)->get('users');

			if ( $query->num_rows() === 1 ) {
				// user found
				$user = new dbUser;
				$user->copy($query->row());
				$user->password = ($user->password ? '***' : '');
				return $user;

			} else {
				// no such user, signing up
				$this->load->library('twconnect');
				$user = new dbFullUser;

				$user->twitter_id = $tw_user_id;
				$user->twitter_token = $this->twconnect->tw_access_token['oauth_token'];
				$user->twitter_token_secret = $this->twconnect->tw_access_token['oauth_token_secret'];
				$user->twitter_username = $this->twconnect->tw_user_name;

				$this->twconnect->twaccount_verify_credentials(); // this will get us user info

				if ($this->twconnect->tw_user_info) {
					// we have extended user info
					$user->fullname = $this->twconnect->tw_user_info->name;
					$user->bio = $this->twconnect->tw_user_info->description;
					$user->location = $this->twconnect->tw_user_info->location;
					$user->web = resolve_url($this->twconnect->tw_user_info->url);

					$user->twitter_name = $this->twconnect->tw_user_info->name;
					$user->twitter_img_url = $this->twconnect->tw_user_info->profile_image_url;
					$user->twitter_verified = $this->twconnect->tw_user_info->verified;

					$user->picture_url = $user->twitter_img_url;
					$user->big_picture_url = resolve_url('https://api.twitter.com/1/users/profile_image?screen_name=' . $user->twitter_username . '&size=bigger');

				} else {
					// we failed to get extended user info, but we will try to get it differently via public api request

					$ok = set_all_info_from_social($user, 'twitter', $user->twitter_username, true);

					if ( ! $ok) {
						// we do not have twitter data
						$user->fullname = $user->twitter_username;
					}
				}


 				// Inserting user
				$ok = $this->db->insert('users', $user); // we don't have id yet...

				$user->id = $this->db->insert_id();

				$this->meet_WhoYouMeet_team($user);

				return $user;

				if ( ! $ok) {
					// Cannot insert user
					return false;
				}

			} // end of else - no such user, signing user up
		} else {
			// no $tw_user_id passed
			return false;
		}

	} // function login_twitter_user()


	/**
	 * 11b. Logs in / signs up linkedin user
	 */
	public function login_linkedin_user($in_user, $in_access_token) {
		if ($in_user) {
			$query = $this->db->where('linkedin_id', $in_user->id)->get('users');

			if ( $query->num_rows() === 1 ) {
				// user found
				$user = new dbUser;
				$user->copy($query->row());
				$user->password = ($user->password ? '***' : '');
				return $user;

			} else {
				// no such user, signing up
				$this->load->library('in_connect');
				$user = new dbFullUser;

				$user->linkedin_id = $in_user->id;

				// saving token - it will expire and there is no logic yet to track it
				$user->linkedin_token = $in_access_token['oauth_token'];
				$user->linkedin_token_secret = $in_access_token['oauth_token_secret'];

				// calculating expiration time (since UNIX epoch 1970/1/1 00:00:00) (linkedin returns expiration period in seconds)
				$user->linkedin_token_expires = time() + $in_access_token['oauth_authorization_expires_in'];

				// cutting the domain part away (it will cut any domain away), because 'linkedin_username' is the path part of the public URL (I just didn't know then...)
				$in_username = preg_replace('/(\w{1,5}\:\/\/)?((\w*\.){1,3}\w*\/)?/', '', $in_user->publicProfileUrl);

				// cutting any parameters that can be there - maybe this is excessive
				$in_username = preg_replace('/(\?.*)/', '', $in_username);
				$user->linkedin_username = $in_username;

				// setting user info from linkedin data
				$user->firstname = (isset($in_user->firstName) ? $in_user->firstName : '');
				$user->lastname = (isset($in_user->lastName) ? $in_user->lastName : '');

				$user->fullname = (isset($in_user->formattedName) ? $in_user->formattedName : $user->firstname . ' ' . $user->lastname);
				$user->bio = (isset($in_user->headline) ? $in_user->headline : '');
				$user->location = (isset($in_user->location->name) ? $in_user->location->name : '');

				// can't get we address yet - will come here later
				// $user->web = resolve_url($this->twconnect->tw_user_info->url);

				$user->linkedin_name = $user->fullname;
				$user->linkedin_img_url = (isset($in_user->pictureUrl) ? $in_user->pictureUrl : '');

				$user->picture_url = $user->linkedin_img_url;

				// getting the big picture
				$all_pictures = $this->in_connect->in_get_user_pictures();
				if (isset($all_pictures->values[0])) {
					$user->big_picture_url = $all_pictures->values[0];
				} else {
					// no big picture - using the same picture
					$user->big_picture_url = $user->picture_url;
				}

				// Inserting user
				$ok = $this->db->insert('users', $user);

				$user->id = $this->db->insert_id();

				$this->meet_WhoYouMeet_team($user);

				return $user;

				if ( ! $ok) {
					// Cannot insert user
					return false;
				}

			} // end of else - no such user, signing user up
		} else {
			// no $in_user passed
			return false;
		}

	} // function login_linkedin_user()


}

/* End of file /application/models/model_users.php */
