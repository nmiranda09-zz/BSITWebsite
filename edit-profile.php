<?php
	include "server/db_conn.php";
	include "server/functions.php";

	if(!isset($_SESSION)) {
	    session_start();
	    $userId = $_GET['id'];
	    $type = $_SESSION['type'];
	    $sessionId = $_SESSION['id'];
	}


	$sql_getInfo = mysqli_query($db , "SELECT * FROM users, profile WHERE users.id = '$userId' AND profile.user_id = '$userId'");
	$getInfo_query = mysqli_fetch_array($sql_getInfo);
  	$target = "img/";
	$avatar = $getInfo_query['profile_pic'];
	$fname = $getInfo_query['fname'];
	$lname = $getInfo_query['lname'];
	$gender = $getInfo_query['gender'];
	$bday = $getInfo_query['bday'];
	$course = $getInfo_query['course'];
	$year_level = $getInfo_query['year_level'];
	$contact_num = $getInfo_query['contact_num'];
	$email = $getInfo_query['email'];
	$profile_type = $getInfo_query['type'];

  	?>
  	<!DOCTYPE html>
<html>
<head>
	<title>BSIT WEBSITE</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/global.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- <meta http-equiv="refresh" content="5" /> -->
</head>
<body class="page-edit">
	<?php include_once "loader.php"; ?>
	<header>
		<div class="header-wrapper">
			<a class="logo" href="main.php?id=<?php echo $sessionId; ?>">BSIT WEBSITE</a>
			<nav>
				<ul>
					<li><a href="main.php?id=<?php echo $sessionId; ?>">Feeds</a></li>
					<li><a href="./add-subject.php?id=<?php echo $sessionId; ?>">Subjects</a></li>
					<li><a href="./posts.php?id=<?php echo $sessionId; ?>">Posts</a></li>
					<li><a href="./profiles.php">Profiles</a></li>
					<li><a href="./logout.php">Logout</a></li>
				</ul>
			</nav>
		</div>
	</header>
  	<div class="main">
		<form action="" method="POST" enctype="multipart/form-data">
			<h1>Edit Profile</h1>
			<div class="avatar">
				<?php if(empty($avatar)): ?>
					<img src="img/avatar.png" alt="avatar" style="max-width: 150px;"/>
				<?php else: ?>
					<img src="<?php echo $target.$avatar; ?>" style="max-width: 150px;">
				<?php endif; ?>
			</div>
			<div class="input-container">
			 	<input type="file" id="file" name="profile-pic" onchange="fileSelect(event)" class="inputField" hidden/>
			    <label for="file" class="browse-btn">Choose photo</label>
			  	<span class="file-info">No file chosen.</span>
			</div>
			
	  		<input type="text" name="fname" value="<?php echo $fname; ?>" placeholder="First Name *" required/>
	  		<input type="text" name="lname" value="<?php echo $lname; ?>" placeholder="Last Name *" required/>
	  		<input type="date" name="bday" value="<?php echo $bday; ?>" required/>
			<input type="text" name="course" value="<?php echo $course; ?>" placeholder="e.g Bachelor of Science in Computer Science *" required/>
			<select name="gender" required>
				<option disabled selected>Select Gender (Always select an option every update)</option>
				<option>Male</option>
				<option>Female</option>
			</select>
			<select name="year-level" required>
				<option disabled selected>Select Level (Always select an option every update)</option>
				<option>1st Year</option>
				<option>2nd Year</option>
				<option>3rd Year</option>
				<option>4th Year</option>
				<option>Graduate</option>
			</select>
			<input type="number" name="pnum" value="<?php echo $contact_num; ?>" placeholder="e.g 09123456789 *" maxlength="11"/>
			<input type="email" name="email" value="<?php echo $email; ?>" placeholder="e.g sample@sample.sample (optional)" />
			<button type="submit" class="save-btn" name="save">Save</button>
		</form>

  	</div>
  	<p class="note">*** Important Note: Keep updating to minimum ***</p>
  	<footer>
		<p>Copyright &copy; 2019 | <a href="main.php?id=<?php echo $idCheck; ?>">BSIT WEBSITE</a></p>
	</footer>
</body>
</html>
<?php 
	if(isset($_POST['save'])) {
		$fileName = $_FILES['profile-pic']['name'];
		$target = "img/";		
		$fileTarget = $target.$fileName;
		$tempFileName = $_FILES["profile-pic"]["tmp_name"];
		$fname = mysqli_real_escape_string($db, $_POST['fname']);
		$lname = mysqli_real_escape_string($db, $_POST['lname']);
		$course = mysqli_real_escape_string($db, $_POST['course']);
		$bday = mysqli_real_escape_string($db, $_POST['bday']);
		$year_level = mysqli_real_escape_string($db, $_POST['year-level']);
		$gender = mysqli_real_escape_string($db, $_POST['gender']);
		$contact_num = mysqli_real_escape_string($db, $_POST['pnum']);
		$email = mysqli_real_escape_string($db, $_POST['email']);

		$allowedMimeTypes = array(
		  'image/jpeg',
		  'image/png'
		);

		if (!(in_array($_FILES["profile-pic"]["type"], $allowedMimeTypes))) {
		  	array_push($errors, 'You have already uploaded a photo or invalid format (JPG & PNG only)');
		  	include "server/errors.php";
		} else {
			$result = move_uploaded_file($tempFileName,$fileTarget);
			$sql_editProfile = "UPDATE users, profile SET profile.profile_pic='$fileName', users.fname='$fname', users.lname='$lname', profile.bday='$bday', profile.course='$course', profile.gender='$gender', profile.year_level='$year_level', profile.contact_num='$contact_num', profile.email='$email' WHERE users.id='$userId' AND profile.user_id = '$userId'";
  			mysqli_query($db, $sql_editProfile);
  			header('Location: '.$_SERVER['REQUEST_URI']);
			
		}
	}
?>