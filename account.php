<?php 
// Fetching supervisor Login Data
if (isset($_GET['AccID'])) {
$AccID = $_GET['AccID'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Masterlist - Account</title>
	<link rel="stylesheet" type="text/css" href="student.css">
</head>
<body>
     <form action="dtr.php?username=<?=$_SESSION['ID']?>" method="post">
     
	<img src="resources/logo.png" class="logo">
	 <h2>Rizal Technological University</h2>
     <p>Boni Ave, Mandaluyong, 1550 Metro Manila</p>
	 
     <div class="menu-container">

     <a href="studadd.php?AccID=<?php echo $AccID ?>" class="linkstyle" > 
    <div class="menu-item">
      <div class="menu-icon">&#128218;</div>
      <div class="menu-label">Student (PST) Account</div>
    </div>
    </a>

    <a href="cooadd.php?AccID=<?php echo $AccID ?>" class="linkstyle" >
    <div class="menu-item">
      <div class="menu-icon">&#x1F3EB;</div>
      <div class="menu-label">Cooperating Teacher Account</div>
    </div>
    </a>

    <a href="supmain.php?AccID=<?php echo $AccID ?>" class="linkstyle" >
    <div class="menu-item">
      <div class="menu-icon">&#129333;</div>
      <div class="menu-label">Supervisor/Head Account</div>
    </div>
    </a>

    <a href="supervisorui.php" class="linkstyle" >
    <div class="menu-item">
      <div class="menu-icon">&#127915;</div>
      <div class="menu-label">Dashboard</div>
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