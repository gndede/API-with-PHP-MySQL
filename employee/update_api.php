<?php
//the method updateEmployee() from class rest_api.php, 
//updates records in employee table and return status 
//in JSON as a response.

$requestMethod = $_SERVER["REQUEST_METHOD"];
include('../class/rest_api.php');
$api = new Rest();
switch($requestMethod) {	
	case 'POST':
	print_r($_POST);
		$api->updateEmployee($_POST);
		break;
	default:
	header("HTTP/1.0 405 Method Not Allowed");
	break;
}
?>