<?php

session_start();

require_once "link/connect_2.php";

if (isset($connection)) {

    $id = $_REQUEST["q"];

    $query = "UPDATE table_name SET removed='y' WHERE invno = $id";

    $result = mysqli_query($connection, $query);

    $connection->close();

    $_SESSION['recordDeleted'] = 1;

    $previousURL = $_SERVER['HTTP_REFERER'];

    if (strpos($previousURL, 'report') == true) {
        header('Location: report.php');
    }else{
        header('Location: remove.php');
    }
}

?>