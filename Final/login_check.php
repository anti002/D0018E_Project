<?php	
	$servername = 'utbweb.its.ltu.se:3306';
	$username = 'lorkin-4';
	$password = 'lorkin-4';
	$dbname = 'lorkin4db';

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn -> connect_error){
		die("Connection failed: " . $conn->connect_error);
	}
	
	$email= $_POST["email"];
	$password = hash('sha256', $_POST["password"]);
	
	$sql = "SELECT id, email, password, adminBool FROM User WHERE email = '$email'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
	   
	    $dbPassword = $row["password"];
	    if($password == $dbPassword){
	      
	      echo "Password correct";
	      session_start();
	      $_SESSION["logged_in"] = TRUE;
	      $_SESSION["id"] = $row["id"];
	      
	      if($row["adminBool"]){
		$_SESSION["admin_logged_in"] = TRUE;
	      }else{
		$_SESSION["admin_logged_in"] = FALSE;
	      }
	      
	      header('Location: index.php');
	      
	    }else{	
	      echo "Incorrect username or password";
	    }
	  }
	  }
	  else {
	    echo "Incorrect username or password";
	  }

	$conn -> close();
?>

