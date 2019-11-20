<?php 
	function login() {
		if(!isset($_SESSION)) {
		    session_start();
		}

		include "server/db_conn.php";

		if (isset($_POST['login'])) {
			$idnumber = mysqli_real_escape_string($db, $_POST['idnumber']);
			$password = mysqli_real_escape_string($db, $_POST['password']);
			$sql_checkdata = "SELECT * FROM users WHERE idnumber = '$idnumber'";
		  	$checkdata_query = mysqli_query($db, $sql_checkdata);

		  	while($rows = mysqli_fetch_array($checkdata_query)) {
		  		 $id = $rows['id'];
		  		 $type = $rows['type'];
		  		 $status = $rows['status'];
		  	}

			if (count($errors) == 0) {
				$password = md5($password);
				$sql_login = "SELECT * FROM users WHERE idnumber = '$idnumber' AND password = '$password' AND status='enabled'";
		  		$login_query = mysqli_query($db, $sql_login);
		  		if (mysqli_num_rows($login_query) > 0) {
		  			$_SESSION['id'] = $id;
					$_SESSION['type'] = $type;
		  			$_SESSION['loggedin'] = 'true';
		  			header('location: index.php');
		  		} else {
			  		if($status == 'disabled') {
			  			array_push($errors, 'Your account has been disabled.<br> Please report to your admin for reactivation.');
			  			include "server/errors.php";	
			  		} else {
			  			array_push($errors, 'Invalid idnumber or password');
			  			include "server/errors.php";
			  		}
	        	}
			}
		}
	}

	function register() {
		if(!isset($_SESSION)) {
		    session_start();
		}
		include "server/db_conn.php";
		  
		if (isset($_POST['register'])) {
			$status = mysqli_real_escape_string($db, 'enabled');
			$idnumber = mysqli_real_escape_string($db, $_POST['idnumber']);
			$firstname = mysqli_real_escape_string($db, $_POST['firstname']);
			$lastname = mysqli_real_escape_string($db, $_POST['lastname']);
			$type = mysqli_real_escape_string($db, $_POST['type']);
			$password = mysqli_real_escape_string($db, $_POST['password']);
			$confirm_pass = mysqli_real_escape_string($db, $_POST['confirm_pass']);
		  	$sql_checkusername = "SELECT * FROM users WHERE idnumber='$idnumber'";
		  	$checkusername_query = mysqli_query($db, $sql_checkusername);
		  	if (mysqli_num_rows($checkusername_query) > 0) {
		  	  	array_push($errors, 'Sorry, idnumber already taken.');
				include "server/errors.php"; 	
		  	} else if ($password != $confirm_pass) {
		  	 	array_push($errors, 'Passwords do not match!');
				include "server/errors.php";	
		  	} else {
		        $password = md5($password);
				
				$sql_register = "INSERT INTO users (idnumber, fname, lname, type, password, status) VALUES ('$idnumber', '$firstname', '$lastname', '$type', '$password', '$status')";
				mysqli_query($db, $sql_register);
				
	  			$_SESSION['loggedin'] = 'true';
	  			$_SESSION['type'] = $type;

	  			$sqlGetID = mysqli_query($db , "SELECT id FROM users ORDER BY id desc");
				$dataGetID = mysqli_fetch_array($sqlGetID);
				$idGet = $dataGetID['id'];

				$sql_addProfile = "INSERT INTO profile (user_id) VALUES ('$idGet')";
				mysqli_query($db, $sql_addProfile);

				$_SESSION['id'] = $idGet;

				header('location: index.php');	
		  	}
		}
	}

	function submitPost() {
		include "server/db_conn.php";
		  
		if (isset($_POST['post-submit'])) {
			$id = $_GET['id'];

			$post_type = mysqli_real_escape_string($db, $_POST['post-type']);
			$post_desc = mysqli_real_escape_string($db, $_POST['post-desc']);
			$post_date = mysqli_real_escape_string($db, date('F j, Y'));

			$sql_submitPost = "INSERT INTO posts (post_desc, post_date, post_type, user_id) VALUES ('$post_desc', '$post_date', '$post_type', '$id')";
			mysqli_query($db, $sql_submitPost);

			if (count($errors) == 0) {
				array_push($errors, $post_type . ' posted successfully');
				include "success.php";
			}
		}
	}
			
	function addSubject() {
		include "server/db_conn.php";
		  
		if (isset($_POST['subj-submit'])) {
			$id = $_GET['id'];

			$subj_year = mysqli_real_escape_string($db, $_POST['subj-year']);
			$subj_code = mysqli_real_escape_string($db, $_POST['subj-code']);
			$subj_desc = mysqli_real_escape_string($db, $_POST['subj-desc']);

			$sql_submitSubj = "INSERT INTO subjects (subj_code, subj_desc, subj_year, user_id) VALUES ('$subj_code', '$subj_desc', '$subj_year', '$id')";
			mysqli_query($db, $sql_submitSubj);

			if (count($errors) == 0) {
				array_push($errors, $subj_code . ' added successfully');
				include "success.php";
			}
		}
	}

	function info() {
		include "server/db_conn.php";
		$id = $_GET['id'];
		$type = $_SESSION['type'];

		$sql_getInfo = mysqli_query($db , "SELECT * FROM users, profile WHERE users.id = '$id' AND profile.user_id = '$id'");
		$getInfo_query = mysqli_fetch_array($sql_getInfo);
	  	$target = "img/";
		$avatar = $getInfo_query['profile_pic'];
		$fname = $getInfo_query['fname'];
		$lname = $getInfo_query['lname'];
		$gender = $getInfo_query['gender'];
		$course = $getInfo_query['course'];
		$bday = $getInfo_query['bday'];
		$year_level = $getInfo_query['year_level'];
		$short_desc = $getInfo_query['short_desc'];
		$contact_num = $getInfo_query['contact_num'];
		$email = $getInfo_query['email'];
		$status = $getInfo_query['status'];

		?>
		<div class="profile">
			<div class="intro">
				<div class="avatar">
					<?php if(empty($avatar)): ?>
						<img src="img/avatar.png" alt="avatar" style="max-width: 150px;"/>
					<?php else: ?>
						<img src="<?php echo $target.$avatar; ?>" style="max-width: 150px;">
					<?php endif; ?>
				</div>
				<div class="info">
					<span class="name"><?php echo $lname .', '. $fname ?></span><br/>
					<span>
						<?php if(empty($course)): ?>
							<?php echo "Course not found"; ?>
						<?php else: ?>
							<?php echo $course; ?>
						<?php endif; ?>	
					</span><br/>
					<span>
						<?php if(empty($year_level)): ?>
							<?php echo "Year level not found"; ?>
						<?php else: ?>
							<?php echo $year_level; ?>
						<?php endif; ?>	
					</span><br/>
					<span>
						<?php if(empty($gender)): ?>
							<?php echo "Gender not found"; ?>
						<?php else: ?>
							<?php echo $gender; ?>
						<?php endif; ?>
					</span>
				</div>
			</div>
			<div class="about">
				<h2>About Me</h2>
				<p>
					<?php if(empty($bday)): ?>
						<?php echo "Birthday not found"; ?>
					<?php else: ?>
						My Birthday: <?php echo $bday; ?>
					<?php endif; ?>	
				</p><br/>

				<?php if($type != "Admin"): ?>
					<p><?php echo $short_desc; ?></p>
					<button class="edit" name="edit" value="<?php echo $id; ?>" onclick="editProfile();">Edit</button>
				<?php else: ?>
					<p>
						<?php if(empty($short_desc)):?> 
							Iam Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et and needs to be updated...</p>
						<?php else: ?>
							<?php echo $short_desc; ?>
						<?php endif; ?>
				<?php endif; ?>
			</div>
			<div class="contact">
				<h2>You can contact me here</h2>
				<span>
					<?php if(empty($contact_num)): ?>
						<?php echo "Contact number not found"; ?>
					<?php else: ?>
						<?php echo $contact_num; ?>
					<?php endif; ?>	
				</span><br/>
				<span>
					<?php if(empty($email)): ?>
						<?php echo "Email address not found"; ?>
					<?php else: ?>
						<?php echo $email; ?>
					<?php endif; ?>	
				</span>
			</div>
			<?php if($type == "Admin"): ?>
				<div class="actions">
					<?php echo "<a class='success' href = './edit-profile.php?id=".$id."'"; ?> title="Edit Profile">Edit Profile</a>
					<form action="" method="post">
						<?php if($status == 'enabled'): ?>
							<button class="errors" type="submit" name="disable">Disable Account</button>
						<?php else: ?>
							<button class="default" type="submit" name="enable">Enable Account</button>
						<?php endif; ?>
						
					</form>
				</div>
				
			<?php else: ?>
				<p class="note">*** Important Note: Profile updating can be requested from the admin ***</p>	
			<?php endif; ?>
		</div>
		<?php

		if(isset($_REQUEST['save']))  {
	  		header('Location: '.$_SERVER['REQUEST_URI']);

	  		if($type != 'Admin') {
	  			$short_desc = mysqli_real_escape_string($db, $_POST['short-desc']);	
	  			$sql_editProfile = "UPDATE profile SET short_desc = '$short_desc' WHERE user_id='$id'";
	  			mysqli_query($db, $sql_editProfile);
	  		} else {
	  			$fname = mysqli_real_escape_string($db, $_POST['fname']);
		  		$lname = mysqli_real_escape_string($db, $_POST['lname']);
		  		$course = mysqli_real_escape_string($db, $_POST['course']);
				$gender = mysqli_real_escape_string($db, $_POST['gender']);
		  		$contact_num = mysqli_real_escape_string($db, $_POST['pnum']);
		  		$email = mysqli_real_escape_string($db, $_POST['email']);

		  		$sql_editProfile = "UPDATE users, profile SET users.fname='$fname', users.lname='$lname', profile.course='$course', profile.gender='$gender', profile.contact_num='$contact_num', profile.email='$email' WHERE users.id = '$id' AND profile.user_id = '$id'";
	  			mysqli_query($db, $sql_editProfile);
	  		}
	  	}

	  	if (isset($_POST['disable'])) {
	  		$sql_editProfile = "UPDATE users SET status='disabled' WHERE id = '$id'";
	  		mysqli_query($db, $sql_editProfile);
	  		header('Location: '.$_SERVER['REQUEST_URI']);
	  	}

	  	if (isset($_POST['enable'])) {
	  		$sql_editProfile = "UPDATE users SET status='enabled' WHERE id = '$id'";
	  		mysqli_query($db, $sql_editProfile);
	  		header('Location: '.$_SERVER['REQUEST_URI']);
	  	}
	}

	function subjects() {
		include "server/db_conn.php";
		?>
		<div>
			<h2>Subject Offer in 1st Year</h2>
			<table>
				<thead>
					<tr>
						<th>Subject Code</th>
						<th>Subject Description</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					    $sql_subjects = "SELECT * FROM subjects WHERE subj_year = '1st'";
					    $get_subjects = mysqli_query($db, $sql_subjects);
					    
					    if (mysqli_num_rows($get_subjects) == 0) {
							?>
						    	<tr>
						    		<td colspan="2" style="text-align: center;">No available subjects to offer.</td>
						    	</tr>
						    <?php
						} else {
						  	while ($rows = mysqli_fetch_array($get_subjects)) {
						  		?>
						    	<tr>
						    		<td><?php echo $rows['subj_code']; ?></td>
						    		<td><?php echo $rows['subj_desc']; ?></td>
						    	</tr>
						    	<?php
						  	}
						}
					 ?>
				</tbody>
			</table>
		</div>

		<div>
			<h2>Subject Offer in 2nd Year</h2>
			<table>
				<thead>
					<tr>
						<th>Subject Code</th>
						<th>Subject Description</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					    $sql_subjects = "SELECT * FROM subjects WHERE subj_year = '2nd'";
					    $get_subjects = mysqli_query($db, $sql_subjects);
					    
					    if (mysqli_num_rows($get_subjects) == 0) {
							?>
						    	<tr>
						    		<td colspan="2" style="text-align: center;">No available subjects to offer.</td>
						    	</tr>
						    <?php
						} else {
						  	while ($rows = mysqli_fetch_array($get_subjects)) {
						  		?>
						    	<tr>
						    		<td><?php echo $rows['subj_code']; ?></td>
						    		<td><?php echo $rows['subj_desc']; ?></td>
						    	</tr>
						    	<?php
						  	}
						}
					 ?>
				</tbody>
			</table>
		</div>

		<div>
			<h2>Subject Offer in 3rd Year</h2>
			<table>
				<thead>
					<tr>
						<th>Subject Code</th>
						<th>Subject Description</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					    $sql_subjects = "SELECT * FROM subjects WHERE subj_year = '3rd'";
					    $get_subjects = mysqli_query($db, $sql_subjects);

					    if (mysqli_num_rows($get_subjects) == 0) {
							?>
						    	<tr>
						    		<td colspan="2" style="text-align: center;">No available subjects to offer.</td>
						    	</tr>
						    <?php
						} else {
						  	while ($rows = mysqli_fetch_array($get_subjects)) {
						  		?>
						    	<tr>
						    		<td><?php echo $rows['subj_code']; ?></td>
						    		<td><?php echo $rows['subj_desc']; ?></td>
						    	</tr>
						    	<?php
						  	}
						}
					 ?>
				</tbody>
			</table>
		</div>

		<div>
			<h2>Subject Offer in 4th Year</h2>
			<table>
				<thead>
					<tr>
						<th>Subject Code</th>
						<th>Subject Description</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					    $sql_subjects = "SELECT * FROM subjects WHERE subj_year = '4th'";
					    $get_subjects = mysqli_query($db, $sql_subjects);

					    if (mysqli_num_rows($get_subjects) == 0) {
							?>
						    	<tr>
						    		<td colspan="2" style="text-align: center;">No available subjects to offer.</td>
						    	</tr>
						    <?php
						} else {
						  	while ($rows = mysqli_fetch_array($get_subjects)) {
						  		?>
						    	<tr>
						    		<td><?php echo $rows['subj_code']; ?></td>
						    		<td><?php echo $rows['subj_desc']; ?></td>
						    	</tr>
						    	<?php
						  	}
						}
					 ?>
				</tbody>
			</table>
		</div>
		<?php
	}
?>