<?php 
	include "server/db_conn.php";
	if(!isset($_SESSION)) {
	    session_start();
	    $id = $_SESSION['id'];
	}

	$sql_getAnnouncement = "SELECT * FROM users, profile WHERE users.type = 'faculty' AND profile.user_id = users.id ORDER BY users.lname";
  	$getAnnouncement_query = mysqli_query($db, $sql_getAnnouncement);

  	if (mysqli_num_rows($getAnnouncement_query) == 0) {
  		?>
  		<div class="loaded">
  			<?php 
  			array_push($errors, 'Sorry, no faculties available.');
			include "server/errors.php";
  			?>
  		</div>
  		<?php
		
	} else {
	  	while ($rows = mysqli_fetch_array($getAnnouncement_query)) {
	  		$id = $rows['user_id'];
	  		$target = "img/";
	  		$avatar = $rows['profile_pic'];
	  		$fname = $rows['fname'];
	  		$lname = $rows['lname'];
	  		$year_level = $rows['year_level'];
	  		$course = $rows['course'];
	  		$idnumber = $rows['idnumber'];
	  	
	  		?>
		  	
	  		<div class="loaded">
	  			<div class="avatar">
	  				<?php if(empty($avatar)): ?>
	  					<img src="img/avatar.png" alt="avatar" style="max-width: 100px;"/>
	  				<?php else: ?>
	  					<img src="<?php echo $target.$avatar; ?>" style="max-width: 100px;">
	  				<?php endif; ?>
	  			</div>
	  			<div class="info">
	  				<span class="name"><?php echo $lname .', '. $fname ?></span><br/>
	  				<span>ID Number: <?php echo $idnumber; ?></span><br/>
	  				<span><?php echo $course; ?></span><br/>
	  				<a href="./info.php?id=<?php echo $id; ?>" title="View Profile">View Profile</a>
	  			</div>
	  			
	  		</div>
		  	
	  		<?php
		}
			?>
	 	<?php
	}
?>