<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Login controller URL: application_domain/login
 */
class Login extends CI_Controller {
	
		/**
	 * 1. Opens login form (view_login.php, opened via view_template.php)
	 */
	public function index() { // login
		if ( $this->session->userdata('u_id') ) {
			redirect('/');
		} else $this->load->view('includes/template',
				array(
					'main_content' => 'view_login',  // view_login.php is loaded
					'title' => $this->lang->line('page_login_title')
				));
	}


	/**
	 * 2. Validates login form and logs in user (in login_credentials)
	 */
	public function validate() {
		$this->form_validation->set_rules('email', $this->lang->line('form_login_email_field'), 'required|trim|valid_email|xss_clean|callback_login_credentials'); /* login_credentials() will be called */
		$this->form_validation->set_rules('password', $this->lang->line('form_login_password_field'), 'required|trim|xss_clean');

		if ($this->form_validation->run()) { /* <- login_credentials() is called here */
			redirect('/');
		} else $this->index();
	}


	/**
	 * 3. Call-back function for email field validation, does actual login (via model_users.php)
	 */
	function login_credentials($email) {
		$this->load->model('model_users');
		$user = $this->model_users->login_user($email, $this->input->post('password'));
		if ($user) {
			$this->session->set_userdata($user);
			$this->session->set_userdata('logged_in', true);
			$this->session->set_userdata('has_account', true);

			return true;
		} else {
			$this->session->set_userdata($this->model_users->blank_user);
			$this->session->set_userdata('logged_in', false);

			$this->form_validation->set_message('login_credentials', $this->lang->line('msg_alert_login_no_user'));
			return false;
		}
	}

	/**
	 * 4. Redirects to social network for authentication
	 */
	public function social_redirect($social_network = '') {
		// getting previous page - user could come here from home, login or user profile
		$previous_page = $this->input->server('HTTP_REFERER');

		// setting previous page so that after authentication we know where to return
		$this->session->set_flashdata('login_previous_page', $previous_page);

		switch (strtolower($social_network)) {
		case 'facebook':
			$this->load->library('fbconnect');

			// function facebook() will be called after authentication
			$ok = $this->fbconnect->fbredirect('/login/facebook');
			break;

		default:
			redirect($previous_page);
		}

		if ( ! $ok) {
			$this->session->set_flashdata('alert', 'nije uspjelo');
			redirect($previous_page);
		}
	}


	/**
	 * 4. Redirects to facebook.com for authentication
	 */
	public function facebook_redirect() {
		$this->social_redirect('Facebook');
	}


	/**
	 * 5. Redirect "processor" for social login/signup, called by facebook(), twitter(), linkedin()
	 */
	public function social($social_network = '') {
		// retrieve previous page that was stored before redirectio - user will go there
		$previous_page = $this->session->flashdata('login_previous_page');

		// if no previous page is stored, we send him to home page
		$previous_page = ($previous_page ? $previous_page : '/');

		switch (strtolower($social_network)) {
		case 'facebook':
			$this->load->library('fbconnect');
			$fb_user = $this->fbconnect->user;
			if ($fb_user) {
				$ok = true;
				$this->load->model('m_users');
				$user = $this->m_users->login_facebook_user($fb_user);
				 $this->session->set_userdata($user);
                        $this->session->set_userdata('logged_in', true);
                        $this->session->set_userdata('has_account', true);
			} else {
				$ok = $user = false;
			}

			break;

		default:
			$ok = $user = false;
			redirect($previous_page);
		}
		if ( $ok && $user ) {
			// successful login or signup
			$this->session->set_userdata($user);
			$this->session->set_userdata('logged_in', true);
			$this->session->set_userdata('has_account', true);

			redirect($previous_page);

		} elseif ($ok) {
			// Some database or logic error, we should not be here normally
			$this->session->unset_userdata();
			redirect($previous_page);
		} else {
			// Social network did not authenticate
			$this->session->sess_destroy();
			$this->session->sess_create();
			redirect($previous_page);
		}
	}


	/**
	 * 5a. Redirect point from facebook, does actual facebook login/signup
	 */
	public function facebook() {
		$this->social('Facebook');
	}

	public function recover($action = '', $param = '') {
		if ( !$this->session->userdata('logged_in') ) {

			$email = $this->input->get('email');
			switch($action) {

			case '':
				// show recovery message request form
				$this->load->view('includes/template',
					array(
						'main_content' => 'view_recover',  // view_recover.php is loaded
						'title' => $this->lang->line('page_recover_passwd_title'),
						'email' => $email // email is passed as parameter
					));
				break;

			case 'validate':
				// validate recovery message request form and send recovery email
				$this->form_validation->set_rules('email', $this->lang->line('form_login_email_field'), 'required|trim|valid_email|xss_clean|callback_validate_recover_password_email');

				if ($this->form_validation->run()) {
					// send recovery message
					$email = $this->input->post('email');
					$this->load->model('model_users');
					$user = $this->model_users->get_email_user($email);
					$key = $this->model_users->unique_key($user->u_id);
					if ( $this->send_recovery_email($user, $key) ){
						// recovery email sent
						$this->session->set_flashdata('success', $this->lang->line('msg_success_recovery_msg_sent', $user->email));
						redirect('/');
					} else {
						// recovery email not sent
						$this->session->set_flashdata('error', $this->lang->line('msg_error_cant_send_recovery_msg'));
						redirect('/login/recover' . ($email ? '?email='.$email : '') );
					}
					break;

				} else {
					// form validation errors will be shown
					$this->recover();
				}

				break;

			case 'reset':
				// reset passvord recovery key
				// second link in email, when user did not request recovery
				$this->load->model('model_users');
				$this->model_users->verify_user($param);
				redirect('/login');
				break;

			case 'key':
				// main recovery email link used when user requested recovery
				// $param is verification key
				$this->load->model('model_users');
				$user_id = $this->model_users->verify_user($param);
				if ( $user_id ) {
					// Key verified, we can recover password now
					$this->session->set_userdata('recover_user_id', $user_id);
					$this->session->set_userdata('password_recovery', true);

					redirect('/login/recover_password');

				} else {
					$this->session->set_flashdata('alert', $this->lang->line('msg_alert_cant_recover_key_expired'));
					redirect('/login/recover');
				}
				break;

			default:
				redirect('/');
			} // end of switch
		} else {
			// user logged in
			$this->session->set_flashdata('alert', $this->lang->line('msg_alert_cant_recover_signed_up'));
			redirect('/');
		}
	}
	/**
	 * 8. Call-back function for email field validation for password recovery form
	 */
	function validate_recover_password_email($email) {
		$this->load->model('model_users');

		if ( $this->model_users->check_email($email) ) {
			return true;
		} else {
			$this->form_validation->set_message('validate_recover_password_email', $this->lang->line('form_recover_passwd_no_such_email'));
			return false;
		}
	}

	/**
	 * 9. Sends recovery email
	 */
	function send_recovery_email($user, $key) {
		$this->load->language('emails');
		$config = Array(
    			'protocol' => 'smtp',
    			'smtp_host' => 'ssl://smtp.googlemail.com',
    			'smtp_port' => 465,
    			'smtp_user' => 'xxxx@gmail.com',
    			'smtp_pass' => 'password',
    			'mailtype'  => 'html', 
    			'charset'   => 'iso-8859-1'
			);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		
		$this->email->from('', my_lang('email_from_WYM'));
		$this->email->to($user->email);
		$this->email->subject(my_lang('email_send_recovery_subject'));
		/*$message  = my_lang('email_hi_user' , $user->fullname);
		$message .= $this->lang->line('email_send_recovery_text');
		$message .= my_lang('email_send_recovery_link' , base_url() . 'login/recover/key/' . $key);
		$message .= my_lang('email_send_recovery_link_reset' , base_url() . 'login/recover/reset/' . $key);
		$message .= $this->lang->line('email_send_recovery_thanks');
		$message .= $this->lang->line('email_WYM_signature');
*/
		$message = 'Kliknite na sledeci link da bi napravili novu lozinku '.base_url() . 'login/recover/key/' . $key;
		$this->email->message($message);
		

		return $this->email->send();
//echo $this->email->print_debugger();exit;
	}
	/**
	 * 10. Change password during password recovery
	 */
	public function recover_password($action = '') {
		if ($this->session->userdata('password_recovery')
			&& !$this->session->userdata('logged_in')) {

			$user_id = $this->session->userdata('recover_user_id');
			switch ($action) {

			case '':
				$this->load->view('includes/template',
					array(
						'main_content' => 'view_recover_password',  // view_recover_password.php is loaded
						'title' => my_page_title('page_recover_password_title'),
						'user_id' => $user_id
					));
				break;

			case 'validate':

				/********* recently added ************/

				$this->form_validation->set_rules('password', $this->lang->line('form_password_password_field'), 'required|matches[c_password]|trim|xss_clean');
				$this->form_validation->set_rules('c_password', $this->lang->line('form_password_c_password_field'), 'required|trim|xss_clean');

				if ($this->form_validation->run()) {
					$password = $this->input->post('password');
					$this->load->model('model_users');

					$ok = $this->model_users->update_user_password($user_id, $password);

					if ($ok) {
						// logging user in
						$user = $this->model_users->get_user($user_id);
						if ($user) {
							$this->session->set_userdata($user);
							$this->session->set_userdata('logged_in', true);
							$this->session->set_userdata('has_account', true);
							$this->session->set_flashdata('success', $this->lang->line('msg_success_new_passwd_set'));
							redirect('/');
						} else {
							$this->session->set_flashdata('error', $this->lang->line('msg_error_passwd_set_cant_login'));
							redirect('/Login');
						}

					} else {
						// echo "can't update password";
						$this->session->set_flashdata('error', $this->lang->line('msg_error_cant_set_passwd'));
						redirect('/login/recover_password/');
					}

				} else {
					// validation errors will be shown
					$this->recover_password();
				}

				/********* recently added ************/
				break;

			default:
				redirect('/');

			}
		} else {
			if ( $this->session->userdata('logged_in') ) {
				redirect('/');
			} else {
				redirect('/login');
			}
		}
	}



	/**
	 * 6. Logs out user, all session data is cleared but the session is preserved.
	 *    It is done so in order to offer Log-in as main option rather than Sign-up
	 *    If there is no session, Sign-up is offered as main option.
	 *    See main controller i.php
	 */
	public function logout() {

		if ( $this->session->userdata('logged_in') ) {
			$previous_page = $this->input->server('HTTP_REFERER');
			$this->session->sess_destroy();
			redirect($previous_page);

		} else {
			redirect('/');
		}
	}




}

/* End of file /application/controllers/login.php */
