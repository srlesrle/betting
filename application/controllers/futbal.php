<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Futbal extends CI_Controller {
        public function index() {
                $data['main_content'] = 'rezultati-futbal';
                $this->load->view('includes/template', $data);
        }
}
?>

