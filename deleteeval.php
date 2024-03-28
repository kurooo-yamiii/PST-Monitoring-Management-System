<?php

include "db_conn.php";
include "db_pdo.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  
    $id = $_POST['id'];
    $StudID = $_POST['stud'];
  
    // Approve Student DTR
    $check = "DELETE FROM evaluation WHERE ID = $id";
    $checkres = mysqli_query($conn, $check);

        
if ($checkres) {
    
 
    echo '<div class="alert alert-success" role="alert">';
    echo '<p>PST Evaluation Deleted Successfully</p>';
    echo '</div>';

    $evals = $ponn->query("SELECT * FROM evaluation WHERE StudentID = $StudID");
    
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
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>