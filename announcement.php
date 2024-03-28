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

            <div class="button-container">
            <a href="studentui.php" class="btn-primary">Back</a>
        </div>

	</form>
</body>
</html>
<?php
}else{
    header("Location studentui.php");
}
?>