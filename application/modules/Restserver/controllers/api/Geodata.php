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
class Geodata extends REST_Controller {

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

    public function newGeoLocation_post(){
        $logdate = date('Y-m-d H:i:s');
        $logdata = $this->post('LogData');
        $row = json_decode($logdata);
        
        $data['transactionlog']['action']                = ($row->action!='')?$row->action:'';
        $data['transactionlog']['callerID']              = ($row->callerID!='')?$row->callerID:'';
        $data['transactionlog']['carrier']               = ($row->carrier!='')?$row->carrier:'';
        $data['transactionlog']['dateTime']              = ($row->dateTime!='')?$row->dateTime:'';
        $data['transactionlog']['deviceID']              = ($row->deviceID!='')?$row->deviceID:'';
        $data['transactionlog']['ipAddress']             = ($row->ipAddress!='')?$row->ipAddress:'';
        $data['transactionlog']['latitude']              = ($row->latitude!='')?$row->latitude:'';
        $data['transactionlog']['longitude']             = ($row->longitude!='')?$row->longitude:'';
        $data['transactionlog']['locationAccessCode']    = ($row->locationAccessCode!='')?$row->locationAccessCode:'';
        $data['transactionlog']['mobileCountryCode']     = ($row->mobileAccessCode!='')?$row->mobileAccessCode:'';
        $data['transactionlog']['mobileNetworkCode']     = ($row->mobileNetworkCode!='')?$row->mobileNetworkCode:'';
        $data['transactionlog']['signalStrength']        = ($row->signalStrength!='')?$row->signalStrength:'';
        $data['transactionlog']['userID']                = ($row->userID!='')?$row->userID:'';
        
        // Insert in the transaction table
        // $data['transactionlog']['LogData'] = $logdata; removed and divided to multiple rows
        $data['transactionlog']['DateOfLog'] = $logdate;
        $id = $this->restservermodel->addLogInformation($data['transactionlog']);
        $this->mergeData($id, $data['transactionlog']['userID'], $data);
        $data['transactionresponse']['CODE']=0;
        $data['transactionresponse']['MSG']='Successfully added the log info';
        $this->response($data['transactionresponse']);
    }
    public function mergeData($id,$userID, $log)
    {
        $initlong = '';
        $initlat = '';
        $earthRadius = 6371000;
        foreach($log as $logData){
            $initlong   = $logData['longitude'];
            $initlat    = $logData['latitude'];
        }

        $query      = $this->restservermodel->getEmployeeData($userID);
        $latFrom    = deg2rad($initlat);
        $longFrom   = deg2rad($initlong);

        $latTo      = deg2rad($query->latitude);
        $longTo     = deg2rad($query->longitude);
        
        $latDelta   = $latTo - $latFrom;
        $longDelta  = $longTo - $longFrom;

        $angle      = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($longDelta / 2), 2)));
        $distance   = $angle * $earthRadius;
        if($distance > 20)
        {
            foreach($log as $logData){
                $data['transactionlog']['action']                = $logData['action'];
                $data['transactionlog']['callerID']              = $logData['callerID'];
                $data['transactionlog']['carrier']               = $logData['carrier'];
                $data['transactionlog']['dateTime']              = $logData['dateTime'];
                $data['transactionlog']['deviceID']              = $logData['deviceID'];
                $data['transactionlog']['ipAddress']             = $logData['ipAddress'];
                $data['transactionlog']['latitude']              = $logData['latitude'];
                $data['transactionlog']['longitude']             = $logData['longitude'];
                $data['transactionlog']['locationAccessCode']    = $logData['locationAccessCode'];
                $data['transactionlog']['mobileCountryCode']     = $logData['mobileCountryCode'];
                $data['transactionlog']['mobileNetworkCode']     = $logData['mobileNetworkCode'];
                $data['transactionlog']['signalStrength']        = $logData['signalStrength'];
                $data['transactionlog']['userID']                = $logData['userID'];
            }
           
            $this->restservermodel->mergeData($data['transactionlog']);
            $updateData['variant'] = '1';
            $this->restservermodel->updateData($id, $updateData);
        }

    }
}
