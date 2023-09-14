<?php

	session_start();

	require_once "link/connect_2.php";
	
	if (isset($connection))
	{
		/*only if $connection is success below code will execute*/
		
		$login = $_POST['login'];
		$password = $_POST['pass'];
		
		$login = htmlentities($login, ENT_QUOTES);
		
		if ($result = $connection->query(
		sprintf("SELECT * FROM users WHERE login='%s'",
		mysqli_real_escape_string($connection,$login))))
		{
			$userscount = $result->num_rows;
			if ($userscount>0)
			{
				$row = $result->fetch_assoc();
				
				if (password_verify($password, $row['pass']))
				{
					$_SESSION['logged'] = true;
					
					$_SESSION['id'] = $row['id'];				
					$_SESSION['logname'] = $row['full_name'];				
					
					unset($_SESSION['error']);
					$result->free_result();
					header('Location: home.php');
				}
				else
				{
					$_SESSION['error'] = '<span style="color:red">Incorrect login or password</span>';
					header('Location: index.php');
				}
			}
			else
			{
				$_SESSION['error'] = '<span style="color:red">Incorrect login or password</span>';
				header('Location: index.php');
			}
		}
			
		$connection->close();
	}	
	
?>