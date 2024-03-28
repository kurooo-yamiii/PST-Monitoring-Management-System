<?php

include "db_conn.php";
include "db_pdo.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(($_POST['title'] != '') && ($_POST['date'] != '')){
    $id = $_POST['id'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    
    
    // Approve Student DTR
    $check = "INSERT INTO todolist(Title, Date, AccID, Checked) 
    VALUES('$title', '$date', '$id', 0)";
    $checkres = mysqli_query($conn, $check);

        
if ($checkres) {
    echo '<div class="alert alert-success" role="alert">';
    echo "<p>Posted Successfully</p>";
    echo '</div>';
    
 $todo = $ponn->query("SELECT * FROM todolist WHERE AccID = $id");
?>

<input type="hidden" name="StudID" id="StudID" value="<?php echo $id; ?>">

<?php if ($todo->rowCount() <= 0) { ?>
    <?php echo '<div class="todobox">
        <div class="rowtodo">
            <p class="titletodo">There is no assigned task</p>
            <p></p>
        </div>
    </div>'; ?>
<?php } ?>

<?php
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
    echo "<p>Please fill up the formation first</p>";
    echo '</div>';
}
} else {
    http_response_code(500);
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>