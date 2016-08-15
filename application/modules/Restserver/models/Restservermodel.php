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
    }

    function getTableListByTableName($table){
        $this->db->where('IsActive','yes');
        return $this->db->get($table);
    }

    function addCheckInOut($data){
        $this->db->insert('check_log', $data);
    }
}