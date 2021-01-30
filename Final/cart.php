<!DOCTYPE html>

<html>
<head>
<title>
Office supplies
</title>
<link href="index.css" rel="stylesheet" type="text/css" />
<a href="index.php"><h1>Office supplies</h1></a>
</head>
<body class="Body">
<?php require('header.php');?>
  
<table border="1">
	<tr>
	  <th>Products</th>
	  <th>Quantity</th>
	  <th>Price</th> 
	  <th>Remove product from cart</th>
	</tr>     
<?php
	if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == TRUE){
		$servername = 'utbweb.its.ltu.se:3306';
		$username = 'lorkin-4';
		$password = 'lorkin-4';
		$dbname = 'lorkin4db';

		$conn = new mysqli($servername, $username, $password, $dbname);
	    
		$sql = "SELECT * FROM ShoppingCarts WHERE User_id = '" . $_SESSION['id'] . "'";
		$result = $conn->query($sql);
		$totalPrice = 0;
		if ($result->num_rows > 0) {
		    // output data of each row
			while($row = $result->fetch_assoc()) {
				$sql = "SELECT * FROM Products WHERE id = '". $row['Products_id'] . "'"; 
				$result2 = $conn->query($sql);
				
				echo "<tr><td>" . ($result2->fetch_assoc())['name'] . "</td><td>" . $row["quantity"] ."</td><td>" . $row["price"] .  "</td> <td><form action='removeProduct.php' method='post'><input type='submit' name='remove' value='Remove'>
				      <input type='text' name='prodId' value='" . $row['Products_id'] . "' style='display:none;'></form></td></tr>";
				$totalPrice = $totalPrice + $row['price'];
			}
			echo "<td>Total price: " . $totalPrice . "</td>";
		} else {
			echo "Empty cart";
		}
		echo "<form action='orderProducts.php' method='post'><input type='submit' name='order' value='Order products'>";
	}
?>
</table>
</body>
</html>