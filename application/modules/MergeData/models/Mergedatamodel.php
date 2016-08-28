<?php 

?><?php
class MergedataModel extends CI_Model{
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

	function GetEmployeeInformation($fromdate,$todate,$id)
	{
		return $this->db->query('SELECT * FROM geolog WHERE DateOfLog>= "'.date('Y-m-d H:i:s',strtotime($fromdate)).'"  AND DateOfLog<= "'.date('Y-m-d H:i:s',strtotime($todate)).'" AND latitude!="" AND longitude!="" AND userID ='.$id);
	}
	function AddToMergeDB($data)
	{
		$this->opdb->insert('geolog', $data);
	}
}
?>