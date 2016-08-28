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
				$direction = $this->input->post('directionOnly');
				$data['show'] ='show';
				$data['employeeID']	  = $employeeID;
				$query = $this->Employeemodel->ListEmployee();
				$data['selectedemployeedropdown'] = $this->GetDropDown($query,'ID', 'Name',$employeeID);
				$data['employeedata'] =$this->Employeemodel->GetEmployeeInformation($fromdate, $todate, $employeeID);
				$data['fromdate']	= $fromdate;
				$data['todate']		= $todate;
				$this->load->library('googlemaps')	;

				$config['zoom'] = 'auto';
				$config['directions'] = TRUE;
				$config['minifyJS'] = TRUE;
				$config['directionsMode'] = "DRIVING";
				$config['directionsWaypointArray'] = array();
				$count = 1;
				$lastCount = $data['employeedata']->num_rows();
				$waypoint = $lastCount/8;
				$waypoints = 1;
				foreach($data['employeedata']->result() as $row){
                	if(isset($row->latitude)){
						$marker = array();
						$lat=$row->latitude;
						$long=$row->longitude;
						if($direction == "true" || $direction =="both"){
							if($count=='1')
							{
								$config['directionsStart']=$lat.','. $long;
							}
							else if($lastCount==$count)
							{
								$config['directionsEnd'] = $lat.','. $long;
							}
							if(($count%$waypoint)==0 && $waypoints <9)
							{
								array_push($config['directionsWaypointArray'],($lat.','. $long));
								$waypoints++;
							}
						}
						if($direction == "false" || $direction =="both"){
							$marker['position'] = $lat.','. $long;
							$marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld='.$count.'|FF0000|FFFFFF';
							$this->googlemaps->add_marker($marker);
						}
						$count++;
					}	
				}
				if(empty($marker))
				{
					$config['center']= "Kathmandu";
				}
				$this->googlemaps->initialize($config);
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
			$DataToReturn = '';
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
	public function MapData()
	{
		if($this->input->post('Submit')!='')
		{

			$count = '1';
			$employeeID = $this->input->post('Employee');
			$fromdate = $this->input->post('FromDate');
			$todate = $this->input->post('ToDate');
			$data['show'] ='show';
			$data['employeeID']	  = $employeeID;
			$query = $this->Employeemodel->ListEmployee();
			$data['selectedemployeedropdown'] = $this->GetDropDown($query,'ID', 'Name',$employeeID);
			$data['employeedata'] =$this->Employeemodel->GetEmployeeInformation($fromdate, $todate, $employeeID);
			$data['fromdate']	= $fromdate;
			$data['todate']		= $todate;
			$this->load->library('googlemaps')	;

			$config['zoom'] = 'auto';
			$config['directions'] = TRUE;
			$config['minifyJS'] = TRUE;
			$config['directionsMode'] = "DRIVING";
			$lastCount = $data['employeedata']->num_rows();
			
			foreach($data['employeedata']->result() as $row){
            	if(isset($row->latitude)){
					$marker = array();
					$lat=$row->latitude;
					$long=$row->longitude;
					if($count === '1')
					{
						$config['directionsStart']=$lat.','. $long;
					}
					else if( $lastCount == $count)
					{
						$config['directionsEnd'] = $lat.','. $long;
					}
					else
					{
						// array_push($config['directionsWaypointArray'],$marker['position']); 	
					}
					$marker['position'] = $lat.','. $long;
					$marker['title'] = $count++;
					$this->googlemaps->add_marker($marker);
				}	
			}
			if(empty($marker))
			{
				$config['center']= "Kathmandu";
			}
			$this->googlemaps->initialize($config);
			$data['map'] = $this->googlemaps->create_map();
			$query = $this->Employeemodel->ListEmployee();
			$data['employeedropdown'] = $this->GetDropDown($query,'ID', 'Name');
			echo $this->load->view('maps', $data);
		}
	}
}
