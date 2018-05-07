<?php
/**
|	Page Name 			:  User Status  
|	Author   				:  Byron Jester
|	Created by   		:	 Byron Jester
|	DAte Created   	:	 April 15, 2018
|	Last Updated 		:  April 18, 2018
|	Last update by  :  Byron Jester
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class UserStatusMobile extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model('userStatus_modelMobile', 'bal');
	}

	public function index(){
		$this->load->model('userStatus_modelMobile', 'bal');
	}

	#Post Status
	public function postStatus(){
		$this->load->model('userStatus_modelMobile', 'bal');
		$code 					= 0;
		$msg 						= "Succesful";


		$postStatus			= trim($this->input->post('postStatus'));

		if($postStatus 				== ""){
			$msg 					= "Invalid to post blank";
			goto end_post;
		}

		$username   		= $this->session->userdata('user_id');
		$ps							= $this->bal->postStatus($postStatus);


		if($ps > 0){
			$code 				= 1;
			$msg 					= "Posted Succesfully!";
		}else{
			$msg 		  		= "Error Posting!";
		}

		end_post:
		$rs['code'] 		= "$code";
		$rs['msg'] 			= $msg;
		echo json_encode($rs);
	}

	#Upload Images
	public  function upload_image(){  
		$this->load->view('upload');
	}


	public function upload(){

		$uploadedFile   = $_FILES['uploadedFile'];
		$target_dir 		= "uploads/";
		$target_file 		= $target_dir . basename($_FILES["uploadedFile"]["name"]);
		$code			 			= 0;
		$imageFileType 	= strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["uploadedFile"]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $code = 1;
		    } else {
		        echo "File is not an image.";
		    }

		    #Check if the file is already exist
		    if (file_exists($target_file)) {
					 echo "Sorry, file already exists.";
					 echo ($target_file);
					 $code = 0;
				}
				
				#Check if successfully uploaded
		    if ($code == 1) {
		    	$data_t									= [move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], $target_file)];
		    	$data_i['images'] 			= $target_file;

		    	if ([$data_t, $this->bal->insertImages($data_i)]) {
		    		echo "File was successfully uploaded";
		    		echo ($target_file);
		    	}
		    }
		}
	}

	#GET NEWSFEED DATA
	public function newsfeedData(){
		$this->load->model('userStatus_modelMobile', 'bal');
		$post 						= $this->bal->getNewsFeed();
		$newsfeed 				= [];

		if ($post->num_rows() > 0) {
			foreach ($post->result_array() as $row) {
				extract($row);
		
				$name 							= "";
				$userData 					= $this->bal->getUserData($name);
				if ($userData->num_rows() > 0) {
					$rowUser 					= $userData->row_array();
					$name 						= $rowUser['name'];

				}
						// $images 							= "";
						// $userImage 						= $this->bal->getImg($user_id);
						// if ($userImage->num_rows() > 0) {
						// 	$rowImage 					= $userImage->row_array();
						// 	$images							= $rowImage['images'];
						// }
				

						$newsfeed[] 					= [
							// 'Images'						=> $images,
							'name' 							=> $name,
							'postStatus'				=> $post_status,
							'likeCount'					=> $this->bal->getLikes($post_id)->num_rows(),
							'commentCount'			=> $this->bal->getComments($post_id)->num_rows()
						];	
			}
		}
		echo json_encode($newsfeed);
	}
}


