<?php
// Getting User Account ID
include 'db_conn.php';
if (isset($_GET['AccID']))  {
    $AccID = $_GET['AccID'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Cooperating Teacher</title>
	<link rel="stylesheet" type="text/css" href="profile.css">
</head>
<body>
     <form action="coopaddq.php?AccID=<?php echo $AccID ?>" method="post">
        
     <div class="icon-paragraph-container">
        <span class="icon">📚</span>
        <p class="para">Add Cooperating Teacher</p>
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
           <div class="form-group">
		     <label for="school">School</label>
		     <input type="school" 
		           class="form-control" 
		           id="school" 
		           name="school"
		           value="<?php if(isset($_GET['school']))
		                           echo($_GET['school']); ?>" 
								   required>
		   </div>
           <div class="form-group">
		     <label for="division">Division</label>
		     <input type="division" 
		           class="form-control" 
		           id="division" 
		           name="division"
		           value="<?php if(isset($_GET['division']))
		                           echo($_GET['division']); ?>" 
								   required>
		   </div>
           <div class="form-group">
		     <label for="grade">Grade</label>
		     <input type="grade" 
		           class="form-control" 
		           id="grade" 
		           name="grade"
		           value="<?php if(isset($_GET['grade']))
		                           echo($_GET['grade']); ?>" 
								   required>
		   </div>
           <div class="form-group">
		     <label for="coordinator">Coordinator</label>
		     <input type="coordinator" 
		           class="form-control" 
		           id="coordinator" 
		           name="coordinator"
		           value="<?php if(isset($_GET['coordinator']))
		                           echo($_GET['coordinator']); ?>" 
								   required>
		   </div>
         
   

     	<button type="submit" name="create" style="background-color: #000080; margin-top: 3%;">Add</button>
     </form>
</body>
</html>
<?php
}else{
    header("Location coadd.php?AccID=$AccID");
}
?>