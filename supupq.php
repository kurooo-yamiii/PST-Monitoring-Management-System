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

   // Fetching New Input of User

   $email = validate($_POST['email']);
   $name = validate($_POST['name']);
   $password = validate($_POST['password']);

   // SQL querry for Updating student account
	$sql = "UPDATE supervisor
	        SET Username = '$email', Password = '$password', Name = '$name'
            WHERE ID = $ID"; 
   $result = mysqli_query($conn, $sql);

   // Checking the SQL querry if it fail or suceeded
   if ($result) {
   	  header("Location: supmain.php?AccID=$ReturnID&success=Supervisor account sucessfully Updated");
   }else {
      header("Location: supmain.php?AccID=$ReturnID&error=Unknown error occurred");
   }

}else {
	header("Location: supmain.php?AccID=$ReturnID");
}