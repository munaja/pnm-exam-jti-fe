<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Output extends CI_Controller {
	
	function index() {
		$vars['view'] = 'output/index';
		$this->load->view('layout/main', $vars);
	}

}
