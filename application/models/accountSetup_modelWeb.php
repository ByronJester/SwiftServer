<?php
defined('BASEPATH') OR exit('No ');

class accountSetup_modelWeb extends CI_Model {

	#Register Account
	public function registerAccount($data){
		$sql = "INSERT INTO users_tbl (p_image, username, password, name, email, phone) VALUES (?, ?, ?, ?, ?, ?)";
		$q = $this->db->query($sql, $data);

		if($q){
			echo 'success';
		}else{
			return false;
		}
	}

	#Login Account
	public function loginAccount($username, $password){
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$q = $this->db->get('users_tbl');
		if($q->num_rows()>0){
			return true;
		}
		else{
			return false;
		}
	}

	#Get User Information
	public function getUsers($username){
		$this->db->where('username',$username);
	   $result = $this->db->get('users_tbl');
	   if($result->num_rows() > 0){
	      return $result->row_array();
	   }else{
	      return false;
	   }
	}

	#Edit Account
	public function editAccount($id,$data){
		 $this->db->where('user_id',$id);
   	 $query = $this->db->update('users_tbl',$data);
   	 if($query){
   	 	echo 'success';
   	 }else{
   	 	return false;
   	 }	
  }

  #Display Post
	public function showAccount($id){
		$this->db->where('user_id', $id);
		$q = $this->db->get('users_tbl');
		if($q->num_rows() > 0) {
			return $q->result();
		}else{
			return false;
		}
	}

	#Delete Account
	public function deleteAccount($data){
	  $sql = "DELETE FROM users_tbl WHERE user_id = ?";
	  return $this->db->query($sql, $data);		
	}
}