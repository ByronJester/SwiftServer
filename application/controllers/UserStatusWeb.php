<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserStatusWeb extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model('userStatus_modelWeb', 'bal');
		$this->load->library('form_validation');

	}

	public function index(){
			if($this->session->userdata('logged_in')){
				$this->load->view('templates/header');
				$this->load->view('newsfeedviews/newsfeed_home');
				$this->load->view('templates/footer');
			}else{
				redirect(base_url());
			}		
		}

	#Post Status
	public function newsfeed(){
    $config = array(
         array(
                 'field' => 'pid',
                 'label' => 'pid',
                 'rules' => 'required|trim|htmlspecialchars'
         ),
		);
    $this->form_validation->set_rules($config);
      if ($this->form_validation->run() == FALSE){
      	echo "Error";
      }else{
        $username   = $this->session->userdata('user_id');
				$postStatus = $this->input->post('pid');

        $hb  = $this->bal->newsfeedData($postStatus,$username);
        if ($hb) {
        echo "Success";
        }else{
          	return false;
        }
      }
	}

	#Newsfeed Home View
	public function nfHome(){
		if($this->session->userdata('logged_in') == null ){
				redirect(base_url());
			}else{
				$this->load->view('templates/header');
				$this->load->view('newsfeedviews/newsfeed_home');
				$this->load->view('templates/footer');
			}
	}

	#Show Post Status
	public function showPost(){
		$res = $this->bal->showPost();
		echo json_encode($res);
	}

	public function profileInfo(){
				$this->load->view('templates/header');
				$this->load->view('newsfeedviews/profile_info');
				$this->load->view('templates/footer');
	}
}
