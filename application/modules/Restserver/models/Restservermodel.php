<?php
class RestServerModel extends CI_Model{
    function getUserInfoForApp($deviceid, $username, $password){
        $this->db->where('Username',$username);
        $this->db->where('Password',$password);
        //$this->db->where('DeviceID',$deviceid);
        $this->db->where('IsActive','yes');
        return $this->db->get('users');
    }

    function addUserLogInformation($data){
        $this->db->insert('users_log',$data);
    }

    function addTransactionLogInformation($data){
        $this->db->insert('transaction_log',$data);
    }

    function addLogInformation($data)
    {
        $this->db->insert('geolog', $data);
        return $this->db->insert_id();
    }

    function getTableListByTableName($table){
        $this->db->where('IsActive','yes');
        return $this->db->get($table);
    }

    function addCheckInOut($data){
        $this->db->insert('check_log', $data);
    }
    function getEmployeeData($id){
        $this->db->select('*');
        $this->db->where('variant','1');
        $this->db->where('userID', $id);
        $this->db->where('action','IN');
        $this->db->order_by('dateTime', 'DESC');
        $this->db->limit(1,0);
        $query = $this->db->get('geolog');
        return $query->row();
    }
    function mergeData($data)
    {
        $this->db->insert('identity_operational.geolog', $data);
    }
    function updateData($id, $data)
    {
        $this->db->where('ID', $id);
        $this->db->update('geolog', $data);
    }
}