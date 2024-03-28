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
   
   // Getting Time-In and Out of the Deleted DTR
	$id = validate($_GET['ID']);
    $SQL2 = "SELECT * FROM dtr WHERE ID = $id";
    $RS2 = mysqli_query($conn, $SQL2);
    if(!$RS2)
    {
     die(mysqli_error($conn));
    }
    if (mysqli_num_rows($RS2) > 0) {
    $FRS2 = mysqli_fetch_array($RS2);
    }
    $timein = $FRS2['TimeIn'];
    $timeout = $FRS2['TimeOut'];

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
        if(intval($overallmins) > 360){
            $overallmins = 360;
        }else{
        $totalMinutes = intval($timeoutminutes) - intval($timeinminutes);
        $overallmins = $totalMinutes;
        }
    }else
    {
        if(intval($overallmins) > 360){
            $overallmins = 360;
        }else{
        $totalMinutes = intval($timeinminutes) - intval($timeoutminutes);
        $overallmins = $totalMinutes;
        }
    }
    
    // Getting the existing Total Time of Working   
    $accid = $FRS2['AccID']; 
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
    $newtotal = intval($total) - intval($overallmins);
    

   // SQL querry for Delete
	$sql = "DELETE FROM dtr
	        WHERE ID=$id";
    $result = mysqli_query($conn, $sql);
    $sql4 = "UPDATE student
             SET Total = $newtotal
             WHERE ID = $accid";
    $result4 = mysqli_query($conn, $sql4);

   // Checking the SQL querry if it fail or suceeded
   if ($result && $result4) {
   	  header("Location: approval.php?AccID=$accid&success=Sucessfully Deleted");
   }else {
      header("Location: approval.php?AccID=$accid&error=Unknown error occurred");
   }

}else {
	header("Location: listeval.php?AccID=$accid");
}