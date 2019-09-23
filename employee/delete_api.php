<?php
//the method deleteEmployee() from class rest_api.php, 
//deletes record from employee table and return status in JSON as a response.

$requestMethod = $_SERVER["REQUEST_METHOD"];
include('../class/Rest.php');
$api = new Rest();
switch($requestMethod) {
	case 'GET':
		$employeeId = '';	
		if($_GET['id']) {
			$employeeId = $_GET['id'];
		}
		$api->deleteEmployee($employeeId);
		break;
	default:
	header("HTTP/1.0 405 Method Not Allowed");
	break;
}
?>