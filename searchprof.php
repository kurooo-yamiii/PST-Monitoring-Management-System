<?php

include "db_conn.php";

$searchprofTerm = mysqli_real_escape_string($conn, $_POST["search"]);

// Your SQL query to search in your table
$sql = "SELECT * FROM teacher WHERE Name LIKE '%$searchprofTerm%' OR School LIKE '%$searchprofTerm%' OR Division LIKE '%$searchprofTerm%'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $rowCount = mysqli_num_rows($result);
    
    if ($rowCount > 0) {
        echo "<table class='table table-striped'>";
        echo "<thead><tr><th>Name</th><th>School</th><th>Division</th><th>Delete</th><th>Password</th></tr></thead><tbody>";

        while ($rows = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$rows['Name']}</td>";
            echo "<td>{$rows['School']}</td>";
            echo "<td>{$rows['Division']}</td>";
            echo "<td>";
            echo "<a href='javascript:void(0);' onclick='deleteprofRecord(" . $rows['ID'] . ");' class='red-button'>Delete</a></td>";
            echo "<td>";
            echo "<a href='javascript:void(0);' onclick='updateprofRecord(" . $rows['ID'] . ");' class='blue-button'>Set Default Password</a></td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
    } else {
        echo '<div class="todo-item">';
        echo '<h2>There is no result found</h2>';
        echo '</div>';
    }
} else {
    echo '<div class="todo-item">';
    echo '<h2>There is no result found</h2>';
    echo '</div>';
}

?>
