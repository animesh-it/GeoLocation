<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->container = 'main';
		$this->load->model('Usersmodel');
	}

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
		if($this->session->userdata('AUTH_USER_ID')!=''){
			redirect('Users/ListAll','location');
		}else{
			$this->session->set_flashdata('ERR_INVALID_LOGIN_ACCESS','You are not currently logged in.');
			redirect('Login','location');
		}
	}

	public function ListAll(){
		if($this->session->userdata('AUTH_USER_ID')!=''){
			$data['users'] = $this->Usersmodel->getAllUsers();
			$data['title'] = 'Manage Users';
			$data['page'] = 'listall';
			$data['script'] = 'listjs';
			$this->load->view($this->container, $data);
		}else{
			$this->session->set_flashdata('ERR_INVALID_LOGIN_ACCESS','You are not currently logged in.');
			redirect('Login','location');
		}
	}
	
	public function TransactionLog(){
		if($this->session->userdata('AUTH_USER_ID')!=''){
			$data['query'] = $this->Usersmodel->getAllTransaction();
			$data['title'] = 'Transaction Log';
			$data['page'] = 'transactionlog';
			$data['script'] = 'listjs';
			$this->load->view($this->container, $data);
		}else{
			$this->session->set_flashdata('ERR_INVALID_LOGIN_ACCESS','You are not currently logged in.');
			redirect('Login','location');
		}
	}

	public function Add(){
		if($this->session->userdata('AUTH_USER_ID')!=''){
			if($this->input->post('Save')=='Save'){
				$user['values']['AgentCode'] = $this->input->post('AgentCode');
				$user['values']['Name'] = $this->input->post('Name');
				$user['values']['Email'] = $this->input->post('Email');
				$user['values']['DeviceID'] = $this->input->post('DeviceID');
				// $user['values']['APIPassword'] = $this->input->post('APIPassword');
				// $user['values']['GeoCode'] = $this->input->post('GeoCode');
				$user['values']['Username'] = $this->input->post('Username');
				$user['values']['Password'] = md5($this->input->post('Password'));
				$user['values']['CreatedAt'] = date('Y-m-d H:i:s');
				$user['values']['CreatedBy'] = $this->session->userdata('AUTH_USER_ID');
				$user['values']['IsActive'] = $this->input->post('IsActive');
				$this->Usersmodel->add($user['values']);
				$this->session->set_flashdata('SUCCESS','User has been successfully added.');
				redirect('Users/ListAll');
			}
			$data['title'] = 'Add New User';
			$data['page'] = 'add';
			$data['script'] = 'addeditjs';
			$this->load->view($this->container, $data);
		}else{
			$this->session->set_flashdata('ERR_INVALID_LOGIN_ACCESS','You are not currently logged in.');
			redirect('Login','location');
		}
	}

	public function Edit(){
		if($this->session->userdata('AUTH_USER_ID')!=''){
			$id = $this->uri->segment(3);
			if($this->input->post('Save')=='Save'){
				$user['values']['AgentCode'] = $this->input->post('AgentCode');
				$user['values']['Name'] = $this->input->post('Name');
				$user['values']['Email'] = $this->input->post('Email');
				$user['values']['DeviceID'] = $this->input->post('DeviceID');
				// $user['values']['APIPassword'] = $this->input->post('APIPassword');
				// $user['values']['GeoCode'] = $this->input->post('GeoCode');
				$user['values']['Username'] = $this->input->post('Username');
				if($this->input->post('Password') != '')
					$user['values']['Password'] = md5($this->input->post('Password'));
				$user['values']['CreatedAt'] = date('Y-m-d H:i:s');
				$user['values']['CreatedBy'] = $this->session->userdata('AUTH_USER_ID');
				$user['values']['IsActive'] = $this->input->post('IsActive');
				$this->Usersmodel->edit($id, $user['values']);
				$this->session->set_flashdata('SUCCESS','User has been successfully updated.');
				redirect('Users/ListAll');
			}
			$data['user'] = $this->Usersmodel->getData($id)->row();
			$data['title'] = 'Edit User';
			$data['page'] = 'edit';
			$data['script'] = 'addeditjs';
			$this->load->view($this->container, $data);
		}else{
			$this->session->set_flashdata('ERR_INVALID_LOGIN_ACCESS','You are not currently logged in.');
			redirect('Login','location');
		}
	}
}
