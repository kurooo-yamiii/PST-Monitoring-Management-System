<?php
// Getting the User Account ID
include 'db_conn.php';
include 'db_pdo.php';
if (isset($_GET['AccID']))  {
?>
<!DOCTYPE html>
<html>
<head>
	<title>PST Deployment</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="deployment.css">
</head>
<body>

<form action="supervisorui.php" method="post">
<?php
			// Retrieving total number of Student Account
            $sql2 = "SELECT * FROM student WHERE Resource != ''";
			$result2 = mysqli_query($conn, $sql2);
            $rowCount = mysqli_num_rows($result2)
			?>

			<p>Pre-Service Teacher <span>Deployment</span> </p><br>
			<p class="accumulated">Total of <?php echo $rowCount ?> pre-service teacher was deployed</p>
            <?php
            if (isset($_GET['success'])) { ?>
		    <div class="alert alert-success" role="alert">
			  <?php echo $_GET['success']; ?>
		    </div>
		    <?php } ?>

            <?php
            // Fetching Student that is not yet Deployed or Does not have a Coordinating Teacher 
          $evals = $ponn->query("SELECT * FROM student WHERE Resource = ''");
       ?>
        <?php if($evals->rowCount() <= 0){ ?>
                    <div class="empty">
                    <img src="resources/tooltip.jpg" width="100%" >
                    <p>All of the student has been Deployed</p>
                    </div>
            <?php } ?>
       <div class="show-todo-section">
           
                

            <?php while($eval = $evals->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="todo-item">

				<a href="depselect.php?ID=<?php echo $eval['ID']?>&AccID=<?php echo $_GET['AccID'] ?>"
			      	     class="remove-to-do">Deploy</a>

                         
                    <h2><?php echo $eval['Name'] ?> <span class="ave"> <?php echo $eval['Program'] ?> </span> </h2>
                    <br>
                    <small><?php echo $eval['Section'] ?></small> 
                    <small>Supervisor: <?php echo $eval['Supervisor'] ?></small> 
                </div>
            <?php } ?>
			<div class="button-container">
			<button type="submit">Back</button>
			</div>
	</form>
</body>
</html>
<?php
}else{
    header("Location studentui.php");
}
?>