<?php require('header.php');
	$servername = 'utbweb.its.ltu.se:3306';
	$username = 'lorkin-4';
	$password = 'lorkin-4';
	$dbname = 'lorkin4db';

	$conn = new mysqli($servername, $username, $password, $dbname);
  
	if ($conn -> connect_error){
		die("Connection failed: " . $conn->connect_error);
	}
	$sql = "DELETE From Review WHERE User_id = " . $_POST['id'] . " && Products_id = '" .$_POST['prodIdRev'] . "'";  
	
	$conn->query($sql);
	header("Location: specificProduct.php");