<?php

if (!empty($_GET['q'])) {

    require_once "link/connect_2.php";

    if (isset($connection)) {

        if (!empty($_GET['showall'])) {

            $result = mysqli_query($connection, "SELECT * FROM table_name WHERE removed='n'");

            echo '<table class="blueTable" id="mainTable">
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

            mysqli_close($connection);
        }else{

            if (!empty($_GET['id'])) {$urlArray['invno'] = $_GET['id'];}
            if (!empty($_GET['type'])) {$urlArray['devtype'] = $_GET['type'];}
            if (!empty($_GET['model'])) {$urlArray['model'] = $_GET['model'];}
            if (!empty($_GET['name'])) {$urlArray['name'] = $_GET['name'];}
            if (!empty($_GET['sn'])) {$urlArray['sn'] = $_GET['sn'];}
            if (!empty($_GET['mac'])) {$urlArray['mac'] = $_GET['mac'];}
            if (!empty($_GET['loc'])) {$urlArray['location'] = $_GET['loc'];}
            if (!empty($_GET['com'])) {$urlArray['comment'] = $_GET['com'];}

            $string = "";

            foreach ($urlArray as $x => $x_value) {
                $string .= $x." LIKE '%".$x_value."%' AND ";
            }

            $sqlString = substr($string, 0, -5);

            $string = "SELECT * FROM table_name WHERE removed='n' AND ".$sqlString;

            $result = mysqli_query($connection, $string);

            if (mysqli_num_rows($result) > 0) {

                echo '<table class="blueTable" id="mainTable">
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

                echo "<script>fillReport();</script>";

                mysqli_close($connection);
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
                <td colspan="9">Nothing found in the database</td>
                </tr>
                </table>';

                echo "<script>fillReport();</script>";

                mysqli_close($connection);
            }
        }
    }
}
