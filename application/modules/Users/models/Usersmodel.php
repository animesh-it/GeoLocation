<?php
	class UsersModel extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->table = 'users';
		}

		function getAllUsers(){
			$this->db->where('IsAdmin','no');
			return $this->db->get($this->table);
		}

		function add($data){
			$this->db->insert($this->table, $data);
		}

		function edit($id,$data){
			$this->db->where('ID',$id);
			$this->db->update($this->table, $data);
		}

		function getData($id){
			$this->db->where('ID',$id);
			return $this->db->get($this->table);
		}
		
		function getAllTransaction(){
					$this->db->order_by('ID','DESC');
			return $this->db->get('transaction_log');
		}
	}