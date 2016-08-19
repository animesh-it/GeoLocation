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

	function GetEmployeeInformation($fromdate)
	{
		return $this->db->query('SELECT * FROM geolog WHERE DATE(DateOfLog)>= "'.date('Y-m-d H:i:s',strtotime($fromdate)).'"  AND LogData LIKE "%userID%"');
	}
	function AddToMergeDB($data)
	{
		$this->opdb->insert('geolog', $data);
	}
}
?>