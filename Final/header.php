<?php
	session_start();
?>
<html>
<head>
	<title>Group 24, D0018E e-commerce website</title>
	<link rel='stylesheet' type='text/css' href='index.css'>	
</head>
	
<body>
<header class ="mainheader">
	<nav>
		<ul>
			<li><a href="products.php">Products</a></li>
			<li><a href="contact.php">Contact</a></li>
			<?php
			if(isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"] == TRUE){
			    echo "<li><a href='accountInfo.php'>Admin: Account settings</a></li>";
			    }
			elseif(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == TRUE){
			    echo "<li><a href='accountInfo.php'>Account settings</a></li>";
			    }
			else{
			    echo "<li><a href='login.php'>Login</a></li>";
			    }
			    
			if(isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"] == TRUE){
			    echo "<li><a href='#'>Register</a></li>";
			    }
			elseif(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == TRUE){
			    echo "<li><a href='#'>Register</a></li>";
			    }
			else{
			    echo "<li><a href='register.php'>Register</a></li>";
			    }
			?>
			<li><a href="cart.php">Cart</a></li>
			<?php
			echo "<li><a href='logout.php'>Logout</a></li>";
			?>
		</ul>
	</nav>
</header>
