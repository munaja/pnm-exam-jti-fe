<?php

function apiCall($method, $path, $query = '') {
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, BE_API_HOST.$path.($query ? '?'.$query : ''));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

	if(isset($_SESSION["auth"]) && isset($_SESSION["auth"]->accessToken)) {
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer '.$_SESSION["auth"]->accessToken]);
	}

	if($method == 'POST') {
		curl_setopt($ch, CURLOPT_POST, true);
	} elseif($method == 'PUT') {
		curl_setopt($ch, CURLOPT_PUT, true);
	} elseif($method == 'PATCH') {
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
	} elseif($method == 'DELETE') {
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
	}

	$json = file_get_contents('php://input');
	if($json) {
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	}

	$res = curl_exec($ch);
	$resInfo = curl_getinfo($ch);
	curl_close($ch);
	return (object)[
		'http_code' => $resInfo['http_code'],
		'body' => $res,
	];
}
