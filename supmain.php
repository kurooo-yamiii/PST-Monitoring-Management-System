<?php
// Getting the Account ID of user
include 'db_conn.php';
if (isset($_GET['AccID']))  {
$AccID = $_GET['AccID'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Supervisor Account</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="record.css">
</head>
<body>
<form action="supadd.php?AccID=<?=$_GET['AccID']?>" method="post">
            <?php
			// Retrieving total number of Student Account
            $sql2 = "SELECT * FROM supervisor";
			$result2 = mysqli_query($conn, $sql2);
            $rowCount = mysqli_num_rows($result2)
			?>

			<p>Supervisor Account</p><br>
			<p class="accumulated">Supervisor has a total of <?php echo $rowCount?> accounts created</p>
			<?php 
			// Display wether the DTR process succeeded or failed
			if (isset($_GET['success'])) { ?>
		    <div class="alert alert-success" role="alert">
			  <?php echo $_GET['success']; ?>
		    </div>
		    <?php } ?>
			<?php 
			// Retrieving user data from DTR table 
			$sql = "SELECT * FROM supervisor";
			$result = mysqli_query($conn, $sql);
			?>
			<?php 
			// Display the record in Table
			if (mysqli_num_rows($result)) { ?>
			<table class="table table-striped">
			  <thead>
			    <tr>
			     
			      <th scope="col">Name</th>
                  <th scope="col">Delete/Update</th>
				 
		
			    </tr>
			  </thead>
			  <tbody>
			  <?php 
			  // Continue adding rows depening to the Fetch Data
			  	   $i = 0;
			  	   while($rows = mysqli_fetch_assoc($result)){
			  	   $i++;
			  	 ?>
			    <tr>
			     
			      <td><?php echo $rows['Name']; ?></td>
                  <td><a href="supdel.php?ID=<?=$rows['ID']?>&AccID=<?php echo $_GET['AccID']; ?>" 
			      	     class="red-button">Delete</a>
                           <a href="supup.php?ID=<?=$rows['ID']?>&AccID=<?php echo $_GET['AccID']; ?>" 
			      	     class="blue-button">Update</a>
                    </td>
			    </tr>
			    <?php } ?>
			  </tbody>
			  <?php } ?>
			</table>
		
            <div class="button-container">
            <button type="submit">Add Supervisor</button>
            <a href="account.php?AccID=<?php echo $AccID ?>" class="btn-primary">Back</a>
        </div>
	</form>
</body>
</html>
<?php
}else{
    header("Location supervisorui.php");
}
?>