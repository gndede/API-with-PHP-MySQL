<?php 
header("Access-Control-Allow-Origin: *");
include('include/header_api.php');
?>
<title>REST API in PHP with MySQL</title>
<?php include('include/container_api.php');?>
<div class="container">
	<h2>A REST API in PHP with MySQL Database</h2>	
	<br>
	<br>
	<form action="" method="get">
		<div class="form-group">
			<label for="name">http://localhost:8080/api/emp/read/(employeeid)</label>
			<input type="text" name="url" value="http://localhost:8080/api/employee/read/" class="form-control" required/>
			
		</div>
		<button type="submit" name="submit" class="btn btn-default">Request API </button>
	</form>
	<p>&nbsp;</p>
	<?php
	if(isset($_POST['submit']))	{
		$url = $_POST['url'];				
		$client = curl_init($url);
		curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
		$response = curl_exec($client);		
		$result = json_decode($response);	
		print_r($result);		
	}
	?>	
</div>
<?php include('inc/footer_api.php');?>
