<!DOCTYPE html>
<html>
<head>
<title>
Office supplies
</title>
<link href="specificProduct.css" rel="stylesheet" type="text/css" />
<a href="index.html"><h1>Office supplies</h1></a>
</head>
<body class="Body">
<?php require('header.php');
	$servername = 'utbweb.its.ltu.se:3306';
	$username = 'lorkin-4';
	$password = 'lorkin-4';
	$dbname = 'lorkin4db';

	$conn = new mysqli($servername, $username, $password, $dbname);
  
	if ($conn -> connect_error){
		die("Connection failed: " . $conn->connect_error);
	}

	if(isset($_POST['prodName'])){
		$prodname = $_POST['prodName'];
		$_SESSION['prodName'] = $_POST['prodName'];
	} else {
		$prodname = $_SESSION['prodName'];
	}
	
	$sql = "SELECT * from Products WHERE name = '" . $prodname . "'";
	
	$result = $conn->query($sql);
	$product =  $result->fetch_assoc();
	
	$imgSrc = $product['image'];
	
	echo "<img src='$imgSrc' class='ProductImg'></img>";
      
?>
<div class="Product">
<?php
	if ($result->num_rows > 0) {
		echo "<p>Price: ". $product['price'] ." </p>
		<p>Stock: ". $product['quantity'] ."</p>";	
		
	}
	if(isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"]){
		 	echo "<form method='post' action='addToCart.php'>
		<input type='number' min='1' name='quantity' value='1'><br>
		<input type='submit' value='Add to cart'>
		<input type='text' name='prodId' value='" .$product['id']. "' style='display:none;'>
		</form>
		<form method='post' action='addProduct.php'>
		<input type='number' min='1' name='addMore' placeholder='Enter quantity'>
		<input type='submit' value='Add to stock'>
		<input type='text' name='prodId' value='" .$product['id']. "' style='display:none;'>
		</form>";
	}else{	
		echo "<form method='post' action='addToCart.php'>
		<input type='number' min='1' name='quantity' value='1'><br>
		<input type='submit' value='Add to cart'>
		<input type='text' name='prodId' value='" .$product['id']. "' style='display:none;'>
 	</form>";
 	}
?>

	
</div>
<div class="Reviews">
	<h3>Reviews</h3>
	<?php
		if(isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"]){
			$sql = "SELECT * from Review WHERE Products_id = ". $product['id'] . " ";
			$result2 = $conn->query($sql);
			if($result2->num_rows > 0){
				while($row = $result2->fetch_assoc()){
					$sql = "SELECT * FROM User WHERE id = " . $row['User_id'] . "";
					$result3 = $conn->query($sql);
					echo $conn->error;
					echo "<p>" . $result3->fetch_assoc()['fName'] . "</p><p>" . $row['comment'] . "</p> 
					<form action='removeReview.php' method='post'><input type='submit' name='remove' value='Remove'> 
					<input type='text' name='prodIdRev' value='" .$product['id']. "' style='display:none;'>
					<input type='text' name='id' value='" . $row['User_id']. "' style='display:none;'></form><hr>";
				}
			}	
		}else{
			$sql = "SELECT * from Review WHERE Products_id = ". $product['id'] . " ";
			$result2 = $conn->query($sql);
			if($result2->num_rows > 0){
				while($row = $result2->fetch_assoc()){
					$sql = "SELECT * FROM User WHERE id = " . $row['User_id'] . "";
					$result3 = $conn->query($sql);
					echo $conn->error;
					echo "<p>" . $result3->fetch_assoc()['fName'] . "</p><p>" . $row['comment'] . "</p><hr>";
				}
			}	
		}
	?>
	
</div>
<div class="UserReview">
<p>Please review this product</p>
<?php
echo "<form method='post' action='addReview.php'>
		<input type='text' name='userReview' size='235'><br>
		<input type='submit' value='Post/update review'>
		<input type='text' name='prodId' value='" . $product['id'] . "' style='display:none;'>
 	</form>";
?>
</div>
</body>
</html>