<?php

include APPPATH.'libraries/REST_Controller.php';

class Phonenumber extends REST_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->helper('api');
	}

	function index_post() {
		$res = apiCall('POST', '/phone-number');
		$this->response(json_decode($res->body), $res->http_code);
	}

	function create_bulk_post() {
		$res = apiCall('POST', '/phone-number/create_bulk');
		$this->response(json_decode($res->body), $res->http_code);
	}

	function index_patch($id) {
		$res = apiCall('PATCH', '/phone-number/'.$id);
		$this->response(json_decode($res->body), $res->http_code);
	}

	function index_delete($id) {
		$res = apiCall('DELETE', '/phone-number/'.$id);
		$this->response(json_decode($res->body), $res->http_code);
	}

	function index_get() {
		$res = apiCall('GET', '/phone-number', $_SERVER['QUERY_STRING']);
		$this->response(json_decode($res->body), $res->http_code);
	}

	function detail_get($id) {
		$res = apiCall('GET', '/phone-number/'.$id);
		$this->response(json_decode($res->body), $res->http_code);
	}

	function genRandom_get() {
		$res = apiCall('GET', '/phone-number/gen-random');
		$this->response(json_decode($res->body), $res->http_code);
	}
}
