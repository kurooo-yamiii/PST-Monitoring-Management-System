<?php
include "db_conn.php";
include 'db_pdo.php';

$depteach = mysqli_real_escape_string($conn, $_POST["search"]);
$proflist = $ponn->query("SELECT * FROM teacher WHERE Student = '' AND (Name LIKE '%$depteach%' OR School LIKE '%$depteach%' OR Division LIKE '%$depteach%')");

if ($proflist) {
    if ($proflist->rowCount() > 0) {
        while ($profdep = $proflist->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="todo-item">';
            echo '<input type="hidden" name="evalID" value="' . $profdep['ID'] . '">';
            echo '<button onclick="deployTwoID(' . htmlspecialchars($profdep['ID'], ENT_QUOTES, 'UTF-8') . ')" class="removee-to-do" type="button">Deploy</button>';
            echo '<h2>' . $profdep['Name'] . '<span class="ave" id="yellow">' . $profdep['School'] . '</span></h2>';
            echo '<br>';
            echo '<small>' . $profdep['Division'] . '</small>';
            echo '<small>Coordinator: ' . $profdep['Coordinator'] . '</small>';
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
