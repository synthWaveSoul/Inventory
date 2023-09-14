<?php

	session_start();

	require_once "link/connect_2.php";

	$id = $_REQUEST["id"];
	$sn = $_REQUEST["sn"];
	$mac = $_REQUEST["mac"];

	$querySelect = "SELECT * FROM table_name WHERE removed='n' AND (NOT invno=$id AND (sn='$sn' OR mac='$mac'))";

	$result = mysqli_query($connection, $querySelect);

	$no = 1;
	
	if (mysqli_num_rows($result) == 1) {
		//there is something in DB with provided sn or mac
		while ($row = mysqli_fetch_array($result)) {
			echo $row['invno'];
		}}
	else if (mysqli_num_rows($result) > 1) {
		//there is something in DB with provided sn or mac
		while ($row = mysqli_fetch_array($result)) {
			echo " | ";
			echo $row['invno'];
			echo " | ";
			$no++;
		}}
	else{
		echo "ok";
	}
?>