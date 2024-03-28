<?php

include "db_conn.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  
    $id = $_POST['id'];
  
    // Checking Student ID
    $check = "SELECT * FROM teacher WHERE ID = $id";
    $checkres = mysqli_query($conn, $check);
    $checkrows = mysqli_fetch_assoc($checkres);

    $studentid = $checkrows['Student'];

    $stud = "SELECT * FROM student WHERE ID = $studentid";
    $studres = mysqli_query($conn, $stud);
    $studrows = mysqli_num_rows($studres);

    if ($studrows > 0 ){
        $undeploy = "UPDATE student SET Coordinator ='', Resource ='', Grade='', School='', Division='' WHERE ID = $studentid";
        $result2 = mysqli_query($conn, $undeploy);
        
    }

         // Perform the deletion query
         $deleteQuery = "DELETE FROM teacher WHERE ID = $id";
         $deleteres = mysqli_query($conn, $deleteQuery);

        
        
if ($deleteres) {
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
        echo "<div class='alert alert-success' role='alert'>Successfully Deleted<div>";
    } else {
        echo "<p>No records found for the search term '{$searchprofTerm}'</p>";
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>