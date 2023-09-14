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
<body onload="onload();fillingFromReport();">

<?php
	if (isset($_SESSION['recordUpdated']))
	{
		if ($_SESSION['recordUpdated'] == 1)
		{
			echo "<script>Swal.fire('Success','The device details updated successfully ','success');</script>";
			$_SESSION['recordUpdated'] = 0;
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
							
					Enter device ID 
					
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

				<div class="allControls">
			
					<form action="updateDB.php" method="post" class="updateForm" name="updateForm">

						<div class="formHeader">
							Selected device ID  
							<input type="text" name="selectedDeviceId" id="selDevId" readonly>
						</div>
					
						<div class="col" id="toHide1">
						
							<div class="oneInput">
							
								<label for="devType">Type of device</label>
								<input type="text" name="devType" id="type" readonly>
								
							</div>
							
							<div class="oneInput">
							
								<label for="model"> Model </label>
								<input type="text" name="model" id="modelInput" placeholder="E.g. 9090, Dell XPS 9305" disabled required>
								
							</div>
							
							<div class="oneInput">
								
								<label for="name"> Name </label>
								<input type="text" name="name" id="nameInput" placeholder="Host name" disabled>
								
							</div>
						
						</div>
						
						<div class="col"  id="toHide2">
						
							<div class="oneInput">
						
								<label for="sn"> SN </label>
								<input type="text" name="sn" id="snInput" placeholder="Serial number" disabled>
							
							</div>
							
							<div class="oneInput">
						
								<label for="mac"> MAC </label>
								<input type="text" name="mac" id="macInput" required pattern="[a-zA-Z0-9]+" placeholder="MAC address without  :  or  -" disabled>
							
							</div>

							<div class="oneInput">
							
								<label for="location">Location</label>					
								<select id="location" name="location" required disabled style='display: blank'>
									<option value="" selected disabled hidden>Choose department</option>
									<option value="Sleeving">Sleeving</option>					
									<option value="Grader">Grader</option>					
									<option value="Multivac">Multivac</option>					
									<option value="Despatch">Despatch</option>					
									<option value="Boning Hall">Boning Hall</option>					
									<option value="Killfloor">Killfloor</option>					
									<option value="Loading Bay">Loading Bay</option>					
									<option value="IT">IT</option>			
								</select>
								
							</div>
							
						</div>
						
						<div class="comm" id="toHide3">
						
							<label for="com"> Comments </label>
							<input type="text" name="com" id="comInput" placeholder="Comments" class="comField" disabled>
					
						</div>

						<div class="button" id="toHide4">
							<input type="button" class="open-button" id="updateButton" onclick="checkData(document.getElementById('selDevId').value, document.getElementById('snInput').value,document.getElementById('macInput').value)" value="Update" disabled>
						</div>

					</form>
				
				</div>
						
			</div>
		
		</section>
	
	</main>
	
	<footer>
		<div class="footer">
			Developed by Pawel Pawelski
		</div>
	</footer>

	<script type="text/javascript" src="update.js"></script>
</body>
</html>