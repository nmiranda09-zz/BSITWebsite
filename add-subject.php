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
</head>
<body class="page-subject">
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
		<div class="add-subj-con">
			<form action="" method="post">
				<div class="top">
					<h1>Add a subject</h1>
					<a href="./subjects.php">View All</a>
				</div>
				<?php addSubject(); ?>
				<div>
					<label>Year Level:</label>
					<select name="subj-year">
						<option>1st</option>
						<option>2nd</option>
						<option>3rd</option>
						<option>4th</option>
					</select>
				</div>
				<input type="text" name="subj-code" placeholder="Subject Code" required/>
				<textarea class="subj-desc" name="subj-desc" placeholder="Subject Description" maxlength="150" required></textarea>
				<span class="char-count"></span>
				<input class="submit-btn" type="submit" value="submit" name="subj-submit">
			</form>
			
		</div>
	</div>
	<footer>
		<p>Copyright &copy; 2019 | <a href="main.php?id=<?php echo $idCheck; ?>">BSIT WEBSITE</a></p>
	</footer>
</body>
</html>