<?php  

class Article_model extends CI_Model {
	public function __construct()
   {
      parent::__construct();
      $this->load->database();
   }

   public function entry_select($table,$condition,$or,$offset,$num){
   	
   	if($condition && $or){
   		if($offset && $num){
   			$query = $this->db->get_where($table, $condition, $num, $offset);
   		}else{
   			$query = $this->db->get_where($table, $condition, $num);
   		}
   	}else if($condition){
   		if($offset && $num){
   			$query = $this->db->get($table,$offset,$num);
   		}else{
   			$this->db->where('name !=', $name);
				$query = $this->db->or_where('id >', $id);
   		}
   	}
   	
   }

   public function entry_insert(){
   	
   }

   public function entry_delete(){
   	
   }

   public function entry_update(){
   	
   }

}
