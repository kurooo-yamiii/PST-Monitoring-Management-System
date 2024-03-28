<?php

include "db_conn.php";
include "db_pdo.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(($_POST['id'] != '')){
    $id = $_POST['id'];
    $delid = $_POST['delid'];

    
   
    // Approve Student DTR
    $check = "DELETE from todolist WHERE ID = $delid";
    $checkres = mysqli_query($conn, $check);

        
if ($checkres) {
    echo '<div class="alert alert-success" role="alert">';
    echo "<p>Post Deleted Successfully</p>";
    echo '</div>';
    
   $todo = $ponn->query("SELECT * FROM todolist WHERE AccID = $id");


  echo '<input type="hidden" name="StudID" id="StudID" value="' .   $id  . '">';

 if ($todo->rowCount() <= 0) { 
     echo '<div class="todobox">
        <div class="rowtodo">
            <p class="titletodo">There is no assigned task</p>
            <p></p>
        </div>
    </div>'; 
}


function hasDatePassed($dateString)
{
    $today = date('Y-m-d');
    $dueDate = date('Y-m-d', strtotime($dateString));

    // Compare the dates
    return $dueDate < $today;
}

while ($list = $todo->fetch(PDO::FETCH_ASSOC)) {
    $hasPassed = hasDatePassed($list['Date']);

    if ($list['Checked'] == 1) {
        echo '<div class="todobox">
            <div class="rowtodo">
                <p class="titletodo" style="text-decoration: line-through;">' . $list['Title'] . '</p>
                <p class="datetodo">' . $list['Date'] . '</p>
            </div>
            <p class="listtodobut2" style="color: green; padding: 9px 30px;">Complete</p>
        </div>';
    } elseif ($hasPassed) {
        echo '<div class="todobox">
            <div class="rowtodo">
                <p class="titletodo" style="text-decoration: line-through;">' . $list['Title'] . '</p>
                <p class="datetodo">' . $list['Date'] . '</p>
            </div>
            <p class="listtodobut2" id="missing" style="color: red; padding: 9px 30px; margin-right: 1%;">Missed</p>
        </div>';
    } else {
        echo '<div class="todobox">
            <div class="rowtodo">
                <p class="titletodo">' . $list['Title'] . '</p>
                <p class="datetodo">' . $list['Date'] . '</p>
            </div>
            <button class="listtodobut" type="button" onclick="deletetodo(' . $list['ID'] . ')">Delete</button>
        </div>';
    }
}

    
    

    }else {
        http_response_code(500);
        echo '<div class="alert alert-error" role="alert">';
        echo "<p>Unknown Error Occured</p>";
        echo '</div>';
    }
}else{
    http_response_code(500);
    echo '<div class="alert alert-error" role="alert">';
    echo "<p>Unknown Error Occured</p>";
    echo '</div>';
}
} else {
    http_response_code(500);
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>