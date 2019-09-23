<?php
//PHP file employee/read_api.php to create employee 
// records from MySQL database table
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('../class/rest_api.php');

$api = new Rest();
switch($requestMethod) {
	case 'GET':
		$employeeId = '';	
		if($_GET['id']) {
			$employeeId = $_GET['id'];
		}
		$api->getEmployee($employeeId);
		break;
	default:
	header("HTTP/1.0 405 Method Not Allowed");
	break;
}
?>