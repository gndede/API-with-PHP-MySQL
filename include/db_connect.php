<?php
// connect to the Database

$domainhost = "localhost";
$username = "root";
$password = "";
$dbname = "northwind";

$connection = mysqli_connect($domainhost, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

if (mysqli_connect_errno()) {
    
	printf("Connection failed: %s\n", mysqli_connect_error());
    
	exit();
}
?>