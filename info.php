<?php 
	include "server/functions.php";
	if(!isset($_SESSION)) {
	    session_start();
	    $idCheck = $_SESSION['id'];
	    $type = $_SESSION['type'];
	}
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
<body class="page-info">
	<?php include_once "loader.php"; ?>
	<header>
		<div class="header-wrapper">
			<?php if($type == "Admin"): ?>
				<a class="logo" href="main.php?id=<?php echo $idCheck; ?>">BSIT WEBSITE</a>
				<nav>
					<ul>
						<li><a href="main.php?id=<?php echo $idCheck; ?>">Feeds</a></li>
						<li><a href="./add-subject.php?id=<?php echo $idCheck; ?>">Subjects</a></li>
						<li><a href="./posts.php?id=<?php echo $idCheck; ?>">Posts</a></li>
						<li><a href="./profiles.php">Profiles</a></li>
						<li><a href="./logout.php ?>">Logout</a></li>
					</ul>
				</nav>
			<?php elseif($type == "student"): ?>
				<a class="logo" href="student.php?id=<?php echo $idCheck; ?>">BSIT WEBSITE</a>
				<nav>
					<ul>
						<li><a href="student.php?id=<?php echo $idCheck; ?>">Feeds</a></li>
						<li><a href="./subjects.php">Subjects</a></li>
						<li><a href="./info.php?id=<?php echo $idCheck; ?>">Profile</a></li>
						<li><a href="./logout.php ?>">Logout</a></li>
					</ul>
				</nav>
			<?php elseif($type == "faculty"): ?>
				<a class="logo" href="faculty.php?id=<?php echo $idCheck; ?>">BSIT WEBSITE</a>
				<nav>
					<ul>
						<li><a href="faculty.php?id=<?php echo $idCheck; ?>">Feeds</a></li>
						<li><a href="./subjects.php">Subjects</a></li>
						<li><a href="./info.php?id=<?php echo $idCheck; ?>">Profile</a></li>
						<li><a href="./logout.php ?>">Logout</a></li>
					</ul>
				</nav>	
			<?php endif; ?>
		</div>
	</header>
	<div class="main">
		<?php info(); ?>
		<div class="overlay"></div>
		
	</div>
	<footer>
		<?php if($type == "Admin"): ?>
			<p>Copyright &copy; 2019 | <a href="main.php?id=<?php echo $idCheck; ?>">BSIT WEBSITE</a></p>
		<?php elseif($type == "student"): ?>
			<p>Copyright &copy; 2019 | <a href="student.php?id=<?php echo $idCheck; ?>">BSIT WEBSITE</a></p>
		<?php elseif($type == "faculty"): ?>
			<p>Copyright &copy; 2019 | <a href="faculty.php?id=<?php echo $idCheck; ?>">BSIT WEBSITE</a></p>
		<?php endif; ?>
		
	</footer>
</body>
</html>