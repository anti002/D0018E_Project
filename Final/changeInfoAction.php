<?php
	session_start();
	$servername = 'utbweb.its.ltu.se:3306';
	$username = 'lorkin-4';
	$password = 'lorkin-4';
	$dbname = 'lorkin4db';

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn -> connect_error){
		die("Connection failed: " . $conn->connect_error);
	}

	echo '<script>console.log("Connected successfully to database")</script>';
	
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$email= $_POST["email"];
	$password = hash('sha256', $_POST["password"]);
	$address = $_POST["address"];
	$zipcode = $_POST["zipcode"];
	$city = $_POST["city"];
	
	$sql = "UPDATE User SET fName = '$firstname',lName = '$lastname', email = '$email', password ='$password', address = '$address', zipcode = '$zipcode', city ='$city' WHERE id = ".$_SESSION['id']."";

	if(($conn->query($sql)) == TRUE){
		echo 'Information changed';
		
		
	}else{
		echo "Invalid or taken information. Errorcode: ' + ".$conn->error . "";
	}
	
	$conn -> close();
?>

