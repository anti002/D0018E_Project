<?php require('header.php');
	$servername = 'utbweb.its.ltu.se:3306';
	$username = 'lorkin-4';
	$password = 'lorkin-4';
	$dbname = 'lorkin4db';

	$conn = new mysqli($servername, $username, $password, $dbname);
  
	if ($conn -> connect_error){
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT * FROM Products WHERE id = '". $_POST['prodId'] . "'"; 
	$result = $conn->query($sql);
	$productRow = $result->fetch_assoc(); 
	$sql = "SELECT * FROM ShoppingCarts WHERE  User_id = " . $_SESSION['id'] ." && Products_id = " . $_POST['prodId']  . " ";
	
	if(($cartRow = $conn->query($sql)) == TRUE && $cartRow->num_rows > 0){
	
		$quantity = $_POST['quantity'] + ($cartRow->fetch_assoc())['quantity'];
		
		$sql = "UPDATE ShoppingCarts SET quantity = $quantity, price = " . ($quantity * $productRow['price']). " WHERE  User_id = " . $_SESSION['id'] ." && Products_id = " . $_POST['prodId']  . ""; 
		$conn->query($sql);
	}else{
		echo "hej";
		$sql = "INSERT INTO ShoppingCarts(User_id, Products_id, quantity, price) VALUES (" . $_SESSION['id'] . ",   " . $_POST['prodId'] . ", " . $_POST['quantity'] . " ,   " . ($_POST['quantity'] * $productRow['price']) . ")"; 
		$conn->query($sql);
	}
	
	header("Location: cart.php");