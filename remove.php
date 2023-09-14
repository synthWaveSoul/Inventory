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
	<link rel="stylesheet" href="fontello/css/fontello.css">
	<link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&display=swap" rel="stylesheet">
	<script type="text/javascript" src="main.js"></script>
	<script src="sweetalert2.all.min.js"></script>

</head>
<body onload="onload()";>

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
	
		<section>
			
			<div class="body">

				<div class="search">
								
					Enter the ID you want to delete
									
					<input type="number" id="inputField" name="searchBox" placeholder="ID">
				
					<input type="button" id="findId" value="Search" onclick="returnId(document.getElementById('inputField').value);"></button>
			
				</div>

				<div class="reportTable" id="table">
					<table class="blueTable">
					<tr>
					<th>no</th>
					<th>id</th>
					<th>devtype</th>
					<th>model</th>
					<th>name</th>
					<th>sn</th>
					<th>mac</th>
					<th>location</th>
					<th>comment</th>
					</tr>
					<tr>
           			<td colspan="9">Enter the device id in the field above</td>
            		</tr>
					</table>
				</div>

				<div class="divRemove" id="idDivRem">
					<div class="selectedDevice">
						Selected device ID  
						<input type="text" name="selectedDeviceId" id="selDevId" readonly>
					</div>

					<div class="button" id="delDivButton">
						<input type="button" class="delete-button" id="deleteButton" onclick="deleteRecord()" value="Delete" disabled>
					</div>
				</div>
						
			</div>
		
		</section>
	
	</main>
	
	<footer>
		<div class="footer">
			Developed by Pawel Pawelski
		</div>
	</footer>

	<script type="text/javascript" src="delete.js"></script>
</body>
</html>