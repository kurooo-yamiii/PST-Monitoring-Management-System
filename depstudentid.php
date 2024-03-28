<?php

include "db_conn.php";

if (isset($_POST['SupID'], $_POST['DepID'])) {

    $sup = validate($_POST['SupID']);
    $dep = validate($_POST['DepID']);

    // Use prepared statements to prevent SQL injection
    $updateQuery = "UPDATE supervisor SET DepID = ? WHERE ID = ?";
    
    $stmt = mysqli_prepare($conn, $updateQuery);

    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "ii", $dep, $sup);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Query executed successfully
            echo "Update successful";
        } else {
            // Query execution failed
            echo "Update failed: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Statement preparation failed
        echo "Statement preparation failed: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}

// You might want to define your validate function if not already done
function validate($data) {
    // Implement your validation logic here
    return $data;
}
?>
