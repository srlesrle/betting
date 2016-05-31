<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Game extends Admin {

	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('admin_game');
		$this->load->model('admin_club');
	}
	
	public function index() {
		$data['games'] = $this->admin_game->get_games();
		$data['main_content'] = 'admin/game';
		$this->load->view('admin/includes/template', $data);		
	}
	
	public function add() {
		$data['clubs'] = $this->admin_club->get_clubs_select_option();
                
        //2012-05-07 15:42:27
		$data['hours'] 		= $this->admin_game->get_numbers(1, 24);
		$data['minutes'] 	= $this->admin_game->get_numbers(0, 59);
		$data['day'] 		= $this->admin_game->get_numbers(1, 31);
		$data['month'] 		= $this->admin_game->get_numbers(1, 12);
        	$data['year'] 		= $this->admin_game->get_numbers(2012, 2015);

		$this->load->library('form_validation');
		$this->form_validation->set_rules('month', 'month', 'trim|required|xss_clean');
		$this->form_validation->set_rules('day', 'day', 'trim|required|xss_clean');
		$this->form_validation->set_rules('year', 'year', 'trim|required|xss_clean');
		$this->form_validation->set_rules('hours', 'hours', 'trim|required|xss_clean');
		$this->form_validation->set_rules('minutes', 'minutes', 'trim|required|xss_clean');
		$this->form_validation->set_rules('h_id', 'h_id', 'required|trim|xss_clean');
		$this->form_validation->set_rules('g_id', 'g_id', 'required|trim|xss_clean');
		$this->form_validation->set_rules('content', 'content', 'required|trim|xss_clean');
		$this->form_validation->set_rules('one', 'one', 'required|trim|xss_clean');
		$this->form_validation->set_rules('x', 'x', 'required|trim|xss_clean');
		$this->form_validation->set_rules('two', 'two', 'required|trim|xss_clean');
		//$this->form_validation->set_rules('tags', 'tags', 'required|trim|xss_clean');
		
		
		if($this->form_validation->run() == FALSE)  {
			$data['main_content'] = 'admin/game_add';
			$this->load->view('admin/includes/template', $data);
		} else {
			if($this->admin_game->CU()) {
				redirect('admin/game');
			} else {
				echo 'could not add';
			}
		}
	}
	
	public function edit($id = 0) {
		if(!is_numeric($id) || $id == 0){ redirect(base_url('admin/login')); }
		$data['clubs'] = $this->admin_club->get_clubs_select_option();
                $data['hours']          = $this->admin_game->get_numbers(1, 24);
                $data['minutes']        = $this->admin_game->get_numbers(0, 59);
                $data['day']            = $this->admin_game->get_numbers(1, 31);
                $data['month']          = $this->admin_game->get_numbers(1, 12);
                $data['year']           = $this->admin_game->get_numbers(2012, 2015);
		$data['game'] 		= $this->admin_game->get_game_with_id($id);
		$data['main_content'] = 'admin/game_edit';
		$this->load->view('admin/includes/template', $data);
	}
	
	public function editgo()
	{
		$this->load->library('form_validation');
		//$this->form_validation->set_rules('month', 'month', 'trim|required|xss_clean');
                //$this->form_validation->set_rules('day', 'day', 'trim|required|xss_clean');
                //$this->form_validation->set_rules('year', 'year', 'trim|required|xss_clean');
               // $this->form_validation->set_rules('hours', 'hours', 'trim|required|xss_clean');
               // $this->form_validation->set_rules('minutes', 'minutes', 'trim|required|xss_clean');
                $this->form_validation->set_rules('h_id', 'h_id', 'required|trim|xss_clean');
                $this->form_validation->set_rules('g_id', 'g_id', 'required|trim|xss_clean');
                $this->form_validation->set_rules('content', 'content', 'required|trim|xss_clean');
                $this->form_validation->set_rules('one', 'one', 'required|trim|xss_clean');
                $this->form_validation->set_rules('x', 'x', 'required|trim|xss_clean');
                $this->form_validation->set_rules('two', 'two', 'required|trim|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			$data['main_content'] = 'admin/game_edit';
			$this->load->view('includes/template', $data);
		}
		else
		{			
			if($query = $this->admin_game->CU()) //CU is Create Update
			{
				redirect('admin/game');
			}
			else
			{
				echo 'could not edit keyword';
			}
		}
		
	}
	public function add_game_result($id) {
		$data['score'] = array(
                  'x'  => 'x',
                  '1'  => '1',
                  '2'  => '2',
                  'x1' => 'x1',
                  'x2' => 'x2'
                );
        $data['id'] = $id;
		$this->load->library('form_validation');
		$this->form_validation->set_rules('score', 'score', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)  {
			$data['main_content'] = 'admin/game_result_add';
			$this->load->view('admin/includes/template', $data);
		} else {
			if($this->admin_game->add_game_result($id)) {
				redirect('admin/game');
			} else {
				echo 'could not add';
			}
		}
	}
	
	public function club_exists() {
		$this->form_validation->set_message('club_exists', 'This club already in database!');
		$query = $this->admin_club->check_unique_club();
		return ($query ? FALSE : TRUE );
	}
	
	public function yu_club_exists() {
		$this->form_validation->set_message('yu_club_exists', 'This yu club already in database!');
		$query = $this->admin_club->check_unique_yu_club();
		return ($query ? FALSE : TRUE );
	}
	
	public function short_name_club_exists() {
		$this->form_validation->set_message('short_name_club_exists', 'This short name of the club already in database!');
                $query = $this->admin_club->check_unique_short_name_club();
                return ($query ? FALSE : TRUE );
	}
	public function delete($id = 0)
	{
		if(!is_numeric($id) || $id == 0){ redirect(base_url()); }		
		if($query = $this->admin_club->delete($id)) {
			redirect('admin/club');
		}else{
			echo 'could not delete id '.$id;
		}
	}
	function handle_upload()
  	{
    	if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
      		if ($this->upload->do_upload('image'))
      		{
        		// set a $_POST value for 'image' that we can use later
        		$upload_data    = $this->upload->data();
        		$_POST['image'] = $upload_data['file_name'];
        		return true;
      		} else {
        		// possibly do some clean up ... then throw an error
        		$this->form_validation->set_message('handle_upload', $this->upload->display_errors());
        		return false;
      		}
    	} else {
      		// throw an error because nothing was uploaded
      		$this->form_validation->set_message('handle_upload', "You must upload an image!");
      		return false;
   	}
  }
}

