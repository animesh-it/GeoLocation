<?php 

?><?php
class EmployeeModel extends CI_Model{
	function __construct()
	{
		$this->opdb = $this->load->database('mergedb', true);
	}
	/**
	*Queries all the data 
	*@params void
	*@returns results
	*@created by Prabhat Giri
	*@modified by
	*/
	function ListEmployee()
	{
		$this->db->select('*');
		return $this->db->get('users');
	}

	function GetEmployeeInformation($fromdate, $todate)
	{
		return $this->opdb->query('SELECT * FROM geolog WHERE DATE(DateOfLog)>= "'.date('Y-m-d 00:00:00',strtotime($fromdate)).'" AND DATE(DateOfLog)<= "'.date('Y-m-d 23:59:59',strtotime($todate)));
	}
}
?>
