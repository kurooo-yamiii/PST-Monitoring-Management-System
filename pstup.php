<?php
// Getting User Account ID and Refereal number for Update
include 'db_conn.php';
if (isset($_GET['ID']) && isset($_GET['AccID']))  {
    $AccID = $_GET['AccID'];
    $ID = $_GET['ID'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Student Account</title>
	<link rel="stylesheet" type="text/css" href="profile.css">
</head>
<body>
     <form action="pstaddq.php" method="post">
        
     <div class="icon-paragraph-container">
        <span class="icon">📚</span>
        <p class="para">Update PST Account</p>
    </div>

    <?php
        $sql =  "SELECT * FROM Student WHERE ID = $ID";
        $result = mysqli_query($conn, $sql);
        if(!$result)
        {
         die(mysqli_error($conn));
        }
        if (mysqli_num_rows($result) > 0) {
        $rd = mysqli_fetch_array($result);
    
    ?>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

        </div>
         <div class="form-group">
		     <label for="email">Email</label>
		     <input type="email" 
		           class="form-control" 
		           id="email" 
		           name="email"
                   placeholder="<?php echo $rd['Username'] ?>"
		           value="<?php if(isset($_GET['email']))
		                           echo($_GET['email']); ?>" 
								   required>
		   </div>
         <div class="form-group">
		     <label for="name">Name</label>
		     <input type="text" 
		           class="form-control" 
		           id="name" 
		           name="name" 
                   placeholder="<?php echo $rd['Name'] ?>"
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
                   placeholder="<?php echo $rd['Section'] ?>"
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
                   placeholder="<?php echo $rd['Program'] ?>"
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
                   placeholder="<?php echo $rd['Contact'] ?>"
		           value="<?php if(isset($_GET['contact']))
		                           echo($_GET['contact']); ?>" 
								   required>
		   </div>
           <div class="form-group">
		     <label for="password">Password</label>
		     <input type="password" 
		           class="form-control" 
		           id="password" 
		           name="password"
                   placeholder="<?php echo $rd['Password'] ?>"
		           value="<?php if(isset($_GET['password']))
		                           echo($_GET['password']); ?>" 
								   required>
		   </div>
           <?php } ?>
         
   

     	<button type="submit" name="create" style="background-color: #000080; margin-top: 3%;">Update</button>
     </form>
</body>
</html>
<?php
}else{
    header("Location account.php?AccID=$AccID");
}
?>