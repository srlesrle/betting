<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Login extends CI_Model {

	public function validate() {
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('pass', md5($this->input->post('pass')));
		$this->db->where('admin', 1);
		$query = $this->db->get('users');
		return ($query->num_rows == 1 ? $query : FALSE);
	}
	
}