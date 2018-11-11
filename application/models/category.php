<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php
class Category extends CI_Model{
	
	public function getNews(){
		
		$this->db->select('*');
    	$this->db->from('newscategory');
    	$query = $this->db->get();    
    	if($query->num_rows() > 0){
			return $query->result();
		}else{
			return null;
		}
		
	}
}