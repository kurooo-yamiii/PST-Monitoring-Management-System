<?php 
// Session Start fetching the Login Data
session_start();
if (isset($_SESSION['ID']) && isset($_SESSION['Name'])) {

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php	
     echo $_SESSION['Name'];
     ?> - Dashboard</title>
	<link rel="stylesheet" type="text/css" href="student.css">
</head>
<body>
     <form action="dtr.php?username=<?=$_SESSION['ID']?>" method="post">
     
	<img src="resources/logo.png" class="logo">
	 <h2>Rizal Technological University</h2>
     <p>Welcome Back - <?php	
     echo $_SESSION['Name'];
     ?></p>
	 
     <div class="menu-container">

     <a href="account.php?AccID=<?=$_SESSION['ID']?>" class="linkstyle" > 
    <div class="menu-item">
      <div class="menu-icon">&#128101;</div>
      <div class="menu-label">Account</div>
    </div>
    </a>

    <a href="deployment.php?AccID=<?=$_SESSION['ID']?>" class="linkstyle" >
    <div class="menu-item">
      <div class="menu-icon">&#128209;</div>
      <div class="menu-label">Deployment</div>
    </div>
    </a>

    <a href="announce.php?AccID=<?=$_SESSION['ID']?>" class="linkstyle" >
    <div class="menu-item">
      <div class="menu-icon">&#128227;</div>
      <div class="menu-label">Announcement</div>
    </div>
    </a>

    <a href="" class="linkstyle" >    
    <div class="menu-item">
      <div class="menu-icon">&#128195;</div>
      <div class="menu-label">To-Do-List</div>
    </div>
    </a>

    <a href="index.php" class="linkstyle" >
    <div class="menu-item">
      <div class="menu-icon">&#128682;</div>
      <div class="menu-label">Logout</div>
    </div>
  </div>
  </a>

     </form>
</body>
</html>
<?php
}else{
     header("Location: index.php");
     exit();
}
?>