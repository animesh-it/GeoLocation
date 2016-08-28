<?php
	class PartnerbranchesModel extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->table = 'partner_branches';
		}

		function getAllPartnerbranches(){
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
	}