<?php
// Getting User ID account
include 'db_conn.php';
include 'db_pdo.php';
if (isset($_GET['AccID']))  {
?>
<!DOCTYPE html>
<html>
<head>
	<title>PST Evaluation</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="document.css">
</head>
<body>
<?php
        // Fetching Resource Teacher Handled Student
        $AccID = $_GET['AccID'];
        $sql2 = "SELECT * FROM teacher WHERE ID = $AccID";
        $result2 = mysqli_query($conn, $sql2);
        if(!$result2)
        {
         die(mysqli_error($conn));
        }
        if (mysqli_num_rows($result2) > 0) {
        $rowData = mysqli_fetch_array($result2);
        }

		// Get ID value of Fetched Studenet Data
        $StudID = $rowData['Student'];
        $sql3 = "SELECT * FROM student WHERE ID = $StudID";
        $rs3 = mysqli_query($conn, $sql3);
        if(!$rs3)
        {
         die(mysqli_error($conn));
        }
        if (mysqli_num_rows($rs3) > 0) {
        $rs3row = mysqli_fetch_array($rs3);
        }
        ?>

<form action="evaluation.php?AccID=<?=$StudID?>" method="post">
           

			<p>List of Evaluation of <span>PST <?php echo $rs3row['Name'] ?></span> </p><br>
			
			<?php 
          $evals = $ponn->query("SELECT * FROM evaluation WHERE StudentID = $StudID");
       ?>
        <?php if($evals->rowCount() <= 0){ ?>
                    <div class="empty">
                    <img src="resources/tooltip.jpg" width="100%" >
                    <p>There is nothing here</p>
                    </div>
            <?php } ?>
       <div class="show-todo-section">
           
                

            <?php while($eval = $evals->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="todo-item">

				<a href="evaldel.php?ID=<?php echo $eval['ID']?>"
			      	     class="removee-to-do">Delete</a>
                        <h2>Lesson/Topic: <?php echo $eval['Lesson'] ?> <span class="ave"> <?php echo $eval['Average'] ?> </span> </h2>
                    <br>
                    <small>Evaluated On: <?php echo $eval['Date'] ?></small> 
                </div>
            <?php } ?>
		
            <div class="button-container">
            <button type="submit">Evaluate</button>
            <a href="coordinatorui.php" class="btn-primary">Back</a>
        </div>
	</form>
</body>
</html>
<?php
}else{
    header("Location studentui.php");
}
?>