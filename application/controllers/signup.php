<?php
/**
 * Copyright 2012, Eugene Poberezkin. All rights reserved.
 * http://WhoYouMeet.com - here busy people choose who they meet
 *
 *---------------------------------------------------------------
 * File /application/controllers/signup.php
 *
 * Signup controller class
 *---------------------------------------------------------------
 *
 * Handles email/password login and Facebook login/signup
 * Connects login form (main part - view_login.php) with table 'users' (via model_users.php)
 *
 * List of functions:
 *  1. public function index() - opens signup form
 *  2. public function validate() - validates signup form and logs in user
 *  3. public function verify_email($key) - verifies email when user clicks the link
 *  4. function send_verification_email($user, $key) - sends verification email to user
 *
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller {

	/**
	 * 1. Opens signup form (view_signup.php, opened via view_template.php)
	 */
	public function index() { // signup
		if ( $this->session->userdata('logged_in') ) {
			redirect('/');
		} else { 
			$this->load->view('includes/template',
				array(
					'main_content' => 'view_signup', // view_signup.php is loaded
					'title' => $this->lang->line('page_signup_title')
					));
		}
	}


	/**
	 * 2. Validates signup form, adds and logs in user
	 */
	public function validate() {
		$this->form_validation->set_rules('fullname', $this->lang->line('form_signup_fullname_field'),
			'required|trim|xss_clean');
		$this->form_validation->set_rules('email', $this->lang->line('form_signup_email_field'),
			'required|trim|valid_email|is_unique[users.email]|xss_clean');
		$this->form_validation->set_rules('password', $this->lang->line('form_signup_password_field'), 'required|matches[c_password]|trim|xss_clean');
		$this->form_validation->set_rules('c_password', $this->lang->line('form_signup_c_password_field'), 'required|trim|xss_clean');

		$this->form_validation->set_message('is_unique', $this->lang->line('form_signup_another_user_email'));

		if ($this->form_validation->run()) {
			// generate a random key
			$this->load->model('model_users');
			$key = $this->model_users->unique_key();

			$user = new dbUser;
			$user->email = $this->input->post('email');
			$user->password = $this->input->post('password');
			$user->fullname = $this->input->post('fullname');
			$f_l_name = explode(' ', $this->input->post('fullname'));
			$user->fname    = $f_l_name[0];
			$user->lname    = $f_l_name[1]. ' ' .(isset($f_l_name[2]) ? $f_l_name[3] : '');
			// add the user to the database
			$user = $this->model_users->add_user($user, $key);
			if ($user){
				// User added. Logging user in
				$this->session->set_userdata($user);
				$this->session->set_userdata('logged_in', true);
				$this->session->set_userdata('has_account', true);

				// send an email to the user
				if ( $this->send_verification_email($user, $key) ){
					// All good. User added, email sent, logged in
					$this->session->set_flashdata('success', $this->lang->line('msg_success_signup_ok'));
					redirect('/');
				} else {
					// email not sent
					$this->session->set_flashdata('success', $this->lang->line('msg_success_signup_no_email'));
					$this->session->set_flashdata('error', $this->lang->line('msg_error_signup_email_not_sent'));
					redirect('/');
				}
			} else {
				// Database error. User was not added
				/*
				/* tested, working very strangely - the message is show only when error happens the send time
				 * Some problem with how flash data is working when you stay on the same page
				 */
				$this->session->set_flashdata('error', $this->lang->line('msg_error_signup_database'));
				$this->index(); // can't use redirect here - need to have current form info in POST, don't know how to pass
			}
		} else {
			// Validation errors will be shown
			$this->index(); // can't use redirect here - need to have current form info in POST, don't know how to pass
		}
	}


	/**
	 * 3. Verifies email when user clicks the link
	 */
	public function verify_email($key) {
		$this->load->model('model_users');
		if ( $this->model_users->verify_user($key) ) {
			// User verified
			$this->session->set_flashdata('success', $this->lang->line('msg_success_verification_ok'));
			if ( $this->session->userdata('logged_in') ) {
				redirect('/');
			} else {
				redirect('/login');
			}

		} else {
			// invalid key
			if ( $this->session->userdata('logged_in') ) {
				$user_id = $this->session->userdata('id');
				$user = $this->model_users->get_user($user_id);
				if ($user->verified) {
					// key is wrong, but email is verified - so no problem here really.
					$this->session->set_flashdata('info', $this->lang->line('msg_info_already_verified'));
					redirect('/');
				} else {
					// key is wrong and email is not verified. We have to resend verification email and let user know.
					if ($user->email) {
						$key = $this->model_users->unique_key($user_id);

						if ( $this->send_verification_email($user, $key) ){
							// email re-sent
							$this->session->set_flashdata('alert', $this->lang->line('msg_alert_cant_verify_key_expired_email_resent'));
							redirect('/');
						} else {
							// email not re-sent
							$this->session->set_flashdata('error', $this->lang->line('msg_error_cant_verify_key_expired_cant_resend'));
							redirect('/');
						}
					} else {
						// We don't even have email
						$this->session->set_flashdata('alert', $this->lang->line('msg_alert_cant_verify_no_email'));
						redirect('i/profile/edit');
					}
				}
			} else {
				// the key is invalid and user is not logged in - so we have no idea who he is
				$this->session->set_flashdata('alert', $this->lang->line('msg_alert_cant_verify_key_expired_logged_out'));

				redirect('/login');
			}
		}
	}


	/**
	 * 4. Sends verification email to user
	 */
	function send_verification_email($user, $key) {
		$this->load->language('emails');
		
		$this->load->library('email', array('mailtype' => 'html'));
		$this->email->from('xxxx@gmail.com', $this->lang->line('email_from_WYM'));
		$this->email->to($user->email);
		$this->email->subject($this->lang->line('email_send_verification_subject'));
		$message  = $this->lang->line('email_hi_user' , $user->fullname);
		$message .= $message .= $this->lang->line('email_send_verification_thanks');
		$message .= $this->lang->line('email_send_verification_link', base_url() . 'signup/verify_email/' . $key);
		$message .= $this->lang->line('email_WYM_signature');

		$this->email->message($message);
		return $this->email->send();
	}

}

/* End of file /application/controllers/signup.php */
