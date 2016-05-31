<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Club extends Admin {
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('admin_club');
	}
	public function index()	{
		$data['clubs'] = $this->admin_club->get_clubs();
		$data['main_content'] = 'admin/club';
		$this->load->view('admin/includes/template', $data);		
	}
	public function add() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'required|trim|xss_clean|callback_club_exists');
		$this->form_validation->set_rules('short_name', 'short_name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('yu_name', 'yu_name', 'required|trim|xss_clean|callback_yu_club_exists');
		$this->form_validation->set_rules('image', 'image', 'callback_handle_upload');
		
		$config['upload_path'] = 'uploads/club/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['create_thumb'] = FALSE;

		$this->load->library('upload', $config);
		
		if($this->form_validation->run() == FALSE)  {
			$data['main_content'] = 'admin/club_add';
			$this->load->view('admin/includes/template', $data);
		} else {
			$inserted_image = $this->upload->data();
			
			$sizes = array('128', '96', '72', '64', '48', '32', '24');

			foreach ($sizes as $size) {
				$config['image_library'] = 'gd2';
				$config['source_image'] = $inserted_image['full_path'];
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = $size;
				$config['height'] = $size;
				$config['create_thumb'] = FALSE;
				$config['new_image'] = $this->input->post('yu_name') . '-' . $size . $inserted_image['file_ext'];
				$this->load->library('image_lib', $config);
				$this->image_lib->initialize($config);
                        	if(!$this->image_lib->resize()){
					echo "Failed." .$size . $this->image_lib->display_errors();
				}
			}
			$image_ext = $inserted_image['file_ext'];
			if(!unlink($inserted_image['full_path'])) { echo 'Couldn\'t delete image'; }
			if($this->admin_club->CU($image_ext)) {
				redirect('admin/club');
			} else {
				echo 'could not add';
			}
		}
	}
	
	public function edit($id = 0)
	{
		if(!is_numeric($id) || $id == 0){ redirect(base_url()); }
		$data['categories'] = $this->m_categories->get_categorie($id);

		$data['main_content'] = 'v_categories_edit';
		$data['sidebar'] = 'includes/categories';
		$this->load->view('includes/template', $data);
	}
	
	public function editgo()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('cats', 'cats', 'required');

		
		if($this->form_validation->run() == FALSE)
		{
			$data['main_content'] = 'v_categories_edit';
			$data['sidebar'] = 'includes/categories';
			$this->load->view('includes/template', $data);
		}
		else
		{			
			if($query = $this->m_categories->CU_categorie()) //CU is Create Update
			{
				redirect('categories');
			}
			else
			{
				echo 'could not edit keyword';
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

