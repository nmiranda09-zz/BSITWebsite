<?php 
	if (empty($_SESSION)) {
		session_start();
	} else {
		session_destroy();
	}

	if (session_destroy()) {
		unset($_SESSION['loggedin']);
		unset($_SESSION['id']);
		unset($_SESSION['type']);
		header("Location: index.php");
	}
?>