<?php

	session_start();
	
	if (!isset($_SESSION['logged']))
	{
		header('Location: index.php');
		exit();
	}
	
?>

<!DOCTYPE html>
<html>
<head>

	<title>Company inventory</title>
	<link rel="stylesheet" href="main.css">
	<link rel="stylesheet" href="fontello/css/fontello.css">
	<link rel="stylesheet" href="popup.css">
	<link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&display=swap" rel="stylesheet">
	<script type="text/javascript" src="main.js"></script>

</head>
<body onload="onload()";>

	<header>
		<h1 class="logo"> Company inventory <i class="icon-box"></i> </h1>
	
		<nav id="navbar">
			<ul class="mainmenu">
			<li><a href="home.php">Home</a></li><li><a href="report.php">Report</a></li><li><a href="add.php">Add</a></li><li><a href="update.php">Update</a></li><li><a href="remove.php">Remove</a></li><li><a href="logout.php" onClick="setScode()">Logout</a></li>
			</ul>
		</nav>
	</header>
	
	<div class="logged">
	
<?php

	echo "Logged as ".$_SESSION['logname'];

?>

	</div>
	
	<main>
	
		<section>
			
			<div class="body">
						
			</div>
		
		</section>
	
	</main>
	
	<footer>
		<div class="footer">
			Developed by Pawel Pawelski
		</div>
	</footer>

</body>
</html>