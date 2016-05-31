<?php
class Prediction extends User {
	function __construct(){
		parent::__construct();
		$this->load->model('m_prediction');
	}
	function index(){
		$data['predictions'] = $this->m_prediction->retrieve_prediction();
	}
	public function add() {
		$this->load->model('admin_game');
        //2012-05-07 15:42:27
                $data['hours']          = $this->admin_game->get_numbers(1, 24);
                $data['minutes']        = $this->admin_game->get_numbers(0, 59);
                $data['day']            = $this->admin_game->get_numbers(1, 31);
                $data['month']          = $this->admin_game->get_numbers(1, 12);
                $data['year']           = $this->admin_game->get_numbers(2012, 2015);

                $this->load->library('form_validation');
                $this->form_validation->set_rules('month', 'month', 'trim|required|xss_clean');
                $this->form_validation->set_rules('day', 'day', 'trim|required|xss_clean');
                $this->form_validation->set_rules('year', 'year', 'trim|required|xss_clean');
                $this->form_validation->set_rules('hours', 'hours', 'trim|required|xss_clean');
                $this->form_validation->set_rules('minutes', 'minutes', 'trim|required|xss_clean');
                $this->form_validation->set_rules('home', 'home', 'required|trim|xss_clean');
                $this->form_validation->set_rules('guest', 'guest', 'required|trim|xss_clean');
                $this->form_validation->set_rules('content', 'content', 'required|trim|xss_clean');
                $this->form_validation->set_rules('prediction', 'prediction', 'required|trim|xss_clean');


                if($this->form_validation->run() == FALSE)  {
                        $data['main_content'] = 'prediction_add';
                        $this->load->view('includes/template', $data);
                } else {
                        if($this->m_prediction->CU()) {
                                redirect('/');
                        } else {
                                echo 'could not add';
                        }
                }
        }

}
