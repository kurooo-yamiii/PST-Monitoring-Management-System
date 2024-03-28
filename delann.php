<?php

if (isset($_POST['id'])) {

include "db_conn.php";
include 'db_pdo.php';
	
$announceid = mysqli_real_escape_string($conn, $_POST["id"]);
$announcedel = ("DELETE FROM announce WHERE ID = '$announceid'");
$announcedelq = mysqli_query($conn, $announcedel);



if ($announcedelq) {
    $posts = $ponn->query("SELECT * FROM announce");

    while ($post = $posts->fetch(PDO::FETCH_ASSOC)) :
        echo '<div class="todo-item">';
        echo '<a  onclick="deleteAnnounce('. htmlspecialchars($post['ID'], ENT_QUOTES, 'UTF-8') .')" class="date-pin">' . $post['Date'] . '</a> <br>';

        if ($post['Picture'] == '') {
            echo '<h2>' . $post['Post'] . '</h2>';
            echo '<br>';
            echo '<small>- ' . $post['Author'] . '</small>';
        } else {
            echo '<div class="empty">';
            echo '<div class="pic-announce"><img src="upload/' . $post['Picture'] . '"></div>';
            echo '<div class="pic-description">';
            echo '<h2>' . $post['Post'] . '</h2>';
            echo '<br>';
            echo '<small>- ' . $post['Author'] . '</small>';
            echo '</div>';
            echo '</div>';
        }

        echo '</div>';
        
    endwhile;
        echo '<div class="space"></div>';
        echo '<div class="alert alert-success" role="alert">';
        echo "Announcement is succesfuly Deleted";
        echo '</div>';
    
} else {
    http_response_code(400);
    echo "Unknown error occurred. Please try again";
}
}else {
    http_response_code(400);
    echo "Invalid request. SupID not set.";
}
?>