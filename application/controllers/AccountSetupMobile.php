<?php
/**
|	Page Name 			:  Account Setup  
|	Author   				:  Byron Jester
|	Created by   		:	 Byron Jester
|	DAte Created   	:	 April 11, 2018
|	Last Updated 		:  April 13, 2018
|	Last update by  :  Byron Jester
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class AccountSetupMobile extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('accountSetup_modelMobile', 'bal');
	}

	#Register Accounts
	public function register(){
		$this->load->model('accountSetup_modelMobile', 'bal');
		$code 					= 0;
		$msg 						= "Succesfully Added";

		$username 			= trim($this->input->post('username'));
		$password 			= trim($this->input->post('password'));
		$email 					= trim($this->input->post('email'));
		$name 					= trim($this->input->post('name'));
		$phone 					= trim($this->input->post('phone'));


		if($username 				== ""){
			$msg 					= "Incomplete Registration";
			goto end_register;
		}

		elseif($password 				== ""){
			$msg 					= "Incomplete Registration";
			goto end_register;
		}

		elseif($email 				== ""){
			$msg 					= "Incomplete Registration";
			goto end_register;
		}

		elseif($name 				== ""){
			$msg 					= "Incomplete Registration";
			goto end_register;
		}

		elseif($phone 				== ""){
			$msg 					= "Incomplete Registration";
			goto end_register;
		}

		$data 					= [$username, $password, $email, $name, $phone];
		$hb 						= $this->bal->register($data);

		

		if($hb > 0){
			$code 				= 1;
			$msg 					= "Registration was successful!";
		}else{
			$msg 		  		= "An error has occurred while trying to save your data!";
		}

		end_register:
		$rs['code'] 		= "$code";
		$rs['msg'] 			= $msg;
		echo json_encode($rs);
	}

	#Login Account
	public function login(){
		$this->load->model('accountSetup_modelMobile', 'bal');

		$code 					= 0;
		$msg 						= "Succesful";

		$username 			= trim($this->input->post('username'));
		$password 			= trim($this->input->post('password'));

			
		$data		= [$username, $password];
		$exb 		= $this->bal->login($data);

		if($exb){
			$code 				= 1;
			$msg 					= "Succesfully Login";
		}else{
			$msg 		  		= "Invalid Username or Password!";
		}

		$rs['code'] 		= "$code";
		$rs['msg'] 			= $msg;
		echo json_encode($rs);
	}

  #Get Names
	public function getNames(){
		$this->load->model('accountSetup_modelMobile', 'bal');

			$name 							= "";
			$userData 					= $this->bal->getNames();
			if ($userData->num_rows() > 0) {
				$rowUser 					= $userData->row_array();
				$name 						= $rowUser['name'];
			}

				$names[] 				= [
					'name' 						=> $name,
				];
		echo json_encode($names);
	}
}

