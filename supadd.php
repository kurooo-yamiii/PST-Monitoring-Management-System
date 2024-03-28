<?php
// Getting User Account ID
include 'db_conn.php';
if (isset($_GET['AccID']))  {
    $AccID = $_GET['AccID'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Supervisor Account</title>
	<link rel="stylesheet" type="text/css" href="profile.css">
</head>
<body>
     <form action="supaddq.php?AccID=<?php echo $AccID ?>" method="post">
        
     <div class="icon-paragraph-container">
        <span class="icon">📚</span>
        <p class="para">Add Supervisor</p>
    </div>
    
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
		           value="<?php if(isset($_GET['name']))
		                           echo($_GET['name']); ?>" 
								   required>
		   </div>
    

     	<button type="submit" name="create" style="background-color: #000080; margin-top: 3%;">Add</button>
     </form>
</body>
</html>
<?php
}else{
    header("Location supmain.php?AccID=$AccID");
}
?>