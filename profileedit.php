<?php
// Getting User Account ID
include 'db_conn.php';
if (isset($_GET['AccID']))  {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Profile</title>
	<link rel="stylesheet" type="text/css" href="profile.css">
</head>
<body>
     <form action="profileup.php" method="post" enctype="multipart/form-data">
        
     <?php 
	 		// Fetch Data from Database 
			$AccID = $_GET['AccID'];
			$sql = "SELECT * FROM student WHERE ID = $AccID";
			$result = mysqli_query($conn, $sql);

			// Checking querry 
            if(!$result)
            {
             die(mysqli_error($conn));
            }
            if (mysqli_num_rows($result) > 0) {
            $rowData = mysqli_fetch_array($result);
            
			?>

     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

        <style>
        #accid{
            display: none;
        }
        </style>

         <input type="text"
                  id="accid"
                  name="accid"
                  value="<?=$_GET['AccID']?>"
                  hidden>
				  
			<div class="centered-container">
				<div class="inner-container">
				<input type="file" 
		           id="img" 
		           name="img"
				   class="choose" 
				   required>
				</div>
			</div>
	
         <div class="form-group">
		     <label for="name">Name</label>
		     <input type="text" 
		           class="form-control" 
		           id="name" 
		           name="name" 
                   placeholder="<?php echo $rowData['Name']; ?>"
		           value="<?php if(isset($_GET['name']))
		                           echo($_GET['name']); ?>" 
								   required>
		   </div>
           <div class="form-group">
		     <label for="section">Section</label>
		     <input type="section" 
		           class="form-control" 
		           id="section" 
		           name="section"
                   placeholder="<?php echo $rowData['Section']; ?>" 
		           value="<?php if(isset($_GET['section']))
		                           echo($_GET['section']); ?>" 
								   required>
		   </div>
           <div class="form-group">
		     <label for="program">Program</label>
		     <input type="program" 
		           class="form-control" 
		           id="program" 
		           name="program"
                   placeholder="<?php echo $rowData['Program']; ?>" 
		           value="<?php if(isset($_GET['program']))
		                           echo($_GET['program']); ?>" 
								   required>
		   </div>
           <div class="form-group">
		     <label for="contact">Contact</label>
		     <input type="contact" 
		           class="form-control" 
		           id="contact" 
		           name="contact"
                   placeholder="<?php echo $rowData['Contact']; ?>" 
		           value="<?php if(isset($_GET['contact']))
		                           echo($_GET['contact']); ?>" 
								   required>
		   </div>
           <div class="form-group">
		     <label for="email">Email</label>
		     <input type="email" 
		           class="form-control" 
		           id="email" 
		           name="email"
                   placeholder="<?php echo $rowData['Username']; ?>" 
		           value="<?php if(isset($_GET['email']))
		                           echo($_GET['email']); ?>" 
								   required>
		   </div>
		
        <?php } ?>

     	<button type="submit" name="create" style="background-color: #000080; margin-top: 3%;">Save</button>
     </form>
</body>
</html>
<?php
}else{
    header("Location studentui.php");
}
?>