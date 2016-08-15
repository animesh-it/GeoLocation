<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Masterdata extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->model('restservermodel');

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        //$this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        //$this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        //$this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    public function index_get(){

    }

    public function getTableListByTableName_get(){
        $tablename = $this->get('Table');
        $tabledata = $this->restservermodel->getTableListByTableName($tablename);
        if($tabledata->num_rows()>0){
            $this->response($tabledata->result());
        }else{
            $data['table']['CODE'] = 1;
            $data['table']['MSG'] = 'No records exists in the table.';
            $this->response($data['table']);
        }
    }

    public function getAccess_post(){
        $deviceid = $this->post('DeviceID');
        $username = $this->post('Username');
        $password = $this->post('Password');
        $geocode = $this->post('GeoCode');

        $userinfo = $this->restservermodel->getUserInfoForApp($deviceid, $username, md5($password));
        if($userinfo->num_rows()>0){
            $this->load->helper('string');
            $sessionid = random_string('alnum',20);
            // Maintain User log for that session
            $data['userlog']['UserID'] = $userinfo->row()->ID;
            $data['userlog']['AgentCode'] = $userinfo->row()->AgentCode;
            $data['userlog']['DeviceID'] = $userinfo->row()->DeviceID;
            $data['userlog']['GeoCode'] = $userinfo->row()->GeoCode;
            $data['userlog']['SessionID'] = $sessionid;
            $data['userlog']['LogDate'] = date('Y-m-d H:i:s');
            $this->restservermodel->addUserLogInformation($data['userlog']);

            // Reply to the mobile app
            $data['user']['AgentCode'] = $userinfo->row()->AgentCode;
            $data['user']['APIPassword'] = $userinfo->row()->APIPassword;
            $data['user']['SessionID'] = $sessionid;
            $data['user']['CODE'] = 0;
            $data['user']['MSG'] = 'Successfully Logged In';
        }else{
            $data['user']['CODE'] = 1;
            $data['user']['CRITERIA'] = 'Either Username, Password or DeviceID doesnt match';
            $data['user']['MSG'] = 'Invalid Login.';
        }
        $this->response($data['user']);
    }

    public function newTransaction_post(){
        $agentcode = $this->post('AgentCode');
        $controlid = $this->post('ControlID');
        $deviceid = $this->post('DeviceID');
        $username = $this->post('UserName');
        $sessionid = $this->post('SessionID');
        $transactiondate = $this->post('TxnDate');
        $lat = $this->post('Lat');
        $long = $this->post('Long');

        // Insert in the transaction table
        $data['transactionlog']['AgentCode'] = $agentcode;
        $data['transactionlog']['ControlID'] = $controlid;
        $data['transactionlog']['DeviceID'] = $deviceid;
        $data['transactionlog']['Username'] = $username;
        $data['transactionlog']['SessionID'] = $sessionid;
        $data['transactionlog']['TransactionDate'] = $transactiondate;
        $data['transactionlog']['Latitude'] = $lat;
        $data['transactionlog']['Longitude'] = $long;
        if($this->restservermodel->addTransactionLogInformation($data['transactionlog'])){
            $data['transactionresponse']['CODE']=0;
            $data['transactionresponse']['MSG']='Successfully added the transaction info';
        }else{
            $data['transactionresponse']['CODE']=1;
            $data['transactionresponse']['MSG']='Some error occured. Please retry';
        }
        $this->response($data['transactionresponse']);
    }
}
