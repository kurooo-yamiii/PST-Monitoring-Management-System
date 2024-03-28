<?php
include "db_conn.php";
$evalID = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['evalID'])) {
       
        $evalID = $_POST['evalID'];

        $sql ="SELECT * FROM evaluation WHERE ID ='$evalID'";
        $result =  mysqli_query($conn, $sql);
        if(!$result)
        {
        die(mysqli_error($conn));
        }
        if (mysqli_num_rows($result) > 0) {
        $rowData = mysqli_fetch_array($result);
        }
        $StudID = $rowData['StudentID'];

        $sql4 = "UPDATE student
        SET EvalID = $evalID
        WHERE ID = $StudID";
        $result4 = mysqli_query($conn, $sql4);
    } else {
        echo "evalID not set in POST data";
    }
} else {
    echo "Form not submitted";
}

echo "Value of evalID in PHP: $evalID";
?>