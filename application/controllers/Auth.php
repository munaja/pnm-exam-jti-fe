<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	function index() {
		$vars['view'] = 'auth/index';
		$this->load->view('layout/main', $vars);
	}

	function gOAuth() {
		// Takes raw data from the request
		$json = file_get_contents('php://input');
		// view
		if($json == "") {
			$vars['view'] = 'auth/using-google';
			$this->load->view('layout/main', $vars);
		}
		// submit
		else {
			$signed = json_decode($json);
			$ch = curl_init();

			// login ke api,
			curl_setopt($ch, CURLOPT_URL, BE_API_HOST."/auth/login-via-google");
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["accessToken" => $signed->access_token]));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
			$res = curl_exec($ch);
			$resInfo = curl_getinfo($ch);
			curl_close($ch);

			if($resInfo['http_code'] == 200) {
				$data = json_decode($res);
				if($data) {
					// session
					$_SESSION['auth'] = (object) [
						'accessToken' => $data->accessToken,
						'email' => $data->email,
						'id' => $data->id,
					];
					// output
					header('Status: 200');
					header('Content-Type: application/json');
					echo $res;
				} else {
					header('Status: 401');
					echo '{"message":"login failed, bad result"}';
				}
			} else {
				header('Status: 401');
				echo '{"message":"login failed, server not responding"}';
			}
		}
	}

}
