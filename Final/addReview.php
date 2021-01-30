<?php	
	$servername = 'utbweb.its.ltu.se:3306';
	$username = 'lorkin-4';
	$password = 'lorkin-4';
	$dbname = 'lorkin4db';

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn -> connect_error){
		die("Connection failed: " . $conn->connect_error);
	}
	session_start();
	
	
	$review = $_POST["userReview"];
	$product = $_POST['prodId'];
	
	$sql = "SELECT * FROM Review WHERE User_id = ". $_SESSION['id']. " && Products_id = '$product'";
	
	$result = $conn->query($sql);
	
	if($result->num_rows > 0){
		$sql = "UPDATE Review SET comment = '$review' WHERE  User_id = ". $_SESSION['id']. " && Products_id = '$product'"; 
	} else {
		$sql = "INSERT INTO Review (comment, User_id, Products_id) VALUES ('$review', " .$_SESSION['id'] .", $product)";
	}
	
	if(($conn->query($sql)) == TRUE){
		echo '"Review added"';
		
	}else{
		echo "'Unable to add review. Errorcode: ' + ".$conn->error;
	}
	
	
	
	$conn -> close();
	
	header("Location: specificProduct.php");
?>

