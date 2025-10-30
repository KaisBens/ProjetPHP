<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Connexion extends CI_Controller{

	public function __construct(){
		parent ::__construct();
		$this->load->model('model_music');
	}
	public function index(){
		$this->load->view('layout/header');
		$this->load->view('login');
		$this->load->view('layout/footer');
	}
	public function login() {

    $login = '';
    $password = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['login']) && isset($_POST['password'])){
            $login = $_POST['login'];
            $password = $_POST['password'];
        }
    }
    $result = $this->model_music->getLogin($login,$password);
if (count($result) > 0) {
    $this->session->set_userdata('login', $login);
    $this->session->set_userdata('logged', true);
    $this->load->view('layout/header');
    redirect('albums');
} else {
    $this->load->view('layout/header');
    $this->load->view('login');
    $this->load->view('layout/footer');
    echo "Invalid login or password";
}
}
}