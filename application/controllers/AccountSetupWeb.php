<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccountSetupWeb extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model('accountSetup_modelWeb', 'bal');
	}

	#index
	public function index(){
		if(!$this->session->userdata('logged_in')){
			$this->load->view('templates/header');
			$this->load->view('accounts/register_account');
			$this->load->view('templates/footer');
		}else{
			redirect('UserStatusWeb/nfHome');
		}
	}	

	#Register Account
	public function registerAccount(){
		$config = array(
         array(
                 'field' => 'un',
                 'label' => 'un',
                 'rules' => 'required|trim|htmlspecialchars'
         ),
         array(
                 'field' => 'pw',
                 'label' => 'pw',
                 'rules' => 'required|trim|htmlspecialchars'
         ),
         array(
                 'field' => 'nm',
                 'label' => 'nm',
                 'rules' => 'required|trim|htmlspecialchars'
         ),
         array(
                 'field' => 'em',
                 'label' => 'em',
                 'rules' => 'required|trim|htmlspecialchars'
         ),
         array(
                 'field' => 'pn',
                 'label' => 'pn',
                 'rules' => 'required|trim|htmlspecialchars'
         ),
		);

    $this->form_validation->set_rules($config);
      if ($this->form_validation->run() == FALSE) {
      	echo "Error";
      }else{
				$uname 			= $this->input->post('un');
				$pword 			= $this->input->post('pw');
				$nme 				= $this->input->post('nm');
				$eml			  = $this->input->post('em');
				$pnumber 		= $this->input->post('pn');

				$exb = $this->upload();
				$data = [$exb, $uname, $pword, $nme, $eml, $pnumber];
				$hb = $this->bal->registerAccount($data);

				if($hb){
					echo "success";
				}else{
					return false;
				}
			}
	}

	#Login Account
	public function loginAccount(){
		$config = array(
         array(
                 'field' => 'un',
                 'label' => 'un',
                 'rules' => 'required|trim|htmlspecialchars'
         ),
         array(
                 'field' => 'pw',
                 'label' => 'pw',
                 'rules' => 'required|trim|htmlspecialchars'
         ),
		);
    $this->form_validation->set_rules($config);
      if ($this->form_validation->run() == FALSE) {
      	echo "Error";
      }else{
				$username =	$this->input->post('un');
				$password =	$this->input->post('pw');

				$userdata 	= $this->bal->loginAccount($username, $password);
				if($userdata){
					$result = $this->bal->getUsers($username);
					$session = array('user_id' => $result['user_id'], 'name' => $result['name'], 'logged_in' => true);
					$this->session->set_userdata($session); 	
					echo "Success";
				}else{
					return false;
				}
			}
	}

	#Log out account
	public function logout(){
			$this->session->unset_userdata('name');
			$this->session->unset_userdata('user_id');
   		$this->session->unset_userdata('logged_in');
			redirect(base_url());	
	}

	#Edit Account
	public function editAccount(){
		$config = array(
         array(
                 'field' => 'un',
                 'label' => 'un',
                 'rules' => 'required|trim|htmlspecialchars'
         ),
         array(
                 'field' => 'pw',
                 'label' => 'pw',
                 'rules' => 'required|trim|htmlspecialchars'
         ),
         array(
                 'field' => 'nm',
                 'label' => 'nm',
                 'rules' => 'required|trim|htmlspecialchars'
         ),
         array(
                 'field' => 'em',
                 'label' => 'em',
                 'rules' => 'required|trim|htmlspecialchars'
         ),
          array(
                 'field' => 'pn',
                 'label' => 'pn',
                 'rules' => 'required|trim|htmlspecialchars'
         ),
		);
    $this->form_validation->set_rules($config);
      if ($this->form_validation->run() == FALSE) {
      	echo "Error";
      }else{
			$id = $this->input->post('user_id');
			$username		= $this->input->post('un');
			$password		= $this->input->post('pw');
			$name				= $this->input->post('nm');
			$email			= $this->input->post('em');
			$phone			= $this->input->post('pn');

      $data = array(
          'username'  	=> $username,
          'password'  	=> $password,
          'name'   		 	=> $name,
          'email'   		=> $email,
          'phone' 			=> $phone
   
      );

      $result = $this->bal->editAccount($id,$data);

      if($result){
      	$session = array('user_id' => $result['user_id'], 'name' => $result['name'], 'logged_in' => true);
				$this->session->set_userdata($session);
      }else{
        return false;
      }
    }
  } 

 	#Show Profile
	public function showAccount(){
		$id = $this->session->userdata('user_id');
		$res = $this->bal->showAccount($id);
		echo json_encode($res);
	}

	#Upload Image
	public function upload(){
   	if(isset($_FILES["img_id"])){
	    $extension = explode('.', $_FILES['img_id']['name']);
	    $new_name = $extension[0] . '.' . $extension[1];
	    $destination = './uploads/'. $new_name;
	    move_uploaded_file($_FILES['img_id']['tmp_name'], $destination);
	    return $new_name;
    }
  }

  #Delete Account
  public function deleteAccount(){
		$data 	= $this->input->post('username');
		$res		= $this->bal->deleteAccount($data);
		echo json_encode($res);
	}
}
