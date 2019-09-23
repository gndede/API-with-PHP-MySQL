<?php
class Rest_api{
    private $domainhost  = 'localhost';
    private $username  = 'root';
    private $password   = "";
    private $database  = "northwind";      
    private $employeeTable = 'employee';	
	private $dbConnect = false;
    public function __construct(){
		
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->domainhost, $this->username, $this->password, $this->database);
            
			if($conn->connect_error){
                die("Error - we failed to connect to the MySQL DB: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
	private function getData($EmployeeSqlQuery) {
		$result = mysqli_query($this->dbConnect, $EmployeeSqlQuery);
		if(!$result){
			die('There is an Error in your query:: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	
	//Method to execute a SQL statement and return the total number of rows in a table
	private function getNumberOfRows($EmployeeSqlQuery) {
		$result = mysqli_query($this->dbConnect, $EmployeeSqlQuery);
		if(!$result){
			die('There is an Error in your query: '. mysqli_error());
		}
		$numberOfRows = mysqli_num_rows($result);
		return $numberOfRows;
	}
	
	//method to get and display an employee from the table
	public function getEmployee($employeeId) {		
		$EmployeeSqlQuery = '';
		if($employeeId) {
			$EmployeeSqlQuery = "WHERE id = '".$employeeId."'";
		}	
		$EmployeeSqlQuery = "
			SELECT id,CompanyName,last_name,first_name,first_name,email_address,job_title,business_phone,home_phone,mobile_phone,fax_number,address,city, state_province,zip_postal_code,country_region, web_page  
			FROM ".$this->employeeTable." $EmployeeSqlQuery
			ORDER BY id DESC";	
		$resultData = mysqli_query($this->dbConnect, $EmployeeSqlQuery);
		
		$employeeData = array();
		
		while( $employeeRecord = mysqli_fetch_assoc($resultData) ) {
			
			$employeeData[] = $employeeRecord;
		}
		header('Content-Type: application/json');
		echo json_encode($employeeData);	
	}
	
	//method to create a new employee in the table
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

		$EmployeeSqlQuery="
		INSERT INTO ".$this->employeeTable." 
		SET CompanyName='".$CompanyName."', last_name='".$last_name."', first_name='".$first_name."', email_address='".$email_address."', job_title='".$job_title."', business_phone='".$business_phone."', 
		home_phone='".$home_phone."', mobile_phone='".$mobile_phone."', fax_number='".$fax_number."', address='".$address."', city='".$city."', state_province='".$state_province."',
		zip_postal_code='".$zip_postal_code."',country_region='".$country_region."',web_page='".$web_page."',		
		notes='".$notes."'";

		if( mysqli_query($this->dbConnect, $EmployeeSqlQuery)) {
			$messgae = "Employee created Successfully.";
			$status = 1;			
		} else {
			$messgae = "Employee creation failed.";
			$status = 0;			
		}
		$employeeResponse = array(
			'status' => $status,
			'status_message' => $messgae
		);
		header('Content-Type: application/json');
		echo json_encode($employeeResponse);
	}
	
	//method to operate employee update
	function updateEmployee($employeeData){ 		
		if($employeeData["id"]) {
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

			$EmployeeSqlQuery="
				UPDATE ".$this->employeeTable." 
				SET CompanyName='".$CompanyName."', last_name='".$last_name."', first_name='".$first_name."', email_address='".$email_address."', job_title='".$job_title."', business_phone='".$business_phone."', 
				home_phone='".$home_phone."', mobile_phone='".$mobile_phone."', fax_number='".$fax_number."', address='".$address."', city='".$city."', state_province='".$state_province."',
				zip_postal_code='".$zip_postal_code."',country_region='".$country_region."',web_page='".$web_page."',		
				notes='".$notes."'
				WHERE id = '".$employeeData["id"]."'";
				echo $EmployeeSqlQuery;
			if( mysqli_query($this->dbConnect, $EmployeeSqlQuery)) {
				$messgae = "Employee record updated successfully.";
				$status = 1;			
			} else {
				$messgae = "Employee update failed.";
				$status = 0;			
			}
		} else {
			$messgae = "Invalid request.";
			$status = 0;
		}
		$employeeResponse = array(
			'status' => $status,
			'status_message' => $messgae
		);
		header('Content-Type: application/json');
		echo json_encode($employeeResponse);
	}
	
	//method to operate employee deletion
	public function deleteEmployee($employeeId) {		
		if($employeeId) {			
			$EmployeeSqlQuery = "
				DELETE FROM ".$this->employeeTable." 
				WHERE id = '".$employeeId."'	ORDER BY id DESC";	
			if( mysqli_query($this->dbConnect, $EmployeeSqlQuery)) {
				$messgae = "Employee record delete Successfully.";
				$status = 1;			
			} else {
				$messgae = "Employee record deletion failed.";
				$status = 0;			
			}		
		} else {
			$messgae = "This is an Invalid request.";
			$status = 0;
		}
		$employeeResponse = array(
			'status' => $status,
			'status_message' => $messgae
		);
		header('Content-Type: application/json');
		echo json_encode($employeeResponse);	
	}
}
?>