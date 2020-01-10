<?php
session_start();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Shadows of Shaiya - Admin Login</title>
	<link rel=styleSheet href="./assets/css/style.login.css" type="text/css">
</head>
<body>
	<div id="wrapper">
		<div id="login-box">
		<h2>Admin cPanel Login</h2>
		<h2>Cyber Edition</h2>
			<form action="post_login.php" method="post" class="form-main">
				<div id="login-box-field">
					<input type="text" class="form-login" placeholder="User ID" name="UserID" />
				</div>
				<div id="login-box-field">
					<input type="password" class="form-login" placeholder="Password" name="Pw" />
				</div>
			<br>
				<input type="submit" class="submit_login" alt="Submit Form" value="Login">
			</form>
			<form action="../" method="post">
				<input type="submit" class="submit_return_home" value="Return Home">
			</form>
		</div>
	</div>
</body>
</html>