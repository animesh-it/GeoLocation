<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *This class checks for the variation of data beyond 20 meter. If it goes beyond, the data is copied to operational db.
 * @Author Prabhat Giri
 */
class MergeData extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->container = 'main';
		$this->load->model('Mergedatamodel');
	}

	/**
	 * Index Page for this controller.
	 * Calls the MergeData function with all the id's of registered users
	 */
	public function index()
	{
		if($this->session->userdata('AUTH_USER_ID') !=''){
			$query = $this->Mergedatamodel->ListEmployee();
			foreach($query->result() as $row)
			{
				$this->MergeData($row->ID);
			}
		}else{

		}
	}
	/**
	 * Checks whether the data varies more than 20 meter in radius
	 * If data doesnt vary, nothing is done
	 * If data varies more than 20 meter from the initial position 
	 * the new position is new initail position and the record is inserted into database
	 */
	public function MergeData($id)
	{
		$date = strtotime(date('Y-m-d H:i:s'));
		// $date = strtotime('2016-08-10 00:00:00');
		$starttime = date('Y-m-d H:00:00',strtotime("-3 hour", $date));
		$totime =  strtotime(date('Y-m-d H:59:59'));
		$employeedata =$this->Mergedatamodel->GetEmployeeInformation($starttime, $totime);
		if($employeedata->num_rows()>1)
		{
			$initlong ='';
			$initlat ='';
			$count = 0;
			$distance='';
			$earthRadius = 6371000;
			foreach($employeedata->result() as $row){
				$data = $row->LogData; 
				$data = json_decode($data);
				if($data->userID == $id)
	            {
            		if(isset($data->latitude)){
		            	if($count == 0)
						{
							$initlat = $data->latitude;
							$initlong = $data->longitude;
							$newData['DateOfLog'] = $row->DateOfLog;
							$newData['LogData']	  = $row->LogData;
							$dat =$this->Mergedatamodel->AddToMergeDB($newData);
							$count++;
						}
						else
						{
							$latFrom = deg2rad($initlat);
							$longFrom = deg2rad($initlong);

							$latTo = deg2rad($data->latitude);
							$longTo = deg2rad($data->longitude);
							
							$latDelta = $latTo - $latFrom;
							$longDelta = $longTo - $longFrom;

							$angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
							cos($latFrom) * cos($latTo) * pow(sin($longDelta / 2), 2)));
								$distance = $angle * $earthRadius;
							}
						if($distance > 20)
							{
							$newData['DateOfLog'] = $row->DateOfLog;
							$newData['LogData']	  = $row->LogData;
							$dat =$this->Mergedatamodel->AddToMergeDB($newData);
							$initlat = $data->latitude;
							$initlong = $data->longitude;	
						}
					}
				}
			}
		}
	}
}
