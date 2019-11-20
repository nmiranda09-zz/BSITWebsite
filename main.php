<?php 
	include "server/functions.php";
	if(!isset($_SESSION)) {
	    session_start();
	    $idCheck = $_SESSION['id'];
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
<body class="page-index">
	<?php include_once "loader.php"; ?>
	<header>
		<div class="header-wrapper">
			<a class="logo" href="main.php?id=<?php echo $idCheck; ?>">BSIT WEBSITE</a>
			<nav>
				<ul>
					<li><a href="main.php?id=<?php echo $idCheck; ?>">Feeds</a></li>
					<li><a href="./add-subject.php?id=<?php echo $idCheck; ?>">Subjects</a></li>
					<li><a href="./posts.php?id=<?php echo $idCheck; ?>">Posts</a></li>
					<li><a href="./profiles.php">Profiles</a></li>
					<li><a href="./logout.php">Logout</a></li>
				</ul>
			</nav>
		</div>
	</header>
	<div class="main">
		<div class="blk-container">
			<div class="announcement-blk">
				<h1>Announcement Feeds</h1>
				<div id="show"></div>
			</div>
			<div class="event-blk">
				<h1>Events</h1>
				<div id="show"></div>
			</div>
		</div>
		
	</div>
	<footer>
		<p>Copyright &copy; 2019 | <a href="main.php?id=<?php echo $idCheck; ?>">BSIT WEBSITE</a></p>
	</footer>
</body>
</html>