<?php 
// Validation of Data
if (isset($_POST['timein'])) {
	include "db_conn.php";
	function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}
    // Converting the Data to Hour and Minutes Format
    $timeinvalue = $_POST['timein'];
    $timeoutvalue = $_POST['timeout'];
    $date = validate($_POST['date']);
    if($timeinvalue == '')
    {
        http_response_code(500);
        echo '<div class="alert alert-error" role="alert">';
        echo "Please fill out the Timein form";
        echo '</div>';
    }
    else if($timeoutvalue == '')
    {
        http_response_code(500);
        echo '<div class="alert alert-error" role="alert">';
        echo "Please fill out the Timeout form";
        echo '</div>';
    }
    else if($date == '')
    {
        http_response_code(500);
        echo '<div class="alert alert-error" role="alert">';
        echo "Please fill out the Date form";
        echo '</div>';
    }
    else{
    $timeinobject = new DateTime($timeinvalue);
    $formattedtimein = $timeinobject->format('h:i A');
    $timeoutobject = new DateTime($timeoutvalue);
    $formattedtimeout = $timeoutobject->format('h:i A');

    // Assigning of Values to Variable

	$timein = validate($_POST['timein']);
    $timeout = validate($_POST['timeout']);
    $accid = validate($_POST['accid']);
   

    // Function for converting Time In into Minutes
	function convertTimeInToMinutes($timein) {
  
        list($hours, $minutes) = explode(':', $timein);
    
    
        $am_pm = substr($minutes, -2);
    
     
        if ($am_pm == 'PM' && $hours != 12) {
            $hours += 12;
        }
    
     
        $total_minutes = ($hours * 60) + (int)$minutes;
    
        return $total_minutes;
    }
    
    $timeinminutes = convertTimeInToMinutes($timein);

    
    // Function for converting Time Out into Minutes
    function convertTimeOutToMinutes($timeout) {
  
        list($hours, $minutes) = explode(':', $timeout);
    
    
        $am_pm = substr($minutes, -2);
    
     
        if ($am_pm == 'PM' && $hours != 12) {
            $hours += 12;
        }
    
     
        $total_minutes = ($hours * 60) + (int)$minutes;
    
        return $total_minutes;
    }
    
    $timeoutminutes = convertTimeOutToMinutes($timeout);

    
    // Function for converting overall Hours
    function convertMinutesToHours($totalMinutes) {
      
        $finalhours = floor($totalMinutes / 60);

        // If the total hours excess or equal to 6 (Maximum Hours should be 6 hours)
        if($finalhours >= 6){
            $finalhours = 6;
            $remainingMinutes = 00;
        
            return [$finalhours, $remainingMinutes];
        }else{
            $remainingMinutes = $totalMinutes % 60;
        
            return [$finalhours, $remainingMinutes];
        }
        
    }

    // Estimation of time in minutes and time out minutes
    if(intval($timeoutminutes) > intval($timeinminutes)){
       
        $totalMinutes = intval($timeoutminutes) - intval($timeinminutes);
        $overallmins = $totalMinutes;
        
    }else
    {
        
        $totalMinutes = intval($timeinminutes) - intval($timeoutminutes);
        $overallmins = $totalMinutes;
        
    }
    if(intval($overallmins) > 360){
        $overallmins = 360;
        $overallmins = $totalMinutes;
    }
    
    // Combining total hours and minutes to String 
    list($finalhours, $remainingMinutes) = convertMinutesToHours($totalMinutes);
    $totalhrs = "$finalhours hours and $remainingMinutes minutes.";

    // Getting the existing Total Time of Working    
    $sql3 = "SELECT Total FROM student WHERE ID = $accid";
    $result3 =  mysqli_query($conn, $sql3);
    if(!$result3)
    {
     die(mysqli_error($conn));
    }
    if (mysqli_num_rows($result3) > 0) {
    $rowData = mysqli_fetch_array($result3);
    }

    // Checking if the Total has Value (Else it will add the new time to existing time)
    $total = $rowData['Total'];
    if($total == ""){
        $newtotal = $overallmins;
    }else{
        $newtotal = intval($total) + intval($overallmins);
    }
    
    // Checking if there are values that was inserted by the User
	if ($date == '') {
        http_response_code(500);
        echo '<div class="alert alert-error" role="alert">';
        echo "Please fill out the Date form";
        echo '</div>';
	}else if ($timein == '') {
        http_response_code(500);
        echo '<div class="alert alert-error" role="alert">';
        echo "Please fill out the Timein form";
        echo '</div>';
    }else if ($timeout == '') {
        http_response_code(500);
        echo '<div class="alert alert-error" role="alert">';
        echo "Please fill out the Timeout form";
        echo '</div>';
	}else {

       // Recording the Date and Time Record of Pre-Service Teacher 
       $sql = "INSERT INTO dtr(AccID, Date, TimeIn, TimeOut, TotalHrs, Status) 
               VALUES('$accid', '$date', '$formattedtimein', '$formattedtimeout', '$totalhrs', 'Not Approved')";
       $result = mysqli_query($conn, $sql);

       // Updating the total value of working time
       $sql2 = "UPDATE student
                SET Total = '$newtotal' 
                WHERE ID = '$accid'";
       $result2 = mysqli_query($conn, $sql2);

       // Checking of two SQL results (Else catch Error Occured)
       if ($result && $result2) {
          $_SESSION['ID'] = $accid;
       	  
          
       }else {
        http_response_code(500);
        echo '<div class="alert alert-error" role="alert">';
        echo "Unknown error occured please try again";
        echo '</div>';
       }
	}
}
}

