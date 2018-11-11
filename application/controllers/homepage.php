<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Homepage extends CI_Controller {
 
	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
	}
	
	public function index()
	{
		
		$this->load->view('header');
//		$this->load->model('category');
//		$result = $this->category->getNews();
		$this->load->view('homepage');
	}
	
	public function changePassword(){
		
		$this->load->view('header');
		$this->load->view('changepassword');
	}
	
	public function setPassword(){
		$this->load->model('subscribe');
		
		$newpassword = $this->input->post('newpassword');
		$oldpassword = $this->input->post('oldpassword');
		$emailid = $this->input->post('emailid');
		
		if($this->subscribe->userValidate($emailid,$oldpassword)){
			if($oldpassword != $newpassword){
				$this->subscribe->updatePassword($emailid,$newpassword);
				$this->session->unset_userdata('emailid');
				$this->session->sess_destroy('emailid');
				echo '200';
			}else{
				echo 'New password is same as old password';
			}
		}else{
			echo 'Old password is wrong';
		}
	}
	
	public function logout(){
		$this->session->unset_userdata('emailid');
		$this->session->sess_destroy('emailid');
		redirect('home');
	}
}
?>