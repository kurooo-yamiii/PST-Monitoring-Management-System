<?php 
// Validation of Data
if (isset($_POST['submit'])) {
	include "db_conn.php";
	function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}

    // Assigning values to Variables

    date_default_timezone_set('Asia/Manila');
    $date = date("M d, Y");
    $accid = validate($_GET['AccID']);
    $post = validate($_POST['post']);

     // Retrieving Name of Supervisor
     $SuperID = $_GET['AccID'];
     $sql3 = "SELECT * FROM supervisor WHERE ID = $SuperID ";
     $result3 = mysqli_query($conn, $sql3);

     // If Else statement for running SQL query
     if(!$result3)
     {
      die(mysqli_error($conn));
     }
     if (mysqli_num_rows($result3) > 0) {
     $SuperData = mysqli_fetch_array($result3);
     }
     $name = $SuperData['Name'];


	if (isset($_FILES['img'])){
    // Image upload and filter image size and type

    $img_name = $_FILES['img']['name'];
	$img_size = $_FILES['img']['size'];
	$tmp_name = $_FILES['img']['tmp_name'];
	$error = $_FILES['img']['error'];

    // If there is error if else statement
    if ($error === 0) {
		// Checking image size
        if ($img_size > 500000) {
			$em = "Sorry, your file is too large.";
		    header("Location: announce.php?AccID=$accid&error=$em");
		}else {
            // Checking file type extension jpg png jpeg eg.
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

            // Creating file path through upload folder
			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = 'upload/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

			}else {
				$em = "You can't upload files of this type";
		        header("Location: announce.php?AccID=$accid&error=$em");
			}
		}
	}else {
		$em = "unknown error occurred!";
		header("Location: announce.php?AccID=$accid&error=$em");
	}
	}else{
		 // Checking input data from User
	if (empty($post)) {
		header("Location: announce.php?AccID=$accid&error=Name is required");
	}else {


       // Run Update SQL querry to update student information
       $sql2 = "INSERT INTO announce(Date, Post, Picture, Author) 
                VALUES('$date', '$post', '', '$name')";
       $result2 = mysqli_query($conn, $sql2);

       // Checking results if it fails or suceeded
       if ($result2) {
          $_SESSION['ID'] = $accid;
       	  header("Location: announce.php?AccID=$accid");
       }else {
          header("Location: announce.php?error=Unkown Error Occured Please Try again");
       }
	}
	}
    
    // Checking input data from User
	if (empty($post)) {
		header("Location: announce.php?AccID=$accid&error=Name is required");
	}else {

       // Run Update SQL querry to update student information
       $sql2 = "INSERT INTO announce (Date, Post, Picture, Author) 
       VALUES('$date', '$post', '$new_img_name', '$name')";
       $result2 = mysqli_query($conn, $sql2);
       // Checking results if it fails or suceeded
       if ($result2) {
          $_SESSION['ID'] = $accid;
       	  header("Location: announce.php?AccID=$accid");
       }else {
          header("Location: announce.php?AccID=$accid&error=Unkown Error Occured Please Try again");
       }
	}

}