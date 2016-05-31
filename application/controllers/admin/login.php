<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('admin_login');
	}
	function index()
	{
		if($this->session->userdata('a_id') != '') {
			redirect('admin/index');
		}
		$data['main_content'] = 'admin/login';
		$this->load->view('admin/includes/template', $data);
	}
	function validate_credentials() {	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', '', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('pass', '', 'trim|required|min_length[4]|max_length[32]');
		
		if($this->form_validation->run() == FALSE) {
			$data['main_content'] = 'admin/login';
			$this->load->view('admin/includes/template', $data);
		} else {
			if($query = $this->admin_login->validate()) {
				$row = $query->row();
				$data = array(
					'username' => $this->input->post('username'),
					'a_id' => $row->u_id,
					'is_logged_in' => true
				);
				$this->session->set_userdata($data);
				redirect('admin/index');
			}else{
				$data['main_content'] = 'admin/login';
				$this->load->view('admin/includes/template', $data);
			}
		}
	}
	function username_wrong() {
		$this->form_validation->set_message('username_wrong', 'sifra ili korisnicko ime nisu dobri');
		return ($this->admin_login->validate() ? TRUE : FALSE );
	}
	
	function logout() {
		$this->session->sess_destroy();
		redirect('admin/login');
	}

}