<?php

require_once "link/connect_2.php";

session_start();

$id = $_REQUEST["q"];

$query = "SELECT * FROM table_name WHERE invno=$id AND removed='n'";

$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {

    if (mysqli_num_rows($result) == 1) {

        echo '<table class="blueTable">
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
                </tr>';
        
        $no = 1;
        
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td id='tdIdNo'>" . $no . "</td>";
            echo "<td id='tdIdInvno'>" . $row['invno'] . "</td>";
            echo "<td id='tdIdDevtype'>" . $row['devtype'] . "</td>";
            echo "<td id='tdIdModel'>" . $row['model'] . "</td>";
            echo "<td id='tdIdName'>" . $row['name'] . "</td>";
            echo "<td id='tdIdSn'>" . $row['sn'] . "</td>";
            echo "<td id='tdIdMac'>" . $row['mac'] . "</td>";
            echo "<td id='tdIdLocation'>" . $row['location'] . "</td>";
            echo "<td id='tdIdComment'>" . $row['comment'] . "</td>";
            echo "</tr>";
            $no++;
        }
        echo "</table>";

        echo "<div class='hidden' id='idJson'>allGood1</div>";
        
        mysqli_close($connection);

    }else{      //if there are more results
        echo '<table class="blueTable">
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
                </tr>';
        
        $no = 1;
        
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $no . "</td>";
            echo "<td>" . $row['invno'] . "</td>";
            echo "<td>" . $row['devtype'] . "</td>";
            echo "<td>" . $row['model'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['sn'] . "</td>";
            echo "<td>" . $row['mac'] . "</td>";
            echo "<td>" . $row['location'] . "</td>";
            echo "<td>" . $row['comment'] . "</td>";
            echo "</tr>";
            $no++;
        }
        echo "</table>";

        echo "<div class='hidden' id='idJson'>error</div>";
        
        mysqli_close($connection);
    }

}else{
    echo '<table class="blueTable">
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
            <td colspan="9">Device with ID '.$id.' was not found in the database</td>
            </tr>
        </table>';

    echo "<div class='hidden' id='idJson'>error</div>";
    
    mysqli_close($connection);
}
    



?>