<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enregistrer extends CI_Controller{

	public function __construct(){
		parent ::__construct();
		$this->load->model('model_music');
	}
	public function index(){
		$this->load->view('layout/header');
		$this->load->view('SignUp');
		$this->load->view('layout/footer');
	}
	public function SignUp() {
    $pseudo = '';
    $login = '';
    $password = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['pseudo'])){
            $pseudo = $_POST['pseudo'];
            $login = $_POST['login'];
            $password = $_POST['password'];
        }
    }
    $this->model_music->SignUp($pseudo,$login,$password);
    $this->session->set_userdata('logged', true);
    $this->load->view('layout/header');
    redirect('albums');
}
}