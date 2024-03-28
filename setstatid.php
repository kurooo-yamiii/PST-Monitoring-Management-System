<?php 
include "db_conn.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  
    $id = $_POST['id'];
    $sup = $_POST['sup'];
  
    // Checking Cooperating Teacher
    $check = "UPDATE supervisor SET StatID = '$id' WHERE ID = '$sup'";
    $checkres = mysqli_query($conn, $check);

}
?>