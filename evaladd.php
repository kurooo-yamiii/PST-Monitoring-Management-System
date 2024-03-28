<?php 
// Validation of Data
if (isset($_POST['accid'])) {
	include "db_conn.php";
        include "db_pdo.php";
	function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}
        // Assigning Data to the Variables
	$date = validate($_POST['date']);
	$lesson = validate($_POST['lesson']);
        $accid = validate($_POST['accid']);
        $remarks = validate($_POST['remarks']);

    // Removing String from the Data securing the number value (1st set of Question)    
    preg_match('/\d+/', $_POST['a1'], $matches);
    $a1 = isset($matches[0]) ? intval($matches[0]) : 0;
    preg_match('/\d+/', $_POST['a2'], $matches);
    $a2 = isset($matches[0]) ? intval($matches[0]) : 0;
    preg_match('/\d+/', $_POST['a3'], $matches);
    $a3 = isset($matches[0]) ? intval($matches[0]) : 0;
    preg_match('/\d+/', $_POST['a4'], $matches);
    $a4 = isset($matches[0]) ? intval($matches[0]) : 0;
    preg_match('/\d+/', $_POST['a5'], $matches);
    $a5 = isset($matches[0]) ? intval($matches[0]) : 0;

    $at = ($a1 + $a2 + $a3 + $a4 + $a5) / 25 * 100; 

    // Removing String from the Data securing the number value (2nd set of Question)  
    preg_match('/\d+/', $_POST['b1'], $matches);
    $b1 = isset($matches[0]) ? intval($matches[0]) : 0;
    preg_match('/\d+/', $_POST['b2'], $matches);
    $b2 = isset($matches[0]) ? intval($matches[0]) : 0;
    preg_match('/\d+/', $_POST['b3'], $matches);
    $b3 = isset($matches[0]) ? intval($matches[0]) : 0;
    preg_match('/\d+/', $_POST['b4'], $matches);
    $b4 = isset($matches[0]) ? intval($matches[0]) : 0;
    preg_match('/\d+/', $_POST['b5'], $matches);
    $b5 = isset($matches[0]) ? intval($matches[0]) : 0;

    $bt = ($b1 + $b2 + $b3 + $b4 + $b5) / 25 * 100;

    // Removing String from the Data securing the number value (3rd set of Question)  
    preg_match('/\d+/', $_POST['c1'], $matches);
    $c1 = isset($matches[0]) ? intval($matches[0]) : 0;
    preg_match('/\d+/', $_POST['c2'], $matches);
    $c2 = isset($matches[0]) ? intval($matches[0]) : 0;
    preg_match('/\d+/', $_POST['c3'], $matches);
    $c3 = isset($matches[0]) ? intval($matches[0]) : 0;
    preg_match('/\d+/', $_POST['c4'], $matches);
    $c4 = isset($matches[0]) ? intval($matches[0]) : 0;
    preg_match('/\d+/', $_POST['c5'], $matches);
    $c5 = isset($matches[0]) ? intval($matches[0]) : 0;

    $ct = ($c1 + $c2 + $c3 + $c4 + $c5) / 25 * 100;

    // Removing String from the Data securing the number value (4th set of Question)  
    preg_match('/\d+/', $_POST['d1'], $matches);
    $d1 = isset($matches[0]) ? intval($matches[0]) : 0;
    preg_match('/\d+/', $_POST['d2'], $matches);
    $d2 = isset($matches[0]) ? intval($matches[0]) : 0;
    preg_match('/\d+/', $_POST['d3'], $matches);
    $d3 = isset($matches[0]) ? intval($matches[0]) : 0;
    preg_match('/\d+/', $_POST['d4'], $matches);
    $d4 = isset($matches[0]) ? intval($matches[0]) : 0;
    preg_match('/\d+/', $_POST['d5'], $matches);
    $d5 = isset($matches[0]) ? intval($matches[0]) : 0;

    // Total of 4 sets of question (Getting the Total Average to Display)
    $dt = ($d1 + $d2 + $d3 + $d4 + $d5) / 25 * 100;
    $average = ($at + $bt + $ct + $dt) / 4 .'%';

        // Checking the data value of User inserted
	if (empty($date)) {
		header("Location: evaluation.php?AccID=$accid&error=Date is required");
	}else if (empty($lesson)) {
		header("Location: evaluation.php?AccID=$accid&error=Lesson is required");
         }else {

        // SQL querry to record Pre-Service Teacher Evaluation Result
       $sql = "INSERT INTO evaluation(StudentID, Date, Lesson, a1, a2, a3, a4, a5, aT, b1, b2, b3, b4, b5, bT, c1, c2, c3, c4, c5, cT, d1, d2, d3, d4, d5, dT, Average, Remarks) 
               VALUES('$accid', '$date', '$lesson', '$a1', '$a2', '$a3', '$a4', '$a5', '$at', '$b1', '$b2', '$b3', '$b4', '$b5', '$bt','$c1', '$c2', '$c3', '$c4', '$c5', '$ct','$d1', '$d2', '$d3', '$d4', '$d5', '$dt', '$average', '$remarks')";
       $result = mysqli_query($conn, $sql);

       // Checking SQL querries results
       if ($result) {
          
    echo '<div class="alert alert-success" role="alert">';
    echo '<p>PST Evaluation Generated Successfully</p>';
    echo '</div>';

    $evals = $ponn->query("SELECT * FROM evaluation WHERE StudentID = '$accid'");
    
    echo '<div class="show-todo-section">';
    if ($evals->rowCount() <= 0) {
        echo '<div class="todo-item">';
        echo '<button class="removee-to-do" type="button">N/A</button>';
        echo '<h2>You haven\'t been evaluated by your Coordinating Teacher</h2>';
        echo '<br>';
        echo '<small>Note: Please coordinate with your coordinating teacher with regards to your evaluation</small>';
        echo '</div>';
    } else {
        while ($eval = $evals->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="todo-item">';
            echo '<button onclick="displayEval(' . $eval['ID'] . ')" class="removee-to-do" type="button">View</button>';
            echo '<h2>Lesson/Topic: ' . $eval['Lesson'] . '<span class="ave"> ' . $eval['Average'] . ' </span> </h2>';
            echo '<br>';
            echo '<small>Evaluated On: ' . $eval['Date'] . '</small>';
            echo '<a class="btn-save" type="button" onclick="deleteEvaluation(' . $eval['ID'] . ')">Delete</a>';
            echo '</div>';
        }
    }
    echo '</div>';
       }else {
        
        echo '<div class="alert alert-error" role="alert">';
        echo "<p>Unknown Error Occured</p>";
        echo '</div>';
       }
	}

}