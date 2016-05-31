<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Club extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function CU($image_ext){
    	$data = array('name'	=> $this->input->post('name'),
		      		  'short_name' =>  $this->input->post('short_name'),
		      		  'yu_name' => $this->input->post('yu_name'),
		      		  'ext'	=> $image_ext);
		$id = $this->input->post('id');
    	
    	if($id > 0) {
    		$this->db->where('id', $id);
 			return ($this->db->update('clubs', $data) ? TRUE : FALSE);
    	} else {
    		return ($this->db->insert('clubs', $data) ? TRUE : FALSE);
    	}
		
    }
 
    public function delete($id = 0){
    	$query = $this->db->query("SELECT yu_name, ext FROM clubs WHERE id = ? LIMIT 1", $id);
    	$row = $query->row(0);
    	$sizes = array('256', '128', '96', '72', '64', '48', '32', '24');

		foreach ($sizes as $size) {
			unlink('uploads/club/'. $row->yu_name . '-' . $size . $row->ext);
		}
    	$result = $this->db->delete('clubs', array('id' => $id));
    	return ($result ? TRUE : FALSE );
    }
    
    public function get_clubs(){
		$clubs	 = 'SELECT * FROM clubs ORDER BY name ASC';
		$result = $this->db->query($clubs);
		return ($result->num_rows() > 0 ? $result->result() : FALSE); 
    }
    
    public function get_clubs_select_option() {
    	$object_clubs = $this->admin_club->get_clubs();
    	$clubs_array = array();
    	foreach ($object_clubs as $club) {
    		$clubs_array[$club->id] = $club->name;
    	}
    	return $clubs_array;
    }
    public function get_club_name($id){
		$message = 'SELECT * FROM clubs WHERE id = ?';
		$result = $this->db->query($message, $id);
		return ($result->num_rows() > 0 ? $result->result() : FALSE);
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

