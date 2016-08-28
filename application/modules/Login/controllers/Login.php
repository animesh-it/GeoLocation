<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Loginmodel');
	}

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
		if($this->session->userdata('AUTH_USER_ID') != ''){
			redirect('Dashboard','location');
		}else{
			// Check if the form is submitted
			if($this->input->post('btnsubmit')){
				// Check the username and password in the table
				$username = $this->input->post('username');
				$password = md5($this->input->post('password'));
				$userdetails = $this->Loginmodel->getUserInfo($username, $password);
				if($userdetails->num_rows()>0){
					// Store all the user details in session for userid, username, and fullname
					$userdata = array(
						'AUTH_USER_ID' => $userdetails->row()->ID,
						'AUTH_USER_NAME' => $userdetails->row()->Username,
						'AUTH_USER_FULL_NAME' => $userdetails->row()->Name
						);
					$this->session->set_userdata($userdata);
					// Redirect to dashboard
					redirect('Dashboard','location');
				}else{
					$this->session->set_flashdata('ERROR_LOGIN','Invalid Username and Password combination');
					redirect('Login','location');
				}
			}else{
				$this->load->view('login');
			}
		}
	}

	function Logout(){
		$userdata = array(
		'AUTH_USER_ID' => '',
		'AUTH_USER_NAME' => '',
		'AUTH_USER_FULL_NAME' => ''
		);
		$this->session->set_userdata($userdata);
		redirect('Login','location');
	}
}
