<?php

	session_start();

	require_once "link/connect_2.php";

	if (isset($connection))
	{
		
		$devType = mysqli_real_escape_string($connection, $_POST['devType']);
		$model = mysqli_real_escape_string($connection, $_POST['model']);
		$name = mysqli_real_escape_string($connection, $_POST['name']);
		$sn = mysqli_real_escape_string($connection, $_POST['sn']);
		$mac = mysqli_real_escape_string($connection, $_POST['mac']);
		$location = mysqli_real_escape_string($connection, $_POST['location']);
		$com = mysqli_real_escape_string($connection, $_POST['com']);
		$invno = mysqli_real_escape_string($connection, $_POST['barcode']);
		
		$query = "SELECT * FROM table_name WHERE sn = '$sn' OR mac = '$mac' OR invno = $invno";
		
		$result = mysqli_query($connection, $query);
		
		if (mysqli_num_rows($result) > 0)
		{
			$row = mysqli_fetch_array($result);

			if ($row['sn'] == $sn){
				echo "<script>history.back();</script>";        
				$_SESSION['snerror'] = 1;
			}else if($row['mac'] == $mac){
				echo "<script>history.back();</script>";        
				$_SESSION['macerror'] = 1;
			}else if($row['invno'] == $invno){
				echo "<script>history.back();</script>";        
				$_SESSION['invnoerror'] = 1;
				echo "<script>history.back();</script>";
			}	
			
			$connection->close();
		}
		else
		{
			$query_ins = "INSERT INTO table_name (devtype, model, name, sn, mac, location, comment, invno) VALUES (NULLIF('$devType',''), NULLIF('$model',''), NULLIF('$name',''), NULLIF('$sn',''), NULLIF('$mac',''), NULLIF('$location',''), NULLIF('$com',''), $invno)";
			
			$result_ins = mysqli_query($connection, $query_ins);
			
			$connection->close();
			
			$_SESSION['recordAdded'] = 1;
			
			header('Location: add.php');
		}
			
	}

?>