<?php
// Getting the Account ID of user
include 'db_conn.php';
if (isset($_GET['AccID']))  {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Daily Time Record</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="record.css">
</head>
<body>
<form action="adddtr.php?AccID=<?=$_GET['AccID']?>" method="post">
            <?php
			// Retrieving Data from the User Account
            $AccID = $_GET['AccID'];
            $sql2 = "SELECT * FROM student WHERE ID = $AccID";
			$result2 = mysqli_query($conn, $sql2);

			// If Else statement for running SQL query
            if(!$result2)
            {
             die(mysqli_error($conn));
            }
            if (mysqli_num_rows($result2) > 0) {
            $rowData = mysqli_fetch_array($result2);
            }
			
			// Display User Total Hours and Minutes
			$total = $rowData['Total'];
			if($total == ""){
				$hours = 0;
				$minutes = 0;
			}else{$hours = floor($total / 60);
				$minutes = intval($total) % 60;}
			
            ?>

			<p>Daily Time Record of <span>PST <?php echo $rowData['Name'] ?></span> </p><br>
			<p class="accumulated">Total accumulated time <?php echo $hours?> hours and <?php echo $minutes?> minutes</p>
			<?php 
			// Display wether the DTR process succeeded or failed
			if (isset($_GET['success'])) { ?>
		    <div class="alert alert-success" role="alert">
			  <?php echo $_GET['success']; ?>
		    </div>
		    <?php } ?>
			<?php 
			// Retrieving user data from DTR table 
			$AccID = $_GET['AccID'];
			$sql = "SELECT * FROM dtr WHERE AccID = $AccID";
			$result = mysqli_query($conn, $sql);
			?>
			<?php 
			// Display the record in Table
			if (mysqli_num_rows($result)) { ?>
			<table class="table table-striped">
			  <thead>
			    <tr>
			     
			      <th scope="col">Date</th>
			      <th scope="col">Time In</th>
				  <th scope="col">Time Out</th>
				  <th scope="col">Total Hours</th>
				  <th scope="col">Status</th>
				 
		
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
			     
			      <td><?php echo $rows['Date']; ?></td>
				  <td><?php echo $rows['TimeIn']; ?></td>
				  <td><?php echo $rows['TimeOut']; ?></td>
				  <td><?php echo $rows['TotalHrs']; ?></td>
                  <?php
				  // Color coding for the Status to make it Striking
                  if($rows['Status'] == "Not Approved")
                  {
                  ?>
				  <td style="color:red;"><?php echo $rows['Status']; ?></td>
                  <?php }else{ ?>
                    <td style="color:green;"><?php echo $rows['Status']; ?></td>
                    <?php } ?>
			    </tr>
			    <?php } ?>
			  </tbody>
			  <?php }else{ ?>
				<div class="empty">
				<img src="resources/tooltip.jpg" width="100%" >
				<p>No daily time record found</p>
				</div>
			  <?php } ?>
			</table>
		
            <div class="button-container">
            <button type="submit">Log DTR</button>
            <a href="studentui.php" class="btn-primary">Log DTR</a>
        </div>
	</form>
</body>
</html>
<?php
}else{
    header("Location studentui.php");
}
?>