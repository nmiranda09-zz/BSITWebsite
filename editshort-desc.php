<?php
	include "server/db_conn.php";

	if(!isset($_SESSION)) {
	    session_start();
	    $id = $_SESSION['id'];
	}

	$sql_getInfo = mysqli_query($db , "SELECT * FROM users, profile WHERE users.id = '$id' AND profile.user_id = '$id'");
	$getInfo_query = mysqli_fetch_array($sql_getInfo);

	$short_desc = $getInfo_query['short_desc'];

  	?>
  	<div class="edit-show">
  		<div class="top"><h1>Edit Profile</h1><button onclick="closeModal();">Close</button></div>

		<form action="" method="POST" enctype="multipart/form-data">
			<textarea placeholder="Short descrition about yourself" name="short-desc" required><?php echo $short_desc; ?></textarea>
			<button type="submit" class="save-btn" name="save">Save</button>
		</form>
  	</div>

  	<?php 
?>
