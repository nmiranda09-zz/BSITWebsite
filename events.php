<?php 
	include "server/db_conn.php";
	if(!isset($_SESSION)) {
	    session_start();
	    $id = $_SESSION['id'];
	}
	
	$sql_getAnnouncement = "SELECT *, posts.id AS post_id FROM posts, users WHERE posts.post_type = 'Event' AND users.id = '$id' ORDER BY posts.id DESC";
  	$getAnnouncement_query = mysqli_query($db, $sql_getAnnouncement);

  	if (mysqli_num_rows($getAnnouncement_query) == 0) {
		array_push($errors, 'Sorry, no events posted by the admin.');
		include "server/errors.php";
	} else {
	  	while ($rows = mysqli_fetch_array($getAnnouncement_query)) {
	  		$post_id = $rows['post_id'];
	  		$post_name = $rows['fname'] .' '. $rows['lname'];
	  		$user_type = $rows['type'];
	  		$post_date = $rows['post_date'];
	  		$post_desc = $rows['post_desc'];

	  		echo "<div id=". $post_id ." class='event'>
	  		<div class='top-info'>
	  		<span class='name'>Posted by ". $post_name ." &#8226; <em>". $user_type ."</em></span>
	  		<span class='date'>". $post_date ."</span></div>
	  		<p class='desc'>". $post_desc. "</p>
	  		</div>";
	  	}
	}
?>