<?php require('header.php');
	$servername = 'utbweb.its.ltu.se:3306';
	$username = 'lorkin-4';
	$password = 'lorkin-4';
	$dbname = 'lorkin4db';

	$conn = new mysqli($servername, $username, $password, $dbname);
  
	if ($conn -> connect_error){
		die("Connection failed: " . $conn->connect_error);
	}
	$sql = "DELETE From ShoppingCarts WHERE User_id = " . $_SESSION['id'] . " && Products_id = '" .$_POST['prodId'] . "'";  
	
	$conn->query($sql);
	header("Location: cart.php");