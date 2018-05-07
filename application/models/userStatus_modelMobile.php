<?php
/**
|	Page Name 			:  Model 
|	Author   				:  Byron Jester
|	Created by   		:	 Byron Jester
|	DAte Created   	:	 April 11, 2018
|	Last Updated 		:  April 18, 2018
|	Last update by  :  Byron Jester
*/
class userStatus_modelMobile extends CI_Model {

#Post Status
	public function postStatus($postStatus){
		$sql 				= "INSERT INTO posts_tbl (post_status) VALUES (?)";
		$q 					= $this->db->query($sql, $postStatus);
		$w 					= $this->db->insert_id();

		if($this->db->insert_id()){
			return $w;
		}else{
			return 0; 
		}
	}

	#Display Post 
  public function getNewsFeed(){
    $sql 				= "SELECT * FROM posts_tbl WHERE isactive = 1";
    $q 					= $this->db->query($sql, []);
    return $q;
	}

	#Display Comment Counts
	public function getComments($postID){
		$values 		= [$postID];
    $sql 				= "SELECT * FROM post_comments_tbl WHERE isactive = 1";
    $q 					= $this->db->query($sql, $values);
    return $q;
	}

	#Display Like Counts
	public function getLikes($postID){
		$values 		= [$postID];
    $sql	  		= "SELECT * FROM post_likes_tbl WHERE isactive = 1";
    $q 					= $this->db->query($sql, $values);	
    return $q;
	}

	#Display Name 
	public function getUserData($userID){
		$values 		= [$userID, 1];
    $sql 				= "SELECT * FROM users_tbl WHERE user_id = ? AND isactive = ?";
    $q 					= $this->db->query($sql, $values);
    return $q;
	}

	#Upload Images
	public function insertImages($data_i){
		return $this->db->insert('img_tbl', $data_i);
	}

	#Display Image
	public function getImg($data){
		$data 			= [$data, 1];
		$sql 				= "SELECT * FROM img_tbl WHERE user_id = ? AND isactive = ?";
    $q 					= $this->db->query($sql, $data);
    return $q;
	}
}