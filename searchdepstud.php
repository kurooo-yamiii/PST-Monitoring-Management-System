<?php

include "db_conn.php";
include 'db_pdo.php';
	
$depstudent = mysqli_real_escape_string($conn, $_POST["search"]);
$studlist = $ponn->query("SELECT * FROM student WHERE Resource = '' AND (Name LIKE '%$depstudent%' OR Section LIKE '%$depstudent%' OR Program LIKE '%$depstudent%')");
// Your SQL query to search in your table


if ($studlist) {
    if ($studlist->rowCount() > 0) {
        while ($studdep = $studlist->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="todo-item">';
            echo '<input type="hidden" name="evalID" value="' . $studdep['ID'] . '">';
            echo '<button onclick="deploymentID(' . htmlspecialchars($studdep['ID'], ENT_QUOTES, 'UTF-8') . ')" class="removee-to-do" type="button">Deploy</button>';
            echo '<h2>' . $studdep['Name'] . '<span class="ave">' . $studdep['Program'] . '</span></h2>';
            echo '<br>';
            echo '<small>' . $studdep['Section'] . '</small>';
            echo '<small>Supervisor: ' . $studdep['Supervisor'] . '</small>';
            echo '</div>';
        }
    } else {
        echo '<div class="todo-item">';
        echo '<h2>There is no result found</h2>';
        echo '</div>';
    }
} else {
    echo '<div class="todo-item">';
    echo '<h2>There is no result found</h2>';
    echo '</div>';
}

?>