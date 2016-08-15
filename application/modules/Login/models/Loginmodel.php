<?php
	class LoginModel extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->table = 'users';
			
		}

		function getUserInfo($username, $password){
			$this->db->select('ID, Username, Name');
			$this->db->from($this->table);
			$this->db->where('UserName',$username);
			$this->db->where('Password',$password);
			$this->db->where('IsActive',1);
			return $this->db->get();
		}
	}