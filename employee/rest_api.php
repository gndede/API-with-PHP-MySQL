<?php
//method insertEmployee() from class Rest_api.php, 
//will insert record into employee table and return JSON response.
function insertEmployee($employeeData){
	$CompanyName=$employeeData["CompanyName"];	
	$last_name=$employeeData["last_name"];
	$first_name=$employeeData["first_name"];
	$email_address=$employeeData["email_address"];
	$job_title=$employeeData["job_title"];		
	$business_phone=$employeeData["business_phone"];
	$home_phone=$employeeData["home_phone"];
	$mobile_phone=$employeeData["mobile_phone"];
	$fax_number=$employeeData["fax_number"];
	$address=$employeeData["address"];
	$city=$employeeData["city"];
	$state_province=$employeeData["state_province"];
	$zip_postal_code=$employeeData["zip_postal_code"];
	$country_region=$employeeData["country_region"];
	$web_page=$employeeData["web_page"];
	$notes=$employeeData["notes"];
	
	$empQuery="
		INSERT INTO ".$this->employeeTable." 
		SET CompanyName='".$CompanyName."', last_name='".$last_name."', first_name='".$first_name."', email_address='".$email_address."', job_title='".$job_title."', business_phone='".$business_phone."', 
		home_phone='".$home_phone."', mobile_phone='".$mobile_phone."', fax_number='".$fax_number."', address='".$address."', city='".$city."', state_province='".$state_province."',
		zip_postal_code='".$zip_postal_code."',country_region='".$country_region."',web_page='".$web_page."',		
		notes='".$notes."'";
	
	if( mysqli_query($this->dbConnect, $employeeQuery)) {
		$messgae = "Employee record created Successfully.";
		$status = 1;			
	} else {
		$messgae = "Employee record creation failed.";
		$status = 0;			
	}
	$empResponse = array(
		'status' => $status,
		'status_message' => $messgae
	);
	header('Content-Type: application/json');
	echo json_encode($empResponse);
}
?>