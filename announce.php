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
    <link rel="stylesheet" type="text/css" href="announcement.css">
</head>
<body>

<form action ="announceq.php?AccID=<?php echo $_GET['AccID']?>" method="post" class="form2" enctype="multipart/form-data">
<p>Post <span> Announcement</span> </p><br>

<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
<?php 
			// Display wether the DTR process succeeded or failed
            
			if (isset($_GET['success'])) { ?>
		    <div class="alert alert-success" role="alert">
			  <?php echo $_GET['success']; ?>
		    </div>
		    <?php } ?>
<div class="form-container">
    
        <div class="form-group">
            <label for="post">Post:</label>
            <textarea  name="post" rows="4" placeholder="Enter announcement here..." required></textarea>
        </div>
        <div class="form-group">
            <label for="img">Img:</label>
            <input type="file" name="img">
        </div>
        <div class="button-container">
            <button type="submit">Post</button>
            <a href="supervisorui.php" class="btn-primary">Back</a>
        </div>

</div>

</form>


<form action="" method="post">
          
	<p>Updates and<span> Announcement</span> </p><br>
       <?php     
            $posts = $ponn->query("SELECT * FROM announce");
       ?>
        <?php if($posts->rowCount() <= 0){ ?>
                    <div class="empty">
                    <img src="resources/tooltip.jpg" alt="resources/sub.png">
                    </div>
            <?php } ?>
           
            <?php while($post = $posts->fetch(PDO::FETCH_ASSOC)) { ?>
                <?php if( $post['Picture'] == ''){ ?>
                    <div class="todo-item">
				    <a href="" 
			      	    class="removee-to-do"><?php echo $post['Date']?></a> <br>
                        <h2><?php echo $post['Post']?>
                    </h2>
                <br>
            <small>- <?php echo $post['Author']?></small> 
            </div>
              <?php  }else{ ?>
                <div class="todo-item">
				    <a href="" 
			      	    class="removee-to-do"><?php echo $post['Date']?></a> <br>
                            <div class="empty">
                             <img src="upload/<?php echo $post['Picture']?>">
                            </div>
                        <h2><?php echo $post['Post']?>
                    </h2>
                <br>
            <small>- <?php echo $post['Author']?></small> 
            </div>
            <?php } ?>
            <?php } ?>
	</form>
</body>
</html>
<?php
}else{
    header("Location studentui.php");
}
?>