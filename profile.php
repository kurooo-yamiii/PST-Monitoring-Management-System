<?php
// Getting the User ID Account
include 'db_conn.php';
if (isset($_GET['AccID']))  {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile.css">
    <title>Student Profile</title>
</head>
<body>
        <form action="profileedit.php?AccID=<?=$_GET['AccID']?>" method="post">

        <?php 
          $AccID = $_GET['AccID'];
          $sql2 = "SELECT * FROM student WHERE ID = $AccID AND Profile != ''";
          $res = mysqli_query($conn,  $sql2);
          $images = mysqli_fetch_assoc($res);
          if (mysqli_num_rows($res) > 0) { 
         ?>
               <img class="profile-image" src="upload/<?=$images['Profile']?>">
          		
        <?php }else{?>
            <img class="profile-image" src="resources/default.jpeg">
        <?php }?>
            <?php 
            // Fetch Student Information using ID 
			$AccID = $_GET['AccID'];
			$sql = "SELECT * FROM student WHERE ID = $AccID";
			$result = mysqli_query($conn, $sql);
			?>
		<?php if (mysqli_num_rows($result)) { ?>
            <?php 
                   // Expansion of Table Value as long as rows are Fetched
			  	   $i = 0;
			  	   while($rows = mysqli_fetch_assoc($result)){
			  	   $i++;
			  	 ?>
            <div class="form-set">
                <h2>I. Profile of the Student</h2>
                <table>
                <tr>
                    <th>Name:</th>
                    <td><?php echo $rows['Name']; ?></td>
                </tr>
                <tr>
                    <th>Section:</th>
                    <td><?php echo $rows['Section']; ?></td>
                </tr>
                <tr>
                    <th>Program:</th>
                    <td><?php echo $rows['Program']; ?></td>
                </tr>
                <tr>
                    <th>Contact:</th>
                    <td><?php echo $rows['Contact']; ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?php echo $rows['Username']; ?></td>
                </tr>
                </table>
            </div>

            <div class="form-set">
                <h2>II. Deployment Info</h2>
                <table>
                <tr>
                    <th>Supervisor:</th>
                    <td><?php echo $rows['Supervisor']; ?></td>
                </tr>
                <tr>
                    <th>Coordinator:</th>
                    <td><?php echo $rows['Coordinator']; ?></td>
                </tr>
                <tr>
                    <th>Resource Teacher:</th>
                    <td><?php echo $rows['Resource']; ?></td>
                </tr>
                <tr>
                    <th>Division:</th>
                    <td><?php echo $rows['Division']; ?></td>
                </tr>
                <tr>
                    <th>Grade Level:</th>
                    <td><?php echo $rows['Grade']; ?></td>
                </tr>
                </table>
            </div>
            <?php } ?>
            <?php } ?>

            <div class="button-container">
            <button type="submit">Edit</button>
            <a href="studentui.php" class="btn-primary">Back</a>
        </div>
          
        </form>

</body>
</html>
<?php
}else{
    header("Location studentui.php");
}
?>