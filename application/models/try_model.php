<?php
/**
|	Page Name 			:  Model 
|	Author   				:  Byron Jester
|	Created by   		:	 Byron Jester
|	DAte Created   	:	 April 11, 2018
|	Last Updated 		:  April 18, 2018
|	Last update by  :  Byron Jester
*/

defined('BASEPATH') OR exit('No ');

class try_model extends CI_Model {

	#Register Account
	public function register($data){
		$sql = "INSERT INTO users_tbl (username, password, email, name, phone) VALUES (?,?,?,?,?)";
		
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

	#Post Status
	public function postStatus($postStatus){
		$sql = "INSERT INTO posts_tbl (post_status) VALUES (?)";
		
		$q = $this->db->query($sql, $postStatus);
		if($this->db->insert_id()){
			return $this->db->insert_id();
		}else{
			return 0; 
		}
	}

	#Display Post 
  public function getNewsFeed(){
    $sql = "SELECT * FROM posts_tbl WHERE isactive = 1";
    $q = $this->db->query($sql, []);
    return $q;
	}

	#Display Comment Counts
	public function getComments($postID){
		$values = [$postID];
    $sql = "SELECT * FROM post_comments_tbl WHERE isactive = 1";
    $q = $this->db->query($sql, $values);
    return $q;
	}

	#Display Like Counts
	public function getLikes($postID){
		$values = [$postID];
    $sql = "SELECT * FROM post_likes_tbl WHERE isactive = 1";
    $q = $this->db->query($sql, $values);
    return $q;
	}

	#Display Name 
	public function getUserData($userID){
		$values 	= [$userID, 1];
    $sql 			= "SELECT * FROM users_tbl WHERE user_id = ? AND isactive = ?";
    $q 				= $this->db->query($sql, $values);
    return $q;
	}
}











