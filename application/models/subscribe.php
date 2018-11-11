<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php
class Subscribe extends CI_Model{

	public function newSubcriber($data){
		$this->db->insert('subscribe', $data);
	}
	
	public function getUserById($id){
		
		$this->db->select('*');
    	$this->db->from('subscribe');
    	$this->db->where('subscribe.emailid', $id);
    	$query = $this->db->get();    
    	if($query->num_rows() > 0){
			$result = $query->result();
			if($result[0]->validationrequired == 'Y' || $result[0]->validationrequired == 'y' ){
				return 2;
			}else{
				return 1;
			}
		}
		else{
			return 0;
		}
	}
	
	public function deleteUserById($emailid){
		$this ->db->where('emailid', $emailid);
  		$this ->db->delete('subscribe');
	}
	
	public function verifyUser($emailid,$token){
		
		$this->db->set('validationrequired','N');
		$this->db->where('emailid',$emailid);
		$this->db->update('subscribe');
		
	}
	
	public function updatePassword($emailid,$password){
		
		$this->db->set('password',md5($password));
		$this->db->where('emailid',$emailid);
		$this->db->update('subscribe');
		
	}
	
	public function userValidate($emailid,$password){
		
		$this->db->select('*');
    	$this->db->from('subscribe');
    	$this->db->where('subscribe.emailid', $emailid);
    	$query = $this->db->get();    
    	if($query->num_rows() > 0){
			$result = $query->result();
			if ($result[0]->password == md5($password))
				return true;
			else return false;
		}else{
			return false;
		}
		
	}
}
?>