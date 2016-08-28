<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->container = 'main';
	}

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
		if($this->session->userdata('AUTH_USER_ID') !=''){
			$data['title'] = 'Central Authentication App | Dashboard';
			$data['page'] = 'dashboard';
			$this->load->view($this->container, $data);
		}else{

		}
	}
}
