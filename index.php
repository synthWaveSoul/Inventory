<?php

	session_start();
	
	if((isset($_SESSION['logged'])) && ($_SESSION['logged']==true))
	{
		header('Location: home.php');
		exit();
	}

	
?>

<!DOCTYPE HTML>
<html>
<head>

	<title>Company inventory</title>
	<link rel="stylesheet" href="main.css">
	<link rel="stylesheet" href="fontello/css/fontello.css">
	<link rel="stylesheet" href="popup.css">
	<link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&display=swap" rel="stylesheet">
	<script type="text/javascript" src="main.js"></script>

</head>
<body>

	<header>
		<h1 class="logo"> Company inventory <i class="icon-box"></i> </h1>
	
	</header>
	
	<main>
	
		<section>
		
			<form action="login.php" method="post">
			
				<div class="body">
				<div style="height: 47px;"></div>
				
					<div class="allControls">
					
						<div class="oneInput">
									
							<label for="login" class="labelLog"> Login </label>
							<input type="text" name="login" placeholder="Login" required>
										
						</div>
						
						<div class="oneInput">
									
							<label for="pass" class="labelLog"> Password </label>
							<input type="password" name="pass" placeholder="Password" required>
										
						</div>
						
						<div class="err">
						
<?php

	if (isset($_SESSION['error']))
	{
		echo $_SESSION['error'];
		unset ($_SESSION['error']);
	}

?>
						</div>
						
						<div class="button">
								
							<input type="submit" value="Login" id="logButton">																					
							
						</div>
						
					</div>
				
				</div>
				
			</form>
		
		</section>
	
	</main>
	
	<footer>
		<div class="footer">
			Developed by Pawel Pawelski
		</div>
	</footer>

</body>
</html>