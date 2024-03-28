<?php 
// Validation of Data
if (isset($_POST['email'])) {
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
    $program = validate($_POST['program']);
    $section = validate($_POST['section']);
    $contact = validate($_POST['contact']);
    $supervisor = validate($_POST['supervisor']);
 

    
  
       // Recording the Student Credentials 
       $sql = "INSERT INTO student(Username, Password, Name, Program, Section, Supervisor, Contact, Total, Coordinator, School, Resource, Division, Grade, Profile, EvalID) 
               VALUES('$email', '123456789', '$name', '$program', '$section', '$supervisor', '$contact', '', '', '', '', '', '','','')";
       $result = mysqli_query($conn, $sql);
	
       if ($result) {
               
               header("Location: superviui.php");
         
        
     }else {
        header("Location: superviui.php");
     }
}