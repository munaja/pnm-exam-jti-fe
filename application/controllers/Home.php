<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function index() {
		if(isset($_SESSION['auth'])) {
			header('Location: /input');
			return;
		}
		$vars['view'] = 'home/index';
		$this->load->view('layout/main', $vars);
	}

}
