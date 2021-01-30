<!DOCTYPE html>
<?php
  $servername = 'utbweb.its.ltu.se:3306';
  $username = 'lorkin-4';
  $password = 'lorkin-4';
  $dbname = 'lorkin4db';

  $conn = new mysqli($servername, $username, $password, $dbname);
?>

<html>
<head>
<title>
Office supplies
</title>
<link href="products.css" rel="stylesheet" type="text/css" />	
<a href="index.php"><h1>Office supplies</h1></a>
</head>
<body class="Body">
<?php require('header.php');?>
<p>
These are our products:
</p>

<div class="dropdown">
	<button class="dropbtn">Paper</button>
	<div class="dropdown-content">
		<?php
			if ($conn -> connect_error){
				die("Connection failed: " . $conn->connect_error);
			}

			$sql = "SELECT * FROM Products WHERE category='Paper'";
			
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
			      // output data of each row
				while($row = $result->fetch_assoc()) {
					echo "<form method='post' action='specificProduct.php'><input type='submit' value='". $row['name'] ."' name='prodName'></form>";
					$_SESSION['prod_id'] = $row['id'];
				}
			}
		  ?>
	</div>
</div>

<div class="dropdown">
	<button class="dropbtn">Pens</button>
	<div class="dropdown-content">
		<?php
			if ($conn -> connect_error){
				die("Connection failed: " . $conn->connect_error);
			}

			$sql = "SELECT * FROM Products WHERE category='Pens'";
			
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
			      // output data of each row
				while($row = $result->fetch_assoc()) {
					echo "<form method='post' action='specificProduct.php'><input type='submit' value='". $row['name'] ."' name='prodName'></form>";
					$_SESSION['prod_id'] = $row['id'];
				}
			}
		?>
	</div>
</div>
 
 <div class="dropdown">
<button class="dropbtn">Erasers</button>
	<div class="dropdown-content">
	      <?php
			if ($conn -> connect_error){
				die("Connection failed: " . $conn->connect_error);
			}

			$sql = "SELECT * FROM Products WHERE category='Erasers'";
			
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
			      // output data of each row
				while($row = $result->fetch_assoc()) {
					echo "<form method='post' action='specificProduct.php'><input type='submit' value='". $row['name'] ."' name='prodName'></form>";
					$_SESSION['prod_id'] = $row['id'];
				}
			}
		?>
	</div>
</div>
 
 <div class="dropdown">
<button class="dropbtn">Staplers</button>
	<div class="dropdown-content">
		<?php
			if ($conn -> connect_error){
				die("Connection failed: " . $conn->connect_error);
			}

			$sql = "SELECT * FROM Products WHERE category='Staplers'";
			
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
			      // output data of each row
				while($row = $result->fetch_assoc()) {
					echo "<form method='post' action='specificProduct.php'><input type='submit' value='". $row['name'] ."' name='prodName'></form>";
					$_SESSION['prod_id'] = $row['id'];
				}
			}
		  ?>
	</div>
</div>

<?php
	if (isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"]){
		echo "<div name='Add'>
		<h3>Add product</h3>
		<form method='post' action='addProduct.php'>
		<p>Category</p>
		<input type='text' name='category' required>
		<p>Product name</p>
		<input type='text' name='productName' required>
		<p>Price</p>
		<input type='number' min='1' name='productPrice' required>
		<p>Quantity</p>
		<input type='number' min='1' name='productQuantity' required>
		<p>Add product</p>
		  <input type='submit' value='Add product'>
		</form>
		</div>";
	}

?>
</body>
</html>