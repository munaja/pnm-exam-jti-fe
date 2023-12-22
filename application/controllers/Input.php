<?php

class Input extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		if(!isset($_SESSION['auth'])) {
			header('Location: /');
			exit();
		}
	}

	function index() {
		$vars['view'] = 'input/index';
		$this->load->view('layout/main', $vars);
	}

}
