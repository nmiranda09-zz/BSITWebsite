<?php
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
  			} else if ($type == 'student') {
  				header('location: student.php?id='. $id .'');
  			} else if ($type == 'faculty') {
  				header('location: faculty.php?id='. $id .'');
  			}
		} else {
			include_once "login.php";
		}
	}
?>