<?php
// Validation of Data
if(isset($_GET['ID'])){
   include "db_conn.php";
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}
   
   // Getting ID of Student to Return Data 
	$id = validate($_GET['ID']);
    $SQL2 = "SELECT * FROM dtr WHERE ID = $id";
    $RS2 = mysqli_query($conn, $SQL2);
    if(!$RS2)
    {
     die(mysqli_error($conn));
    }
    if (mysqli_num_rows($RS2) > 0) {
    $FRS2 = mysqli_fetch_array($RS2);
    }
    $accid = $FRS2['AccID'];

   // SQL querry for Delete
    $sql4 = "UPDATE dtr
             SET Status = 'Approved'
             WHERE ID = $id";
    $result4 = mysqli_query($conn, $sql4);

   // Checking the SQL querry if it fail or suceeded
   if ($result4) {
   	  header("Location: approval.php?AccID=$accid&success=DTR Successfully Approved");
   }else {
      header("Location: approval.php?AccID=$accid&error=Unknown error occurred");
   }

}else {
	header("Location: listeval.php?AccID=$accid");
}