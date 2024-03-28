<?php
include "db_conn.php";
include 'db_pdo.php';

$id = mysqli_real_escape_string($conn, $_POST["id"]);
$date = mysqli_real_escape_string($conn, $_POST["date"]);




  	$sql = "SELECT *
        FROM dtr
        WHERE AccID = $id AND DATE_FORMAT(Date, '%Y-%m') = '$date'";
    $result = mysqli_query($conn, $sql);



    // Display the record in Table
    if (mysqli_num_rows($result)) {
        echo "<table class='table table-striped'>
                <thead>
                    <tr>
                        <th scope='col'>Date</th>
                        <th scope='col'>Time In</th>
                        <th scope='col'>Time Out</th>
                        <th scope='col'>Total Hours</th>
                        <th scope='col'>Status</th>
                    </tr>
                </thead>
                <tbody>";

        $i = 0;
        while ($rows = mysqli_fetch_assoc($result)) {
            $i++;
            echo "<tr>
                    <td>" . $rows['Date'] . "</td>
                    <td>" . $rows['TimeIn'] . "</td>
                    <td>" . $rows['TimeOut'] . "</td>
                    <td>" . $rows['TotalHrs'] . "</td>";

            // Color coding for the Status to make it Striking
            if ($rows['Status'] == "Not Approved") {
                echo "<td style='color:red;'>" . $rows['Status'] . "</td>";
            } else {
                echo "<td style='color:green;'>" . $rows['Status'] . "</td>";
            }

            echo "</tr>";
        }

        echo "</tbody>
            </table>";
    } else {
        echo '<div class="todo-item">';
        echo '<h2 id="consume">There is no recorded dtr in this Month</h2>';
        echo '</div>';
    }

?>