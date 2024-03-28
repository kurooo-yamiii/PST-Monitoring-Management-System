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

   $email = validate($_GET['email']);
   $name = validate($_GET['name']);
   $section = validate($_GET['section']);
   $program = validate($_GET['program']);
   $contact = validate($_GET['contact']);
   $password = validate($_GET['password']);

   // SQL querry for Updating student account
	$sql = "UPDATE student
	        SET Username = '$email', Password = '$password', Program = '$program', Section = '$section', Contact = '$contact', Name = '$name'
            WHERE ID = $ID"; 
   $result = mysqli_query($conn, $sql);

   // Checking the SQL querry if it fail or suceeded
   if ($result) {
   	  header("Location: studadd.php?AccID=$ReturnID&success=Student account sucessfully Updated");
   }else {
      header("Location: studadd.php?AccID=$ReturnID&error=Unknown error occurred");
   }

}else {
	header("Location: studadd.php?AccID=$ReturnID");
}