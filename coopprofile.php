<?php 
// Validation of Data
if (($_POST['name'] != '') && ($_POST['password'] != '') && ($_POST['grade'] != '') && ($_POST['school'] != '') && ($_POST['division'] != '') && ($_POST['coordinator'] != '')) {
    include "db_conn.php";
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Assigning values to Variables
    $accid = validate($_POST['accid']);
    $name = validate($_POST['name']);
    $password = validate($_POST['password']);
    $school = validate($_POST['school']);
    $division = validate($_POST['division']);
    $coordinator = validate($_POST['coordinator']);
    $grade = validate($_POST['grade']);

    $new_img_name = ""; // Initialize $new_img_name

    if (isset($_FILES['img'])){
        // Image upload and filter image size and type
        $img_name = $_FILES['img']['name'];
        $img_size = $_FILES['img']['size'];
        $tmp_name = $_FILES['img']['tmp_name'];
        $error = $_FILES['img']['error'];

        // If there is an error, use an if-else statement
        if ($error === 0) {
            // Checking image size
            if ($img_size > 500000) {
                http_response_code(500);
                echo '<div class="alert alert-error" role="alert">';
                echo "Sorry, the file is too large";
                echo '</div>';
               
            } else {
                // Checking file type extension jpg png jpeg eg.
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png"); 

                // Creating file path through the upload folder
                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = 'upload/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
                } else {
                    http_response_code(500);
                    echo '<div class="alert alert-error" role="alert">';
                    echo "You can't upload this type of file";
                    echo '</div>';
                  
                 
                }
            }
        } 
    }

    // Run Update SQL query to update student information
    $sql2 = "UPDATE teacher
            SET Name = '$name', Password = '$password', School = '$school', Coordinator = '$coordinator', Grade = '$grade', Division = '$division'";
    
    // Only add the Profile field if a new image is uploaded
    if (!empty($new_img_name)) {
        $sql2 .= ", Profile = '$new_img_name'";
    }
    
    $sql2 .= " WHERE ID = '$accid'";
    
    $result2 = mysqli_query($conn, $sql2);

    // Checking results if it fails or succeeded
    if ($result2) {
        
    } else {
        http_response_code(500);
        echo '<div class="alert alert-error" role="alert">';
        echo "Unknown error occure please try again";
        echo '</div>';
    }
} else {
    http_response_code(500);
    echo '<div class="alert alert-error" role="alert">';
    echo "Please fill up the missing information";
    echo '</div>';

}
?>