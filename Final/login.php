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
<div id='signup-container'>
	<form action='login_check.php' method='post'>
		<table>
			<tr>
				<th>Email</th>
				<th><input type='text' name='email' required></th>
			</tr>
			<tr>
				<th>Lösenord</th>
				<th><input type='password' name='password' required></th>
			</tr>		
			<tr>
				<th><input type='submit' name='login' value='Login'></th>
			</tr>
		</table>
	</form>
</div>
</body>
</html>