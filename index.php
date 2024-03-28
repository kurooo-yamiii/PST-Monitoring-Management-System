<!DOCTYPE html>
<html>
<head>
	<title>RTU PST Login</title>
     <meta charset="UTF-8">
	<meta http-eequiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0"> 
	<link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="stylemedia.css">
	<link rel="icon" href="resources/cedlogo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body>
     <form action="login.php" method="post">
		
     	<h2><img src="resources/logo.png"></h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

		<div class="form-group">
     	<label>Username</label>
     	<input type="text" name="uname" placeholder="Username" required><br>
		</div>

		<div class="form-group">
     	<label>Password</label>
                <div class="password-container">
     	<input type="password" id="passwordInput" name="password" placeholder="Password" required>
                        <span class="material-icons-outlined" onclick="togglePasswordVisibility()" id="toggleoff">visibility_off</span>
                <span class="material-icons-outlined" onclick="togglePasswordVisibility()" id="toggle">visibility</span>
                        
                <br>
                </div>
		</div>	

     	<button type="submit" onclick="refreshDashboard()" style="background-color: #000080; margin-top: 3%;">Login</button>
     </form>
	 <script src="superviui.js"></script>
	 <script src="studentui.js"></script>


<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("passwordInput");
        var toggle = document.getElementById("toggle");
        var toggleoff = document.getElementById("toggleoff");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggle.style.display = "none";
            toggleoff.style.display = "block";
        } else {
            passwordInput.type = "password";
            toggle.style.display = "block";
            toggleoff.style.display = "none";
        }
    }
</script>
</body>
</html>