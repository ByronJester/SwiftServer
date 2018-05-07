<?php
defined('BASEPATH') OR exit('No ');

class userStatus_modelWeb extends CI_Model {

	#Post Status
	public function newsfeedData($postStatus,$username){
		$sql = "INSERT INTO posts_tbl (post_status, name) VALUES (?, (SELECT name FROM users_tbl WHERE user_id = '".$username."'))";	
		
		$q = $this->db->query($sql,$postStatus);
		if($q){
			echo 'success';
		}else{
			return false;
		}
	}

	#Display Post
	public function showPost(){
		$q = $this->db->get('posts_tbl');
		if($q->num_rows() > 0) {
			return $q->result();
		}else{
			return false;
		}
	}
}
