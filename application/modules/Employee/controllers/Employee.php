<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->container = 'main';
		$this->load->model('Employeemodel');
	}

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{
		if($this->session->userdata('AUTH_USER_ID') !=''){
			$this->ListAll();
		}else{
			$this->session->set_flashdata('login_error', 'Invalid login details');
			$this->session->set_userdata('return_url', current_url());
			redirect('Login');
		}
	}
// 	****************************************************************************
// *                    Listing page for employee location                    *
// ****************************************************************************
	public function ListAll()
	{
		if($this->session->userdata('AUTH_USER_ID') !=''){
			if($this->input->post('Submit')!='')
			{
				$employeeID = $this->input->post('Employee');
				$fromdate = $this->input->post('FromDate');
				$todate = $this->input->post('ToDate');
				$data['show'] ='show';
				$data['employeeID']	  = $employeeID;
				$query = $this->Employeemodel->ListEmployee();
				$data['selectedemployeedropdown'] = $this->GetDropDown($query,'ID', 'Name',$employeeID);
				$data['employeedata'] =$this->Employeemodel->GetEmployeeInformation($fromdate, $todate);
				$data['fromdate']	= $fromdate;
				$data['todate']		= $todate;
				$this->load->library('googlemaps')	;

				$config['zoom'] = 'auto';
				$this->googlemaps->initialize($config);
				$count = 1;
				$polyline['points'] = array();
				foreach($data['employeedata']->result() as $row){
                    $mapdata = $row->LogData; 
                    $mapdatas = json_decode($mapdata);
                    if($mapdatas->userID == $employeeID)
                    {
                    	if(isset($mapdatas->latitude)){
							$marker = array();
							$lat=$mapdatas->latitude;
							$long=$mapdatas->longitude;
							$marker['position'] = $lat.','. $long;
							$marker['infowindow_content'] = $count++;
							$this->googlemaps->add_marker($marker);

							array_push($polyline['points'],$marker['position']);
							
							
						}
					}
				}
				if(empty($marker))
				{
					$config['center']= "Kathmandu";
					$this->googlemaps->initialize($config);
				}
				$this->googlemaps->add_polyline($polyline);
				$data['map'] = $this->googlemaps->create_map();
			}
			$query = $this->Employeemodel->ListEmployee();
			$data['employeedropdown'] = $this->GetDropDown($query,'ID', 'Name');
			$data['title'] = 'Employee Tracking';
			$data['page'] = 'employee';
			$data['script'] = 'employeejs';
			$this->load->view($this->container, $data);	
		}else{
			$this->session->set_flashdata('login_error', 'Invalid login details');
			$this->session->set_userdata('return_url', current_url());
			redirect('Login');
		}
	}
	public function GetDropDown($query, $idfield, $titlefield, $empID='')
	{
		if($this->session->userdata('AUTH_USER_ID') !=''){
			$DataToReturn = '';//'<option value="0">Select District</option>';
			if($query->num_rows()>0){
				foreach($query->result() as $row):
					$selected ='';
					if($empID !='')
					{
						if($row->ID == $empID)
						{ 
							$selected = 'selected="selected"';
						}
						else
						{
							$selected = '';
						}
					}
					
					$DataToReturn .= '<option value="'.$row->$idfield.'"'.$selected.' >'.ucwords($row->$titlefield).'</option>';

				endforeach;
			}
			return $DataToReturn;
		}else{
			$this->session->set_flashdata('login_error', 'Invalid login details');
			$this->session->set_userdata('return_url', current_url());
			redirect('Login');
		}
	}
}
