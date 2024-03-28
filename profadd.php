<?php 
// Validation of Data
if (isset($_POST['email']))  {
	include "db_conn.php";
	function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}

    // Assigning of Values to Variable
    $email = validate($_POST['email']) . "@rtu.ced.com";
    $name = validate($_POST['name']);
    $school = validate($_POST['school']);
    $division = validate($_POST['division']);
    $grade = validate($_POST['grade']);
    $coordinator = validate($_POST['coordinator']);
   

       // Recording the Student Credentials 
       $sql = "INSERT INTO teacher(Username, Password, Name, Student, School, Division, Grade, Coordinator, Profile) 
               VALUES('$email', '123456789', '$name', '', '$school', '$division', '$grade', '$coordinator','')";
       $result = mysqli_query($conn, $sql);

       // Checking SQL results (Else catch Error Occured)
       if ($result) {
       
       	  header("Location: superviui.php");
       }else {
        echo "Error: " . mysqli_error($conn);
       }
	}

