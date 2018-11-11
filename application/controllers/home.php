<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Home extends CI_Controller {
 
	public function index()
	{
		$this->load->view('header');
		$this->load->view('home');
	}
	
	public function subscribe(){
		$this->load->model('subscribe');
		
		$emailid = $this->input->post('emailid');
		
		$findEmailId = $this->subscribe->getUserById($emailid);
		if ($findEmailId == 2){
			//email is registered waiting for email verfication
			echo $emailid.' is registered and waiting for email verfiication';
		}
		else if ($findEmailId == 1){
			//email already registered
			echo $emailid.' is already registered';
		}
		else if ($findEmailId == 0){
			// email doesnot exists
		
			$t=time();
			$time = date("Y-m-d H:i:s", $t);
			$token = md5(uniqid(rand(), true));
		
			$data = array(
				'emailid' => $emailid,
				'timeOfSubscription' => $time,
				'password' => '',
				'validationtoken' => $token,
				'validationrequired' => 'Y'
			);
			
			if($this->sendEmail($emailid,$token)){
				
				$this->subscribe->newSubcriber($data);
				echo 'Verification link is send to '.$emailid.', please verifiy';
				log_message('debug',$emailid.' is saved in DB and email is sent',false);
				
			}else{
				$this->subscribe->deleteUserById($emailid);
				echo 'Problem in sending email';
				log_message('debug',$emailid.' email cannot be sent',false);
			}
		}
		
	}
	
	public function setpassword(){
		$this->load->model('subscribe');
		
		$password = $this->input->post('password');
		$emailid = $this->input->post('emailid');
		
		$this->subscribe->updatePassword($emailid,$password);
		echo '200';
		
	}
	
	public function verification(){
		$this->load->model('subscribe');
		
		$emailid = $this->input->get('email');
		$token = $this->input->get('token');
		
		$findEmailId = $this->subscribe->getUserById($emailid);
		if ($findEmailId == 2){
			//email is registered waiting for email verfication
			$this->subscribe->verifyUser($emailid,$token);
			
			$this->load->view('header');
			$data = array ('email' => $emailid);
			$this->load->view('setpassword',$data);
			
		}
	}
	
	public function sendEmail($emailid,$token){
		
		$config = Array(
  		'protocol' => 'smtp',
  		'smtp_host' => 'in-v3.mailjet.com',
  		'smtp_port' => 587,
		'smtp_user' => '4f35aeb0ab59bb4de90bf4fdf8316a46', 
  		'smtp_pass' => '6f040eb2b7264d8942b5f25aad75f312', 
		);

        $message = 'Please verfiy account from below link: '.site_url('home/verification?email='.$emailid.'&token='.$token);
		
        $this->load->library('email', $config);
      	$this->email->set_newline("\r\n");
      	$this->email->from('osamakhn54@gmail.com'); 
      	$this->email->to($emailid);
		$this->email->subject('d-Fast Newsletter account verification');
      	$this->email->message($message);
		if($this->email->send()){
      		return true;
     	}
     	else{
			log_message('debug',show_error($this->email->print_debugger()),false);
     		return false;
    	}
	}
}