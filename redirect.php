<?php
	$getRedirect = $_GET['id'];

	if (!isset($_SESSION)) {
		session_start();

		if (isset($_SESSION['type'])) {
		  if ($_SESSION['type'] != NULL){
		      $type = $_SESSION['type'];                   
		  }
		}

		if (isset($_SESSION['id'])) {
		  if ($_SESSION['id'] != NULL){
		      $id = $_SESSION['id'];                   
		  }
		}

		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'true') {
			if($type == 'Admin') {
  				header('location: main.php?id='. $id .'');	
  			} else if ($type == 'Student') {
  				header('location: student.php?id='. $id .'');
  			} else if ($type == 'Faculty') {
  				header('location: faculty.php?id='. $id .'');
  			}
		} else {
			if($getRedirect == 'login') {
				include_once "login.php";
			} else {
				include_once "register.php";
			}
			
		}
	}
?>