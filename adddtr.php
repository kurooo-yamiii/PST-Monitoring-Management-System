<?php
// Getting the Account ID of Pre-Service Teacher
include 'db_conn.php';
if (isset($_GET['AccID']))  {
?>
<!DOCTYPE html>
<html>
<head>
	<title>Daily Time Record</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-<your-sha512-hash>" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="add.php" method="post">

 
<div class="title-container">
    <i class="fas fa-clock"></i>
    <h1>Daily Time Record</h1>
</div>

		   <?php if (isset($_GET['error'])) { ?>
		   <div class="alert alert-danger" role="alert">
			  <?php echo $_GET['error']; ?>
		    </div>
		   <?php } ?>
           <input type="text"
                  id="accid"
                  name="accid"
                  value="<?=$_GET['AccID']?>"
                  hidden>

            <div class="form-group">
		     <label for="date">Date</label>
		     <input type="date" 
		           class="form-control" 
		           id="date" 
		           name="date" 
		           value="<?php if(isset($_GET['date']))
		                           echo($_GET['date']); ?>" 
								   required>
		   </div>


           <div class="form-group">
		     <label for="timein">Time In</label>
		     <input type="time" 
		           class="form-control" 
		           id="timein" 
		           name="timein" 
		           value="<?php if(isset($_GET['timein']))
		                           echo($_GET['timein']); ?>" 
								   required>
		   </div>

		   <div class="form-group">
		     <label for="timeout">Time Out</label>
		     <input type="time" 
		           class="form-control" 
		           id="timeout" 
		           name="timeout" 
		           value="<?php if(isset($_GET['timeout']))
		                           echo($_GET['timeout']); ?>"
								   required>
		   </div>

      
           <button type="submit" name="create" style="width: 30%; height: 9%; margin-top: 4%; display: relative;">Log</button>
		  
	    </form>

</body>
</html>
<?php
}else{
     header("Location: dtr.php");
     exit();
}
?>