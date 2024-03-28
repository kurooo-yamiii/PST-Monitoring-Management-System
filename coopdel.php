<?php  
// Validation of Data
if(isset($_GET['ID']) && isset($_GET['AccID'])){
   include "db_conn.php";
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}
   
   // Getting the reference number for student account (Delete Method)
   $ID = validate($_GET['ID']);
   $ReturnID = validate($_GET['AccID']);

   // SQL querry for Delete
	$sql = "DELETE FROM teacher
	        WHERE ID=$ID";
   $result = mysqli_query($conn, $sql);

   // Checking the SQL querry if it fail or suceeded
   if ($result) {
   	  header("Location: cooadd.php?AccID=$ReturnID&success=Cooperating teacher account sucessfully Deleted");
   }else {
      header("Location: cooadd.php?AccID=$ReturnID&error=Unknown error occurred");
   }

}else {
	header("Location: cooadd.php?AccID=$ReturnID");
}