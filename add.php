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
	<link rel="stylesheet" href="popup.css">
	<link rel="stylesheet" href="fontello/css/fontello.css">
	<link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&display=swap" rel="stylesheet">
	<script type="text/javascript" src="main.js"></script>
	<script src="sweetalert2.all.min.js"></script>

</head>
<body onload="onload();fillingForDuplicate();">

<?php

	if (isset($_SESSION['recordAdded']))
	{
		if ($_SESSION['recordAdded'] == 1)
		{
			echo "<script>Swal.fire('Success','The device added successfully ','success');</script>";
			$_SESSION['recordAdded'] = 0;
		}
	}

	if (isset($_SESSION['snerror'])){

		if ($_SESSION['snerror'] == 1){
			echo "<script>Swal.fire('SN error','A device with the entered SN address already exists in the database','error');</script>";
			$_SESSION['snerror'] = 0;
		}
	}
	if (isset($_SESSION['macerror'])){

		if ($_SESSION['macerror'] == 1){
			echo "<script>Swal.fire('MAC error','A device with the entered MAC address already exists in the database','error');</script>";
			$_SESSION['macerror'] = 0;
		}
	}
	if (isset($_SESSION['invnoerror'])){

		if ($_SESSION['invnoerror'] == 1){
			echo "<script>Swal.fire('Barcode error','The entered inventory barcode number is already assigned to another device','error');</script>";
			$_SESSION['invnoerror'] = 0;
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
	<section>

	<div class="logged">
	
<?php

	echo "Logged as ".$_SESSION['logname'];

?>

	</div>
	
	</section>
	<main>
	
		<section>
			
			<div class="body">
			
				<div class="allControls">
			
					<form action="addDB.php" method="post">
					
						<div class="col" id="toHide1">
						
							<div class="oneInput">
							
								<label for="devType">Type of device</label>					
								<select id="type" name="devType">					
									<option value="scanner">Scanner</option>					
								</select>
								
							</div>
							
							<div class="oneInput">
							
								<label for="model"> Model </label>
								<input type="text" name="model" id="idModel" placeholder="E.g. 9090, Dell XPS 9305" required>
								
							</div>
							
							<div class="oneInput">
								
								<label for="name"> Name </label>
								<input type="text" name="name" id="idName" placeholder="Host name">
								
							</div>
						
						</div>
						
						<div class="col"  id="toHide2">
						
							<div class="oneInput">
						
								<label for="sn"> SN </label>
								<input type="text" name="sn" id="idSn" placeholder="Serial number">
							
							</div>
							
							<div class="oneInput">
						
								<label for="mac"> MAC </label>
								<input type="text" name="mac" id="macInput" required pattern="[a-zA-Z0-9]+" placeholder="MAC address without  :  or  -">
							
							</div>

							<div class="oneInput">
							
								<label for="location">Location</label>					
								<select id="location" name="location" required style='display: blank'>
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
							<input type="text" name="com" id="idComment" placeholder="Comments" class="comField">
					
						</div>

						<div class="form-popup" id="myForm">
							
							<h1> Enter barcode number </h1>

							
							<input type="number" placeholder="ID number" name="barcode" required>

							<br><button type="submit" class="open-button" id="submitButton">Send</button>
							<br><button type="button" class="cancel-button" onclick="closeForm()">Cancel</button>
							
						</div>

						<div class="button" id="toHide4">
						<button type="button" class="open-button" onclick="openForm()">Add device</button>
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

</body>
</html>