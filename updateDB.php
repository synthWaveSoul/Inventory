<?php

	session_start();

	require_once "link/connect_2.php";

	if (isset($connection))
	{
		
		$id = mysqli_real_escape_string($connection, $_POST['selectedDeviceId']);
		$devType = mysqli_real_escape_string($connection, $_POST['devType']);
		$model = mysqli_real_escape_string($connection, $_POST['model']);
		$name = mysqli_real_escape_string($connection, $_POST['name']);
		$sn = mysqli_real_escape_string($connection, $_POST['sn']);
		$mac = mysqli_real_escape_string($connection, $_POST['mac']);
		$location = mysqli_real_escape_string($connection, $_POST['location']);
		$com = mysqli_real_escape_string($connection, $_POST['com']);

		$query = "UPDATE table_name SET devtype=NULLIF('$devType',''),model=NULLIF('$model',''),name=NULLIF('$name',''),sn=NULLIF('$sn',''),mac=NULLIF('$mac',''),location=NULLIF('$location',''),comment=NULLIF('$com','') WHERE invno = $id";
		
		$result = mysqli_query($connection, $query);
		
		$connection->close();

		$_SESSION['recordUpdated'] = 1;

		header('Location: update.php');
	}
?>