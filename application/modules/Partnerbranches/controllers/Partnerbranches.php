<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partnerbranches extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->container = 'main';
		$this->load->model('Partnerbranchesmodel');
	}

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
		if($this->session->userdata('AUTH_USER_ID')!=''){
			redirect('Partnerbranches/ListAll','location');
		}else{
			$this->session->set_flashdata('ERR_INVALID_LOGIN_ACCESS','You are not currently logged in.');
			redirect('Login','location');
		}
	}

	public function ListAll(){
		if($this->session->userdata('AUTH_USER_ID')!=''){
			$data['partnerbranches'] = $this->Partnerbranchesmodel->getAllPartnerbranches();
			$data['title'] = 'Manage Partner Branches';
			$data['page'] = 'listall';
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
				$partnerbranch['values']['Code'] = $this->input->post('Code');
				$partnerbranch['values']['Title'] = $this->input->post('Title');
				$partnerbranch['values']['CreatedAt'] = date('Y-m-d H:i:s');
				$partnerbranch['values']['CreatedBy'] = $this->session->userdata('AUTH_USER_ID');
				$this->Partnerbranchesmodel->add($partnerbranch['values']);
				$this->session->set_flashdata('SUCCESS','Partner branch has been successfully added.');
				redirect('Partnerbranches/ListAll');
			}
			$data['title'] = 'Add New Partner branch';
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
                $partnerbranch['values']['Code'] = $this->input->post('Code');
                $partnerbranch['values']['Title'] = $this->input->post('Title');
				$partnerbranch['values']['ModifiedAt'] = date('Y-m-d H:i:s');
				$partnerbranch['values']['ModifiedBy'] = $this->session->userdata('AUTH_USER_ID');
				$partnerbranch['values']['IsActive'] = $this->input->post('IsActive');
				$this->Partnerbranchesmodel->edit($id, $partnerbranch['values']);
				$this->session->set_flashdata('SUCCESS','Partner branch has been successfully updated.');
				redirect('Partnerbranches/ListAll');
			}
			$data['partnerbranch'] = $this->Partnerbranchesmodel->getData($id)->row();
			$data['title'] = 'Edit Partner branch';
			$data['page'] = 'edit';
			$data['script'] = 'addeditjs';
			$this->load->view($this->container, $data);
		}else{
			$this->session->set_flashdata('ERR_INVALID_LOGIN_ACCESS','You are not currently logged in.');
			redirect('Login','location');
		}
	}
}
