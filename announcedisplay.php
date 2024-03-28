<?php
// Validation of Data
if (isset($_POST['SupID'])) {
    include "db_conn.php";
    include 'db_pdo.php';

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Assigning values to Variables
    date_default_timezone_set('Asia/Manila');
    $date = date("M d, Y");
    $SuperID = validate($_POST['SupID']);
    $post = validate($_POST['post']);

    // Retrieving Name of Supervisor
    $sql3 = "SELECT * FROM supervisor WHERE ID = $SuperID ";
    $result3 = mysqli_query($conn, $sql3);

    // If Else statement for running SQL query
    if (!$result3) {
        die(mysqli_error($conn));
    }

    if (mysqli_num_rows($result3) > 0) {
        $SuperData = mysqli_fetch_assoc($result3);
    }

    $name = $SuperData['Name'];

    $new_img_name = ''; // Initialize new_img_name

    if (isset($_FILES['img'])) {
        // Image upload and filter image size and type
        $img_name = $_FILES['img']['name'];
        $img_size = $_FILES['img']['size'];
        $tmp_name = $_FILES['img']['tmp_name'];
        $error = $_FILES['img']['error'];

        // If there is no error
        if ($error === 0) {
            // Checking image size
            if ($img_size > 500000) {
                http_response_code(400);
                echo "Sorry, your file is too large.";
            } else {
                // Checking file type extension jpg png jpeg, etc.
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png");

                // Creating file path through the upload folder
                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                    $img_upload_path = 'upload/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
                } else {
                    http_response_code(400);
                    echo "You can't upload files of this type";
                }
            }
        } else if ($error === 4) {
           
        }
    }

    // Run Update SQL query to update student information
    $sql2 = "INSERT INTO announce (Date, Post, Picture, Author) VALUES ('$date', '$post', '$new_img_name', '$name')";
    $result2 = mysqli_query($conn, $sql2);

    // Checking results if it fails or succeeded
    if ($result2) {
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
            echo "Announcement is succesfuly posted";
            echo '</div>';
        
    } else {
        http_response_code(400);
        echo "Unknown error occurred. Please try again";
    }
} else {
    http_response_code(400);
    echo "Invalid request. SupID not set.";
}
?>
