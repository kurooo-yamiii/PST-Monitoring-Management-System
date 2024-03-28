<?php

include "db_conn.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  
    $id = $_POST['id'];
  
    // Checking Cooperating Teacher
    $check = "SELECT * FROM teacher WHERE Student = $id";
    $checkres = mysqli_query($conn, $check);
    $checkrows =mysqli_num_rows($checkres);

    if ($checkrows > 0 ){
        $undeploy = "UPDATE teacher SET Student ='' WHERE Student = $id";
        $result2 = mysqli_query($conn, $undeploy);
        
    }

         // Perform the deletion query
         $deleteQuery = "DELETE FROM student WHERE ID = $id";
         $deleteres = mysqli_query($conn, $deleteQuery);

        
        
if ($deleteres) {
        // Database Source for Student
        $sqlsearch = "SELECT * FROM student";
        $resultsearch = mysqli_query($conn, $sqlsearch);
    if (mysqli_num_rows($resultsearch)) {
        echo "<table class='table table-striped'>";
        echo "<thead><tr><th>Name</th><th>Program</th><th>Section</th><th>Delete</th><th>Password</th></tr></thead><tbody>";

        while ($rows = mysqli_fetch_assoc($resultsearch)) {
            echo "<tr>";
            echo "<td>{$rows['Name']}</td>";
            echo "<td>{$rows['Program']}</td>";
            echo "<td>{$rows['Section']}</td>";
            echo "<td>";
            echo "<a href='javascript:void(0);' onclick='deleteRecord(" . $rows['ID'] . ");' class='red-button'>Delete</a></td>";
            echo "<td>";
            echo "<a href='javascript:void(0);' onclick='updateRecord(" . $rows['ID'] . ");' class='blue-button'>Set Default Password</a></td>";
            echo "</tr>";
        
        }

        echo "</tbody></table>";
        echo "<div class='alert alert-success' role='alert'>Successfully Deleted<div>";
    } else {
        echo "<p>No records found for the search term '{$searchTerm}'</p>";
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>