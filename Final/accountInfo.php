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
<p>Change information</p>
<?php require('changeInfo.php');?>
<p>Order history</p>
<?php
$servername = 'utbweb.its.ltu.se:3306';
	$username = 'lorkin-4';
	$password = 'lorkin-4';
	$dbname = 'lorkin4db';

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn -> connect_error){
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT * FROM Orders WHERE User_id = '" . $_SESSION['id'] . "'";
	$result = $conn->query($sql);
	$orderIds = array();
	
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()){
		array_push($orderIds, $row['id']);
		}
	}
	
	if(sizeof($orderIds) > 0){
		for ($i = 0; $i<sizeof($orderIds); $i++){
			$sql = "SELECT * FROM ProdInOrder WHERE Orders_id  = ". $orderIds[$i]."";
		      
			$result = $conn->query($sql);
		     
			if ($result->num_rows > 0) {
				$totalPrice = 0;
				echo "<p>Order ID: '$orderIds[$i]'</p><table border='1'>
					<tr>
					<th>Products</th>
					<th>Quantity</th>
					<th>Price</th> 
					</tr>";
				while($row = $result->fetch_assoc()) {
					$sql = "SELECT * FROM Products WHERE id = '". $row['Products_id'] . "'"; 
					$result2 = $conn->query($sql);
					echo "<tr><td>" . ($result2->fetch_assoc())['name'] . "</td><td>" . $row["quantity"] ."</td><td>".$row['price']."</td></tr>";
				$totalPrice = $totalPrice + $row['price'];
				}
				echo "<td>Total price: " . $totalPrice . "</td>";
			}
			echo "</table>";
		}
	}else{
		echo "No orders found";
	}
 
?>
</body>
</html>