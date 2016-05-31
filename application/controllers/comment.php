<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends User {

    function __construct() {
        parent::__construct();
    }
    function add() {
	if($this->session->userdata('u_id') == ""){ redirect(base_url());}
	$this->load->model('m_comment');
        if(intval($this->input->post('bet_id')) == 0)  {
        	redirect(base_url());
        } else {
		$this->load->library('form_validation');
                $this->form_validation->set_rules('comment', 'comment', 'trim|required|xss_clean');

                if($this->form_validation->run() == FALSE)  {
                        redirect(base_url());
                } else {
	        	if($this->m_comment->CU()) {
                		redirect(base_url());
             		} else {
               			echo 'could not add';
                	}
		}
        }
    }
/*    function update(){
	$query = $this->db->get('users_bet');

	foreach ($query->result() as $row){	
		$this->load->helper('date');
		$to_unix = human_to_unix($row->score_added);
		$data = array(
               		'update' => $to_unix
            	);

		$this->db->where('id', $row->id);
		$this->db->update('users_bet', $data);
	}
     }*/
}
?>
