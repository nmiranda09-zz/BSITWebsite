<!DOCTYPE html>
<html>
<head>
	<title>BSIT WEBSITE | LOGIN</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/global.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="page-login">
	<?php include_once "loader.php"; ?>
	<header>
		<a class="logo" href="index.php">BSIT WEBSITE</a>
	</header>
	<div class="main">
		<div class="login-form">
			<form class="form" action="" method="post">
	            <h1>Login to your account</h1>
	            <legend>Required Fields *</legend>
	            <?php 
	            	include "server/functions.php";
	            	login();
	            ?>
	            <input type="text" name="idnumber" placeholder="ID Number *" required autofocus>
	            <input type="password" name="password" placeholder="Password *" required>
	            <input class="login-btn" type="submit" value="submit" name="login">
	        </form>

	        <div class="info-container">
	        	<h3>No Account?</h3>
	        	<p>Register <a href="redirect.php?id=register">here</a>.</p>
	        </div>
		</div>
	</div>
	<footer>
		<p>Copyright &copy; 2019 | <a href="">BSIT WEBSITE</a></p>
	</footer>
</body>
</html>