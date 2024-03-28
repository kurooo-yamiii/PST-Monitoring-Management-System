<?php 
session_start(); 
include "db_conn.php";

// Validation of Data
if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	// Checking Username and Password Container
	if (empty($uname)) {
		header("Location: index.php?error=Username is required");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{

		// SQL Fetch for the Pre-Service Teacher
		$sql = "SELECT * FROM student WHERE Username='$uname' AND Password='$pass'";
		$result = mysqli_query($conn, $sql);

			// SQL Fetch for the Resource Teacher
			$sql2 = "SELECT * FROM teacher WHERE Username='$uname' AND Password='$pass'";
			$result2 = mysqli_query($conn, $sql2);

				// SQL Fetch for the Supervisor
				$sql3 = "SELECT * FROM supervisor WHERE Username='$uname' AND Password='$pass'";
				$result3 = mysqli_query($conn, $sql3);
		
	    // Checking for Student Account Match (Else Statement Return Incorrect Password and Username)
		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['Username'] === $uname && $row['Password'] === $pass) {
            	
				$_SESSION['Username'] = $row['Username'];
            	$_SESSION['Name'] = $row['Name'];
            	$_SESSION['Password'] = $row['Password'];
				$_SESSION['ID'] = $row['ID'];
            	header("Location: studentui.php");
		        exit();}
			
			else{
					header("Location: index.php?error=Incorect Username or Password");
					exit();
				}
            }
		
		// Checking for Resource Teacher Account Match (Else Statement Return Incorrect Password and Username)
		elseif (mysqli_num_rows($result2) === 1) {
			$row = mysqli_fetch_assoc($result2);
            if ($row['Username'] === $uname && $row['Password'] === $pass) {
            	
				$_SESSION['Username'] = $row['Username'];
            	$_SESSION['Name'] = $row['Name'];
            	$_SESSION['Password'] = $row['Password'];
				$_SESSION['ID'] = $row['ID'];
            	header("Location: coordinatorui.php");
		        exit();}
			
			else{
					header("Location: index.php?error=Incorect Username or Password");
					exit();
				}
            }

		// Checking for Supervisor Account Match (Else Statement Return Incorrect Password and Username)
		elseif (mysqli_num_rows($result3) === 1) {
			$row = mysqli_fetch_assoc($result3);
			if ($row['Username'] === $uname && $row['Password'] === $pass) {
					
					$_SESSION['Username'] = $row['Username'];
					$_SESSION['Name'] = $row['Name'];
					$_SESSION['Password'] = $row['Password'];
					$_SESSION['ID'] = $row['ID'];
					header("Location: superviui.php");
					
					exit();}
				
			else{
						header("Location: index.php?error=Incorect Username or Password");
						exit();
				}
			}
	else{
			header("Location: index.php?error=Incorect Username or Password");
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}