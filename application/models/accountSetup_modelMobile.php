<?php
/**
|	Page Name 			:  Model 
|	Author   				:  Byron Jester
|	Created by   		:	 Byron Jester
|	DAte Created   	:	 April 11, 2018
|	Last Updated 		:  April 13, 2018
|	Last update by  :  Byron Jester
*/

defined('BASEPATH') OR exit('No ');

class accountSetup_modelMobile extends CI_Model {

	#Register Account
	public function register($data){
		$sql = "INSERT INTO users_tbl (p_image, username, password, email, name, phone) VALUES (?,?,?,?,?,?)";
		
		$q = $this->db->query($sql, $data);
		if($this->db->insert_id()){
			return $this->db->insert_id();
		}else{
			return 0; 
		}
	}

	#Login Account
	public function login($data){
    $sql = "SELECT * FROM users_tbl WHERE username = ? and password = ?";

    $q = $this->db->query($sql, $data);

    if($q->num_rows()>0){
      return $this->db->query($sql, $data);
  	}else{
  		return 0;
  	}
	}

	#Display Name
	public function getNames(){
    $sql = "SELECT * FROM users_tbl WHERE isactive = 1";
    $q = $this->db->query($sql, []);
    return $q;
	}
}