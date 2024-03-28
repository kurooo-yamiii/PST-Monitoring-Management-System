<?php
// Getting the User Account ID
include 'db_conn.php';
include 'db_pdo.php';
if (isset($_GET['AccID']) && isset($_GET['ID']))  {
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

<form action="deployment.php?AccID=<?php echo $_GET['AccID']?>" method="post">
<?php
			// Retrieving total number of Student Account
            $sql2 = "SELECT * FROM student WHERE Resource != ''";
			$result2 = mysqli_query($conn, $sql2);
            $rowCount = mysqli_num_rows($result2)
			?>

			<p>Cooperating Teacher <span>Deployment</span> </p><br>
			<p class="accumulated">Total of <?php echo $rowCount ?> pre-service teacher was deployed</p>
            <?php
            // Fetching Cooperating Teacher that was not assigned yet
          $evals = $ponn->query("SELECT * FROM teacher WHERE Student = ''");
       ?>
        <?php if($evals->rowCount() <= 0){ ?>
                    <div class="empty">
                    <img src="resources/tooltip.jpg" width="100%" >
                    <p>All of the Cooperating Teacher has been selected</p>
                    </div>
            <?php } ?>
       <div class="show-todo-section">
           
                

            <?php while($eval = $evals->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="todo-item">

				<a href="depselectq.php?ProfID=<?php echo $eval['ID']?>&ReturnID=<?php echo $_GET['AccID']?>&StudID=<?php echo $_GET['ID']?>"
			      	     class="remove-to-do">Select</a>

                         
                    <h2><?php echo $eval['Name'] ?> <span class="ave2"> <?php echo $eval['School'] ?> </span> </h2>
                    <br>
                    <small><?php echo $eval['Division'] ?> Department</small> 
                    <small>Coordinator: <?php echo $eval['Coordinator'] ?></small> 
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