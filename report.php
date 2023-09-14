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
	<link rel="stylesheet" href="table.css">
	<link rel="stylesheet" href="popup.css">
	<link rel="stylesheet" href="fontello/css/fontello.css">
	<link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&display=swap" rel="stylesheet">
	<script type="text/javascript" src="main.js"></script>
	<script src="sweetalert2.all.min.js"></script>

</head>
<body onload="onload();rowClicker();">

<?php

	if (isset($_SESSION['recordDeleted']))
	{
		if ($_SESSION['recordDeleted'] == 1)
		{
			echo "<script>Swal.fire('Success','The device deleted successfully ','success');</script>";
			$_SESSION['recordDeleted'] = 0;
		}
	}
?>

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

	<a href="#" class="scrollup" id="goTop" style="display: none;" onclick="scrollup();"></a>
	
		<section>
			
			<div class="body">

				<div class="rowInput">

				<input type="text" name="id" id="idId" placeholder="ID of device" style="width: 924px;">

				</div>

				<div class="rowInput">

					<input type="text" name="type" id="idType" placeholder="Type of device">
					<input type="text" name="model" id="idModel" placeholder="Model">
					<input type="text" name="name" id="idName" placeholder="Name">

				</div>

				<div class="rowInput">

					<input type="text" name="sn" id="idSn" placeholder="SN">
					<input type="text" name="mac" id="idMac" placeholder="MAC">
					<input type="text" name="location" id="idLocation" placeholder="Location">

				</div>

				<div class="rowInput">

					<input type="text" name="comment" id="idComment" placeholder="Comment" style="width: 924px;">

				</div>
				<div class="rowInput">

					<input type="button" value="Show all" onclick="window.location.href='report.php?q=1&showall=1';" style="width: 462px;margin: 8px 2px 0 0;padding: 0;">
					<input type="button" value="Search" onclick="search();" style="width: 462px;margin: 8px 0 0 2px;padding: 0;">

				</div>

				<div class="reportTable">
					<?php
						include 'displayReport.php';		
					?>
				</div>

				<div class="empty"></div>
						
			</div>

		</section>	
	
	</main>
	
	<footer>
		<div class="footer">
			Developed by Pawel Pawelski
		</div>
	</footer>

	<script>
		var myButton = document.getElementById("goTop");

		window.onscroll = function() {scrollFunction()};

		function scrollFunction() {
			if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
				myButton.style.display = "block";
			}else{
				myButton.style.display = "none";
			}
		}
	</script>

	<script type="text/javascript" src="main.js"></script>

	</body>
</html>