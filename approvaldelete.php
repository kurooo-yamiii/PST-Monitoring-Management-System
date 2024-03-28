<?php

include "db_conn.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  
    $id = $_POST['id'];
    $AccID = $_POST['stud'];
  
       // Getting the Total Time of Student
       $selectQuery = "SELECT * FROM student WHERE ID = $AccID";
       $selectResult = mysqli_query($conn, $selectQuery);
       $trow = mysqli_fetch_assoc($selectResult); 
       $oldminutes = $trow['Total'];  
   
       // Getting the Time Value of Deleted dtr
       $deldtr = "SELECT * FROM dtr WHERE ID = $id";
       $delrs = mysqli_query($conn, $deldtr);
       $drow = mysqli_fetch_assoc($delrs); 
       $delminutes = $drow['TotalHrs']; 

       // Remove non-numeric characters
        $numericString = preg_replace("/[^0-9]/", "", $delminutes);

        // Split the numeric string into an array
        $numericArray = str_split($numericString);

        // Extract hours and minutes
        $hours = isset($numericArray[0]) ? (int)$numericArray[0] : 0;
        $minutes = isset($numericArray[1]) ? (int)$numericArray[1] : 0;
        $totalMinutes = ($hours * 60) + $minutes;

        $newtotal = $oldminutes - $totalMinutes;

        $hours = floor($newtotal / 60);
		$minutes = intval($newtotal) % 60;

    // Update the Student Total Time to New Total
    $updatetot = "UPDATE student SET Total = $newtotal WHERE ID = $AccID";
    $updatetotrs = mysqli_query($conn, $updatetot);

    // Approve Student DTR
    $check = "DELETE FROM dtr WHERE ID = $id";
    $checkres = mysqli_query($conn, $check);

    if ($checkres && $updatetotrs) {
    
        // Retrieving user data from DTR table
        $sql = "SELECT * FROM dtr WHERE AccID = $AccID AND Status = 'Not Approved'";
        $result = mysqli_query($conn, $sql);
        
        echo '<div class="alert alert-success" role="alert">';
        echo '<p>PST Daily Time Record Deleted Successfully</p>';
        echo '</div>';
            
        // Display the record in Table
        if (mysqli_num_rows($result)) {
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th scope="col">Date</th>';
            echo '<th scope="col">Time In</th>';
            echo '<th scope="col">Time Out</th>';
            echo '<th scope="col">Total Hours</th>';
            echo '<th scope="col">Status</th>';
            echo '<th scope="col">Approval</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
        
            $i = 0;
            while ($rows = mysqli_fetch_assoc($result)) {
                $i++;
                echo '<tr>';
                echo '<td>' . $rows['Date'] . '</td>';
                echo '<td>' . $rows['TimeIn'] . '</td>';
                echo '<td>' . $rows['TimeOut'] . '</td>';
                echo '<td>' . $rows['TotalHrs'] . '</td>';
        
                // Color coding for the Status to make it Striking
                if ($rows['Status'] == "Not Approved") {
                    echo '<td style="color:red;">' . $rows['Status'] . '</td>';
                } else {
                    echo '<td style="color:green;">' . $rows['Status'] . '</td>';
                }
        
                echo '<td>';
                echo '<a onclick="approvalDelete(' . $rows['ID'] . ')" type="button" class="red-button">Delete</a>';
                echo '<a onclick="approvalUpdate(' . $rows['ID'] . ')" type="button" class="blue-button">Approve</a>';
                echo '</td>';
        
                echo '</tr>';
            }
        
            echo '</tbody>';
            echo '</table>';
        }else {
            // If no records found, display empty rows
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th scope="col">Date</th>';
            echo '<th scope="col">Time In</th>';
            echo '<th scope="col">Time Out</th>';
            echo '<th scope="col">Total Hours</th>';
            echo '<th scope="col">Status</th>';
            echo '<th scope="col">Approval</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
        
            for ($j = 0; $j < 3; $j++) {
                echo '<tr>';
                echo '<td> </td>';
                echo '<td> </td>';
                echo '<td> </td>';
                echo '<td> </td>';
                echo '<td> </td>';
                echo '<td> </td>';
                echo '</tr>';
            }
        
            echo '</tbody>';
            echo '</table>';
        }
        
    echo '<div class="space"></div>';
    echo '<div class="divider"></div>';
    
    echo '<div class="eval-studd">';
    echo '<h3>Recent Approved DTR</h3>';
    
    $sql2 = "SELECT * FROM dtr WHERE AccID = $AccID AND Status = 'Approved' ORDER BY ID DESC LIMIT 3";
    $result2 = mysqli_query($conn, $sql2);
    
    // Display the record in Table
    if (mysqli_num_rows($result2)) {
        echo '<table class="table table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Date</th>';
        echo '<th scope="col">Time In</th>';
        echo '<th scope="col">Time Out</th>';
        echo '<th scope="col">Total Hours</th>';
        echo '<th scope="col">Status</th>';
        echo '<th scope="col">Action</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
    
        // Continue adding rows depending on the Fetch Data
        $i = 0;
        while ($rows = mysqli_fetch_assoc($result2)) {
            $i++;
            echo '<tr>';
            echo '<td>' . $rows['Date'] . '</td>';
            echo '<td>' . $rows['TimeIn'] . '</td>';
            echo '<td>' . $rows['TimeOut'] . '</td>';
            echo '<td>' . $rows['TotalHrs'] . '</td>';
    
            // Color coding for the Status to make it Striking
            if ($rows['Status'] == "Not Approved") {
                echo '<td style="color:red;">' . $rows['Status'] . '</td>';
            } else {
                echo '<td style="color:green;">' . $rows['Status'] . '</td>';
            }
            echo '<td>';
            echo '<a onclick="approvalDelete(' . $rows['ID'] . ')" type="button" class="red-button">Delete</a>';
            echo '</td>';
            echo '</tr>';
            
        }
    
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Date</th>';
        echo '<th scope="col">Time In</th>';
        echo '<th scope="col">Time Out</th>';
        echo '<th scope="col">Total Hours</th>';
        echo '<th scope="col">Status</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
    
        // Dummy rows
        for ($j = 0; $j < 3; $j++) {
            echo '<tr>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '</tr>';
        }
    
        echo '</tbody>';
        echo '</table>';
    }
    
    echo '</div>';

    echo '<div class="space"></div>
      <div class="divider"></div>
      <h1 class="accumulated">Total accumulated time ' . $hours . ' hours and ' . $minutes . ' minutes</h1>';
    
        } 
        else {
            echo '<div class="alert alert-error" role="alert">';
            echo "<p>Unknown Error Occured</p>";
            echo '</div>';
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    ?>