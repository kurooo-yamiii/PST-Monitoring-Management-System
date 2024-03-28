<?php
// Getting User Account ID
include 'db_conn.php';
if (isset($_GET['AccID']))  {
    $AccID = $_GET['AccID'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add PST Account</title>
	<link rel="stylesheet" type="text/css" href="profile.css">
</head>
<body>
     <form action="pstaddq.php" method="post">
        
     <div class="icon-paragraph-container">
        <span class="icon">📚</span>
        <p class="para">Add Pre-Service Teacher</p>
    </div>
    
        <?php 
        // Fetching Supervisor Name that Add the PST into the List
        $sql = "SELECT * FROM supervisor WHERE ID = $AccID";
        $rs = mysqli_query($conn, $sql);
        if(!$rs)
        {
         die(mysqli_error($conn));
        }
        if (mysqli_num_rows($rs) > 0) {
        $rd = mysqli_fetch_array($rs);
        $supervisor = $rd['Name'];
        }
        ?>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

        <style> #supervisor, #id{
            display: none;
        }</style>

         <div class="form-group">
		     <input type="text" 
		           class="form-control" 
		           id="supervisor" 
		           name="supervisor"
		           value="<?php echo $supervisor; ?>" 
								   hidden>
                                   <div class="form-group">
		     <input type="id" 
		           class="form-control" 
		           id="id" 
		           name="id"
		           value="<?php echo $AccID; ?>" 
								   hidden>

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
		     <label for="section">Section</label>
		     <input type="section" 
		           class="form-control" 
		           id="section" 
		           name="section"
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
		           value="<?php if(isset($_GET['contact']))
		                           echo($_GET['contact']); ?>" 
								   required>
		   </div>
         
   

     	<button type="submit" name="create" style="background-color: #000080; margin-top: 3%;">Add</button>
     </form>
</body>
</html>
<?php
}else{
    header("Location studadd.php?AccID=$AccID");
}
?>