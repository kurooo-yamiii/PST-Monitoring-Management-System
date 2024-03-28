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
   
   // Getting the reference number for evaluation (Delete Method)
	$id = validate($_GET['ID']);
   $SQL2 = "SELECT * FROM evaluation WHERE ID = $id";
   $RS2 = mysqli_query($conn, $SQL2);
   if (mysqli_num_rows($RS2) > 0) {
      $rs2data = mysqli_fetch_array($RS2);
      }
   $StudID = $rs2data['StudentID'];

   // Retrieving User account ID to Display evaluation form
   $SQL3 = "SELECT * FROM student WHERE Student =$StudID";
   $RS3 = mysqli_query($conn, $SQL3);
   if (mysqli_num_rows($RS3) > 0) {
      $rs2data = mysqli_fetch_array($RS3);
      }
   $coop = $rs2data['ID'];

   // SQL querry for Delete
	$sql = "DELETE FROM evaluation
	        WHERE ID=$id";
   $result = mysqli_query($conn, $sql);

   // Checking the SQL querry if it fail or suceeded
   if ($result) {
   	  header("Location: listeval.php?AccID=$coop&success=Sucessfully Deleted");
   }else {
      header("Location: listeval.php?AccID=$coop&error=Unknown error occurred");
   }

}else {
	header("Location: listeval.php?AccID=$coop");
}