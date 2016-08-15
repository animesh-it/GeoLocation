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

        // Insert in the transaction table
        $data['transactionlog']['DateOfLog'] = $logdate;
        $data['transactionlog']['LogData'] = $logdata;
        $this->restservermodel->addLogInformation($data['transactionlog']);
        $data['transactionresponse']['CODE']=0;
        $data['transactionresponse']['MSG']='Successfully added the log info';
        $this->response($data['transactionresponse']);
    }
}