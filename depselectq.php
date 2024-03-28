<?php
// Validation of Data
if (isset($_POST['StudID'], $_POST['profID'])){
    include "db_conn.php";

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Getting ID for both Student and Coordinating Teacher for Syncing, Return ID for supervisor interface

    $ProfID = validate($_POST['profID']);
    $StudID = validate($_POST['StudID']);

    // Fetching Information to Coordinating Teacher to fill some of the Student Information

    $stmt1 = $conn->prepare("SELECT * FROM teacher WHERE ID = ?");
    $stmt1->bind_param("i", $ProfID);
    $stmt1->execute();
    $result1 = $stmt1->get_result();

    if(!$result1){
        die(mysqli_error($conn));
    }

    if ($result1->num_rows > 0) {
        $profinfo = $result1->fetch_assoc();

        $resource = $profinfo['Name'];
        $coordinator = $profinfo['Coordinator'];
        $division = $profinfo['Division'];
        $grade = $profinfo['Grade'];
        $school = $profinfo['School'];

        // SQL query for Updating student account
        $stmt2 = $conn->prepare("UPDATE student SET Resource = ?, Coordinator = ?, Division = ?, Grade = ?, School = ? WHERE ID = ?");
        $stmt2->bind_param("sssssi", $resource, $coordinator, $division, $grade, $school, $StudID);
        $result2 = $stmt2->execute();

        // SQL query for Syncing Student and Coordinating Teacher
        $stmt3 = $conn->prepare("UPDATE teacher SET Student = ? WHERE ID = ?");
        $stmt3->bind_param("ii", $StudID, $ProfID);
        $result3 = $stmt3->execute();

        // Checking the SQL query if it failed or succeeded
        if ($result2 && $result3) {
            echo "Update successful";
        } else {
            echo "Update failed: " . $conn->error;
        }

        // Close the statements
        $stmt2->close();
        $stmt3->close();
    }

    // Close the database connection
    $conn->close();
}
?>
