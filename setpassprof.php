<?php

include "db_conn.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  
    $id = $_POST['id'];
  
    // Checking Cooperating Teacher
    $check = "UPDATE teacher SET Password = 12345678 WHERE ID = $id";
    $checkres = mysqli_query($conn, $check);

        
if ($checkres) {
        // Database Source for Student
        $sqlsearch = "SELECT * FROM teacher";
        $resultsearch = mysqli_query($conn, $sqlsearch);
    if (mysqli_num_rows($resultsearch)) {
        echo "<table class='table table-striped'>";
        echo "<thead><tr><th>Name</th><th>School</th><th>Division</th><th>Delete</th><th>Password</th></tr></thead><tbody>";

        while ($rows = mysqli_fetch_assoc($resultsearch)) {
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
        echo "<div class='alert alert-success' role='alert'>Password Set to Default<div>";
    } else {
        echo "<p>No records found for the search term '{$searchprofTerm}'</p>";
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>