<?php	
	$servername = 'utbweb.its.ltu.se:3306';
	$username = 'lorkin-4';
	$password = 'lorkin-4';
	$dbname = 'lorkin4db';

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn -> connect_error){
		die("Connection failed: " . $conn->connect_error);
	}
	if(isset($_POST['addMore'])){
		$sql = "SELECT quantity FROM Products WHERE id = " . $_POST['prodId'] . "";
		$newQuantity = ($conn->query($sql)->fetch_assoc()['quantity']) + $_POST['addMore'];
		
		$sql = "UPDATE Products SET quantity = '$newQuantity' WHERE id = " . $_POST['prodId'] . "";
		$conn->query($sql);
		echo $conn->error;
		header("Location: specificProduct.php");
	}else{
		$category = $_POST["category"];
		$productName = $_POST["productName"];
		$productPrice = $_POST["productPrice"];
		$productQuantity = $_POST["productQuantity"];
		
		switch ($category) {
		    case "Paper":
			$picture = 'img/papers.png';
			break;
		    case "Pens":
			$picture = 'img/pens.jpg';
			break;
		    case "Erasers":
			$picture = 'img/erasers.jpg';
			break;
		    case "Staplers":
			$picture = 'img/staplers.jpg';
			break;
		    default:
			echo "Error adding picture, have you typed in a correct category?";
		}
		
		$sql = "INSERT INTO Products (category,name, price, image, quantity) VALUES ('$category', '$productName','$productPrice', '$picture', $productQuantity)";
		
		if(($conn->query($sql)) == TRUE){
			echo 'Product successfully added!';
		}else{
			echo "'Unable to add Product. Errorcode: ' + ".$conn->error;
		}
		
		$conn -> close();
		header("Location: products.php");
	}
	
?>
