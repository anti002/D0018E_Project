<?php
	session_start();
	$servername = 'utbweb.its.ltu.se:3306';
	$username = 'lorkin-4';
	$password = 'lorkin-4';
	$dbname = 'lorkin4db';

	$conn = new mysqli($servername, $username, $password, $dbname);
    
	$sql = "SELECT * FROM ShoppingCarts WHERE User_id = '" . $_SESSION['id'] . "'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

			$sql = "INSERT INTO Orders (User_id) VALUES (" . $_SESSION['id'] . ")";
			$conn->query($sql);
			$ordersId = $conn->insert_id;
			
			$sql = "SELECT * FROM ShoppingCarts WHERE User_id = '" . $_SESSION['id'] . "'";
			$checkResult = $conn->query($sql);
			
			$orderable = TRUE;
			while($row = $checkResult->fetch_assoc()){
				$sql = "SELECT * FROM Products WHERE id = " . $row['Products_id'] . "";
				$result2 = $conn->query($sql)->fetch_assoc()['quantity'];
				$checkQuantity = $result2 - $row['quantity'];
				
				if($checkQuantity < 0){
					$orderable = FALSE;
					break;
				}
			}
			
			if ($orderable){
				while($row = $result->fetch_assoc()) {
				            
					$sql = "INSERT INTO ProdInOrder (Orders_id, Products_id, quantity, price) VALUES ('$ordersId', " . $row['Products_id'] . ", ".$row['quantity'].", ".$row['price'].")";
					$conn->query($sql);
					echo $conn->error;
					$sql = "DELETE From ShoppingCarts WHERE User_id = " . $_SESSION['id'] . " && Products_id = '" . $row['Products_id'] . "'";
					$conn->query($sql);
					echo $conn->error;
					$sql = "UPDATE Products SET quantity = '$checkQuantity' WHERE id = " . $row['Products_id']. "";
					$conn->query($sql);    
				}
				echo "Products ordered to your adress, click <a href='accountInfo.php'>here</a> to check your order history";
			}else{
				echo "Products not in stock";
			}
	}else {
		echo "Add products to cart for placing an order";
	}
		$conn -> close();
		
	?>