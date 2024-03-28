<?php 
// Validation of Data
if (isset($_POST['create']) && isset($_GET['AccID'])) {
	include "db_conn.php";
	function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}

    // Assigning of Values to Variable
    $email = validate($_POST['email']);
	$name = validate($_POST['name']);
    $accid = validate($_GET['AccID']);

    
    
    // Checking if there are values that was inserted by the User
	if (empty($email)) {
		header("Location: supadd.php?AccID=$accid&error=Date is required");
	}else if (empty($name)) {
		header("Location: supadd.php?AccID=$accid&error=Date is required");
    }else {

       // Recording the Student Credentials 
       $sql = "INSERT INTO supervisor(Username, Password, Name) 
               VALUES('$email', '123456789', '$name')";
       $result = mysqli_query($conn, $sql);

       // Checking SQL results (Else catch Error Occured)
       if ($result) {
          $_SESSION['ID'] = $accid;
       	  header("Location: supmain.php?AccID=$accid&success=Supervisor Account Created Successfully");
       }else {
          header("Location: supmain.php?AccID=$accid&error=Unkown Error Occured Please Try again");
       }
	}

}