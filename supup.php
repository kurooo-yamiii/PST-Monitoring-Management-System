<?php
// Getting User Account ID
include 'db_conn.php';
if (isset($_GET['ID']) && isset($_GET['AccID']))  {
    $AccID = $_GET['AccID'];
    $ID = $_GET['ID'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Supervisor Account</title>
	<link rel="stylesheet" type="text/css" href="profile.css">
</head>
<body>
     <form action="supupq.php?AccID=<?php echo $AccID ?>&ID=<?php echo $ID ?>" method="post">
        
     <div class="icon-paragraph-container">
        <span class="icon">📚</span>
        <p class="para">Update Supervisor Account</p>
    </div>
    
     	
    <?php
        $sql =  "SELECT * FROM supervisor WHERE ID = $ID";
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
    header("Location supmain.php?AccID=$AccID");
}
?>