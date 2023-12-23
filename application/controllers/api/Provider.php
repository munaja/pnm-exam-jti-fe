<?php

include APPPATH.'libraries/REST_Controller.php';

class Provider extends REST_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->helper('api');
	}

	function index_get() {
		$res = apiCall('GET', '/provider');
		$this->response(json_decode($res->body), $res->http_code);
	}

}
