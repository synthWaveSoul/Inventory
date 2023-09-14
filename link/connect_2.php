<?php

require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);

try 
{
	$connection = new mysqli($host, $db_user, $db_password, $db_name);
	if ($connection->connect_errno!=0)
	{
		throw new Exception(mysqli_connect_errno());
	}
} 
catch (Exception $e) 
{
	/*echo 'Caught exception: ',  $e->getMessage(), "\n";*/
	echo 'Connection error';
}

?>