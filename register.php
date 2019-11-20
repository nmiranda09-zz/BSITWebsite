<!DOCTYPE html>
<html>
<head>
	<title>BSIT WEBSITE | LOGIN</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/global.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="page-register">
	<?php include_once "loader.php"; ?>
	<header>
		<a class="logo" href="index.php">BSIT WEBSITE</a>
	</header>
	<div class="main">
		<div class="register-form">
			<form class="form" method="post" action="register.php">
	            <h1>Create an account</h1>
	            <legend>Required Fields *</legend>
	            <?php
	            	include "server/functions.php";
					register();
	            ?>
	            <input class="idnumber" type="text" name="idnumber" placeholder="ID Number *" required>
	            <input type="text" name="firstname" placeholder="First Name *" required>
	            <input type="text" name="lastname" placeholder="Last Name *" required>
	            <label>Are you a: </label>
	            <select class="select-type" name="type" required>
	            	<option value="student" selected="selected">Student</option>
	            	<option value="faculty">Faculty</option>
	            </select>
	            <input type="password" name="password" placeholder="Password *" required>
	            <input type="password" name="confirm_pass" placeholder="Confirm Password *" required>
	            
	            <input class="register-btn" type="submit" value="register" name="register" />
	        </form>

	        <div class="info-container">
	        	<h3>Already have an account?</h3>
	        	<p>Please login <a href="redirect.php?id=login">here</a>.</p>
	        </div>
		</div>
	</div>
	<footer>
		<p>Copyright &copy; 2019 | <a href="./">BSIT WEBSITE</a></p>
	</footer>
</body>
</html>