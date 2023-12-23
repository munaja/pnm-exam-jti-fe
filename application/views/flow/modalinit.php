<?php defined('BASEPATH') OR exit('No direct script access allowed');

// Login data
$logedin = false;
// if(isset($_SESSION['auth'])) {
// 	$logedin = true;
// 	$auth = $_SESSION['auth'];
// 	$user_id = $auth['user_id'];
// 	$user_name = $auth['user_name'];
// }
if(isset($_SESSION['auth'])) {
	$logedin = true;
	$account = $_SESSION['auth'];
	require_once(FCPATH.'../application/models/Balanceofmemodel.php');
	$Balanceofmemodel = new Balanceofmemodel();
	$balance_total = $Balanceofmemodel->getValue();	
}
else {
	$account = null;
}


// Url
$baseurl = baseurl();
$baseurlpublic = $baseurl.'public/';
$baseurlimg = $baseurl; // Suatu saat diganti server cdn

// Current..
$area = areaIdentifier();
$controller = $this->router->fetch_class();
$action = $this->router->fetch_method();
