<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
	}
 
	public function index()
	{
		$this->load->view('header');
		$this->load->view('login');
		
	}
	
	public function validateUser(){
		$this->load->model('subscribe');
		
		$password = $this->input->post('password');
		$emailid = $this->input->post('emailid');
		
		if($this->subscribe->userValidate($emailid,$password)){
			$this->session->set_userdata('emailid', $emailid);
			echo '200';
		}else{
			echo 'Wrong credentials';
		}
	}
}
?>