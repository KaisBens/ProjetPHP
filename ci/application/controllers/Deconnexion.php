<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deconnexion extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('model_music');
	}

public function index() {
        $this->session->unset_userdata('logged');
        $this->session->sess_destroy(); 
        redirect('albums');  
    }
}