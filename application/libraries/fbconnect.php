<?php
/**
 * Copyright 2012, Eugene Poberezkin. All rights reserved.
 * http://WhoYouMeet.com - here busy people choose who they meet
 *
 *---------------------------------------------------------------
 * File /application/libraries/fbconnect.php
 * 
 * Fbconnect library
 *---------------------------------------------------------------
 *
 * Encapsulates Facebook PHP SDK
 * Facebook PHP SDK should be located in /application/libraries/facebook/ folder
 *
 * Simplifies Facebook login/signup
 *
 * Class variables
 *  $user - array with Facebook user information
 *  $user_id - Facebook user ID
 *
 * Class functions:
 *  1. public function Fbconnect() - Fbconnect class constructor, checks if login was successful
 *  2. public function fbredirect(...) - redirects to Facebook for authetication
 *
 */

include(APPPATH.'libraries/facebook.php');

class Fbconnect extends Facebook {

	public $user = null; // Facebook user information
	public $user_id = null; // Facebook user id
	public $fb = false;
	public $fbSession = false;
	public $appkey = 0;
	public $facebook = null; //facebook object

	/**
	 * 1. Fbconnect class constructor, checks login and puts user information in $this->user array
	 */
	public function Fbconnect() {
		
		$ci =& get_instance();
		$ci->config->load('facebook', true);
		$config = $ci->config->item('facebook');
		parent::__construct($config);
		
		$_REQUEST = $_GET;
				
		$this->user_id = $this->getUser();
		$me = null;

		if ($this->user_id) {
			try {
				$me = $this->api('/me');
				$this->user = $me;
				$this->facebook = $this;
			} catch (FacebookApiException $e) {
				error_log($e);
			}
		}
	}

	
	/**
	 * 2. Redirects to Facebook for authetication
	 *    $site_redirect_path - site segment where the user will be redirected after authentication
	 *    $facebook_scope - information scope Facebook will request from user. To request email set to 'email'
	 */
	public function fbredirect($site_redirect_path, $facebook_scope = 'email,publish_stream') {
		$data['redirect_uri'] = site_url($site_redirect_path);
		if ( $facebook_scope != '') {
			$data['scope'] = $facebook_scope;
		}
		$LoginUrl = $this->getLoginUrl($data);
		if ($LoginUrl) {
			redirect($this->getLoginUrl($data));
			return true;
		} else {
			return false;
		}
	}

}

?>
