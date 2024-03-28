<?php 
include 'db_conn.php';
include 'db_pdo.php';
// Session Start fetching the Login Data
session_start();
if (isset($_SESSION['ID']) && isset($_SESSION['Name'])) {

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="cooperatingui.js"></script>
<title>PST <?php echo $_SESSION['Name']; ?></title>
<link rel="icon" href="resources/cedlogo.png" type="image/x-icon">

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

	<link rel="stylesheet" href="cooperatingui.css">
        <link rel="stylesheet" href="cooperatinmedia.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

</head>
<body>
    <style>
       #dashboard {
        display: none;
       }
       #approvalDTR {
        display: none;
       }
       #showEval{
        display: none;
       }
       #studEvaluation {
        display: none;
       }
       #addEvaluation {
        display: none;
       }
       #todolist {
        display: none;
       }
        #profile {
        display: none;
       }
       #profileupdate{
        display: none;
       }
     
    </style>
      
	<header class="header">
		<h2 class="u-name">RIZAL<b> TECHNOLOGICAL UNIVERSITY</b>
		</h2>
		<span onclick="refreshDashboard()" class="material-icons-outlined">home</span>
	</header>
	<div class="body">
		<nav class="side-bar">
			<div class="user-p">
            <?php 
          $StudID = $_SESSION['ID'];
          $IDsq = "SELECT * FROM teacher WHERE ID = $StudID AND Profile != ''";
          $IDres = mysqli_query($conn,  $IDsq);
          $images = mysqli_fetch_assoc($IDres);
          if (mysqli_num_rows($IDres) > 0) { 
         ?>
               <img src="upload/<?=$images['Profile']?>">
          		
        <?php }else{?>
               <img  src="resources/default.jpeg">
        <?php }?>
        <?php 
         $StudID = $_SESSION['ID'];
         $Namesq = "SELECT * FROM teacher WHERE ID = $StudID";
         $Nameres = mysqli_query($conn,  $Namesq);
         $name = mysqli_fetch_assoc($Nameres);
         if (mysqli_num_rows($Nameres) > 0) { 
            ?>
				<h4>CT/RT <?php echo $name['Name']?></h4>

                <?php }?>
			</div>
			<ul>
				<li id="dtrbtn">
					<b onclick="refresAppDTR()">
					<a style="text-decoration: none; color: #eee;">
					<div class="direction">
					<span class="material-icons-outlined">table_view</span>
						<p>DTR</p>
				    </div>
					</a>
					</b>
				</li>

				<li id="evalbtn">
					<b onclick="refEval()">
					<a style="text-decoration: none; color: #eee;">
					<div class="direction">
					<span class="material-icons-outlined">assignment</span>
						<p>Evaluation</p>
				    </div>
					</a>
					</b>
				</li>

				<li id="todolistbut">
					<b onclick="refTodolist()">
					<a style="text-decoration: none; color: #eee;">
					<div class="direction">
					<span class="material-icons-outlined">checklist</span>
						<p>To-Do-List</p>
				    </div>
					</a>
					</b>
				</li>

				<li id="profbtn">
					<b onclick="refProfile()">
					<a style="text-decoration: none; color: #eee;">
					<div class="direction">
					<span class="material-icons-outlined">portrait</span>
						<p>Account</p>
				    </div>
					</a>
					</b>
				</li>

				<li>
				<b>
					<a href="logout.php" style="text-decoration: none; color: #eee;">
					<div class="direction">
					<span class="material-icons-outlined">logout</span>
						<p>Logout</p>
				    </div>
					</a>
					</b>
				</li>
			</ul>
		</nav>
		<section class="section-1" id="section">
    <form id="dashboard">
      <div class="dashboard">
        <h1>Dashboard</h1>

        <div class="logos">
            <div class="logo">
                <img src="resources/logo.png" alt="Logo 1" width="50">
            </div>
            <div class="logo">
                <img src="resources/ced.jpg" alt="Logo 2" width="50">
            </div>
        </div>
     </div>

    <div class="divider"></div>

        
<div class="eval-studd">
<h3>PST Recent DTR</h3>
<?php    
$ProfID = $_SESSION['ID'];
$studidq = "SELECT * FROM teacher WHERE ID = $ProfID";
$studres = mysqli_query($conn, $studidq);
$fetchstudid = mysqli_fetch_assoc($studres);
$StudID = $fetchstudid['Student'];

$sql = "SELECT * FROM dtr WHERE AccID = $StudID ORDER BY ID DESC LIMIT 3";
			$result = mysqli_query($conn, $sql);
			?>
			<?php 
			// Display the record in Table
			if (mysqli_num_rows($result)) { ?>
			<table class="table table-striped">
			  <thead>
			    <tr>
			     
			    <th scope="col">Date</th>
			    <th scope="col">Time In</th>
				  <th scope="col">Time Out</th>
				  <th scope="col">Total Hours</th>
				  <th scope="col">Status</th>
				 
		
			    </tr>
			  </thead>
			  <tbody>
			  <?php 
			  // Continue adding rows depening to the Fetch Data
			  	   $i = 0;
			  	   while($rows = mysqli_fetch_assoc($result)){
			  	   $i++;
			  	 ?>
			    <tr>
			     
			      <td><?php echo $rows['Date']; ?></td>
				  <td><?php echo $rows['TimeIn']; ?></td>
				  <td><?php echo $rows['TimeOut']; ?></td>
				  <td><?php echo $rows['TotalHrs']; ?></td>
                  <?php
				  // Color coding for the Status to make it Striking
                  if($rows['Status'] == "Not Approved")
                  {
                  ?>
				  <td style="color:red;"><?php echo $rows['Status']; ?></td>
                  <?php }else{ ?>
                    <td style="color:green;"><?php echo $rows['Status']; ?></td>
                    <?php } ?>
			    </tr>
			    <?php } ?>
			  </tbody>
                  </table>
			  <?php }else{ ?>
				<table>
    <thead>
      <tr>
        <th scope="col">Date</th>
        <th scope="col">Time In</th>
        <th scope="col">Time Out</th>
        <th scope="col">Total Hours</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      <!-- Row 1 -->
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <!-- Row 2 -->
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <!-- Row 3 -->
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table>
			  <?php } ?>
		
</div>

    <?php
    $sql = "SELECT AVG(average) as average_value FROM evaluation WHERE StudentID = $StudID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $averageValue = $row["average_value"];
            $totalave = intval($averageValue) . "%";
        }
    } 
    ?>
      <div class="eval-update">
      <div class="canvas-container">
      
      <h2> PST Evaluation Statistic Total average of <?php echo $totalave ?></h2>

      <?php
       
                
                $scores = [];
                $tablequery = "SELECT REPLACE(Average, '%', '') as cleaned_score FROM evaluation WHERE StudentID = $StudID ORDER BY ID DESC
                LIMIT 6";
                $rowquery = $conn->query($tablequery);
                 if ($rowquery->num_rows > 0) {
                // Output data of each row
                while($datarow = $rowquery->fetch_assoc()) {
                    $scores[] = $datarow['cleaned_score'];
                        $reversedScores = array_reverse($scores);
                  
                }
                }else{
                       $reversedScores = [0];}
                ?>
                   <canvas id="scoreChart" width="550" height="200"></canvas>
              
                    <script>
                    // Use Chart.js to create a line chart
                    var ctx = document.getElementById('scoreChart').getContext('2d');
                    var chart = new Chart(ctx, {
                        type: "line",
                        data: {
                            labels: <?php echo json_encode(array_map(function($value) { return 'Ave ' . $value; }, range(1, count($scores)))); ?>,
                            datasets: [{
                                label: 'Evaluation Scores',
                                data: <?php echo json_encode($reversedScores); ?>,
                                borderColor: '#3498db',
                                backgroundColor: 'rgba(52, 152, 219, 0.2)', 
                                borderWidth: 5,
                                fill: true, 
                            }]
                             },
                        options: {
                            responsive: false,
                              maintainAspectRatio: false, 
                        scales: {
                        y: { beginAtZero: true,
                            ticks: {
                        font: {
                            family: 'Arial',
                            size: 14,
                            weight: 'bold'
                                        }
                                    } }
                                 },
                                 plugins: {
                legend: {
                    labels: {
                        font: {
                            family: 'Arial',
                            size: 13,
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return context.dataset.label + ': ' + context.parsed.y + '%';
                        }
                    },
                    titleFont: {
                        family: 'Arial',
                        size: 16,
                        weight: 'bold'
                    },
                    bodyFont: {
                        family: 'Arial',
                        size: 14,
                        weight: 'bold'
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        font: {
                            family: 'Arial',
                            size: 14,
                            weight: 'bold'
                        }
                    }
                },
                y: {
                    ticks: {
                        font: {
                            family: 'Arial',
                            size: 14,
                            weight: 'bold'
                        }
                    }
                }
            }
        }
    });
                    </script>
      
    
    
     
      </div>
       <?php
                // Creating arrays for the 4 variable in evaluation
                $at = [];
                $bt = [];
                $ct = [];
                $dt = [];
                
                // Fetching the points and scores from the student evaluation
                $vartablequery = "SELECT * FROM evaluation WHERE StudentID = $StudID ORDER BY ID DESC
                LIMIT 3";
                $varquery = $conn->query($vartablequery);
                 if ($varquery->num_rows > 0) {

                while($varrow = $varquery->fetch_assoc()) {
                    // Placing it into the arrays
                    $at[] = $varrow['aT'];
                    $bt[] = $varrow['bT'];
                    $ct[] = $varrow['cT'];
                    $dt[] = $varrow['dT'];
                }
                }
                ?>




<div class="canvas-container">
      <h2>PST Recent Scores and Ratings</h2>
      <canvas id="varChart" width="550" height="200"></canvas>      
   
     
      <script>
      // Chart for Evaluation (4 Variables)
      var ctx = document.getElementById('varChart').getContext('2d');
      var chart = new Chart(ctx, {
          type: 'bar',
    data: {
        labels: <?php echo json_encode(array_map(function($value) { return 'Evaluation ' . $value; }, range(1, count($at)))); ?>,
        datasets: [{
            label: 'Conciseness',
            data: <?php echo json_encode($at); ?>,
            backgroundColor: 'rgba(243, 156, 18, 0.7)',
            borderColor: '#f39c12',
            borderWidth: 3
        },
        {
            label: 'Clearness',
            data: <?php echo json_encode($bt); ?>,
            borderColor: '#3498db',
            backgroundColor: 'rgb(52, 152, 219, 0.7)',
            borderWidth: 3
        },
        {
            label: 'Clarity',
            data: <?php echo json_encode($ct); ?>,
            borderColor: '#2ecc71',
            backgroundColor: 'rgb(46, 204, 113, 0.7)',
            borderWidth: 3
        },
        {
            label: 'Correcteness',
            data: <?php echo json_encode($dt); ?>,
            borderColor: '#e74c3c',
            backgroundColor: 'rgb(231, 76, 60, 0.7)',
            borderWidth: 3
        }
    ]
    },
    options: { 
        responsive: false,
        maintainAspectRatio: false, 
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            family: 'Arial',
                            size: 14,
                            weight: 'bold'
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        font: {
                            family: 'Arial',
                            size: 13,
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return context.dataset.label + ': ' + context.parsed.y + '%';
                        }
                    },
                    titleFont: {
                        family: 'Arial',
                        size: 16,
                        weight: 'bold'
                    },
                    bodyFont: {
                        family: 'Arial',
                        size: 14,
                        weight: 'bold'
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        font: {
                            family: 'Arial',
                            size: 14,
                            weight: 'bold'
                        }
                    }
                },
                y: {
                    ticks: {
                        font: {
                            family: 'Arial',
                            size: 14,
                            weight: 'bold'
                        }
                    }
                }
            }
        }
    });
</script>
</div>  
</div>
<div class="space"></div>

     </form>

     <form action="" method="post" id="approvalDTR">
            <?php
            // Retrieving Handled Student
            $TeachID = $_SESSION['ID'];
            $sql3 = "SELECT * FROM teacher WHERE ID = $TeachID ";
            $result3 = mysqli_query($conn, $sql3);

            // If Else statement for running SQL query
            if(!$result3)
            {
             die(mysqli_error($conn));
            }
            if (mysqli_num_rows($result3) > 0) {
            $techData = mysqli_fetch_array($result3);
            }
            $AccID = $techData['Student'];

			// Retrieving Data from the Student Account
        
            $sql2 = "SELECT * FROM student WHERE ID = $AccID";
			$result2 = mysqli_query($conn, $sql2);

			// If Else statement for running SQL query
            if(!$result2)
            {
             die(mysqli_error($conn));
            }
            if (mysqli_num_rows($result2) > 0) {
            $rowData = mysqli_fetch_array($result2);
            }
			
			// Display User Total Hours and Minutes
			$total = $rowData['Total'];
			if($total == ""){
				$hours = 0;
				$minutes = 0;
			}else{$hours = floor($total / 60);
				$minutes = intval($total) % 60;}
			
            ?>
 <div class="dashboard">
        <h1>Daily Time Record of <span>PST <?php echo $rowData['Name'] ?></span></h1>

        <div class="logos">
            <div class="logo">
                <img src="resources/logo.png" alt="Logo 1" width="50">
            </div>
            <div class="logo">
                <img src="resources/ced.jpg" alt="Logo 2" width="50">
            </div>
        </div>
     </div>

    <div class="divider"></div>

    <input type="hidden" name="StudID" id="StudID" value="<?php echo $rowData['ID']; ?>">
		    <div id="approvalerror">
			  
		    </div>
      <div id="oldapproval">
			<?php 
			// Retrieving user data from DTR table 
			$sql = "SELECT * FROM dtr WHERE AccID = $AccID AND Status = 'Not Approved'";
			$result = mysqli_query($conn, $sql);
			?>
			<?php 
			// Display the record in Table
			if (mysqli_num_rows($result)) { ?>
			<table class="table table-striped">
			  <thead>
			    <tr>
			      
              
			    <th scope="col">Date</th>
			    <th scope="col">Time In</th>
				  <th scope="col">Time Out</th>
				  <th scope="col">Total Hours</th>
				  <th scope="col">Status</th>
          <th scope="col">Approval</th>
				 
		
			    </tr>
			  </thead>
			  <tbody>
			  <?php 
			  // Continue adding rows depening to the Fetch Data
			  	   $i = 0;
			  	   while($rows = mysqli_fetch_assoc($result)){
			  	   $i++;
			  	 ?>
			    <tr>

			    <td><?php echo $rows['Date']; ?></td>
				  <td><?php echo $rows['TimeIn']; ?></td>
				  <td><?php echo $rows['TimeOut']; ?></td>
				  <td><?php echo $rows['TotalHrs']; ?></td>
                  <?php
				  // Color coding for the Status to make it Striking
                  if($rows['Status'] == "Not Approved")
                  {
                  ?>
				  <td style="color:red;"><?php echo $rows['Status']; ?></td>
                  <?php }else{ ?>
                    <td style="color:green;"><?php echo $rows['Status']; ?></td>
                    <?php } ?>
                    <td><a onclick="approvalDelete(<?php echo $rows['ID']; ?>)" type="button"
			      	     class="red-button">Delete</a>
                           <a onclick="approvalUpdate(<?php echo $rows['ID']; ?>)" type="button"
			      	     class="blue-button">Approve</a>
                    </td>
			    </tr>
			    <?php } ?>
			  </tbody>
        </table>
    
			  <?php }else{ ?>
          <table class="table table-striped">
			  <thead>
			    <tr>
			      
              
			    <th scope="col">Date</th>
			    <th scope="col">Time In</th>
				  <th scope="col">Time Out</th>
				  <th scope="col">Total Hours</th>
				  <th scope="col">Status</th>
          <th scope="col">Approval</th>
				 
		
			    </tr>
			  </thead>
        <tbody>
    <tr>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>

  </tbody>
  <tbody>
    <tr>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>

  </tbody>
  <tbody>
    <tr>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>

  </tbody>
  </table>
			
        <?php } ?> 
       
			  <div class="space"></div>
		
        <div class="divider"></div>

           
<div class="eval-studd">
<h3>Recent Approved DTR</h3>
<?php
$ProfID = $_SESSION['ID'];
$studidq = "SELECT * FROM teacher WHERE ID = $ProfID";
$studres = mysqli_query($conn, $studidq);
$fetchstudid = mysqli_fetch_assoc($studres);
$StudID = $fetchstudid['Student'];    
$sql = "SELECT * FROM dtr WHERE AccID = $StudID AND Status = 'Approved' ORDER BY ID DESC LIMIT 3";
			$result = mysqli_query($conn, $sql);
			?>
			<?php 
			// Display the record in Table
			if (mysqli_num_rows($result)) { ?>
			<table class="table table-striped">
			  <thead>
			    <tr>
			     
			      <th scope="col">Date</th>
			      <th scope="col">Time In</th>
				  <th scope="col">Time Out</th>
				  <th scope="col">Total Hours</th>
				  <th scope="col">Status</th>
				  <th scope="col">Action</th>
			
			    </tr>
			  </thead>
			  <tbody>
			  <?php 
			  // Continue adding rows depening to the Fetch Data
			  	   $i = 0;
			  	   while($rows = mysqli_fetch_assoc($result)){
			  	   $i++;
			  	 ?>
			    <tr>
			     
			      <td><?php echo $rows['Date']; ?></td>
				  <td><?php echo $rows['TimeIn']; ?></td>
				  <td><?php echo $rows['TimeOut']; ?></td>
				  <td><?php echo $rows['TotalHrs']; ?></td>
                  <?php
				  // Color coding for the Status to make it Striking
                  if($rows['Status'] == "Not Approved")
                  {
                  ?>
				  <td style="color:red;"><?php echo $rows['Status']; ?></td>
                  <?php }else{ ?>
                    <td style="color:green;"><?php echo $rows['Status']; ?></td>
                    <?php } ?>
                         <td><a onclick="approvalDelete(<?php echo $rows['ID']; ?>)" type="button"
			      	     class="red-button">Delete</a></td>
			    </tr>
			    <?php } ?>
			  </tbody>
                  </table>
			  <?php }else{ ?>
				<table>
    <thead>
      <tr>
        <th scope="col">Date</th>
        <th scope="col">Time In</th>
        <th scope="col">Time Out</th>
        <th scope="col">Total Hours</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      <!-- Row 1 -->
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <!-- Row 2 -->
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <!-- Row 3 -->
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table>
			  <?php } ?>
		
</div>

             
<div class="space"></div>
		
        <div class="divider"></div>
        <h1 class="accumulated">Total accumulated time <?php echo $hours?> hours and <?php echo $minutes?> minutes</h1>
               </div>
	</form>

  <?php
            // Retrieving Handled Student
            $TeachID = $_SESSION['ID'];
            $sql3 = "SELECT * FROM teacher WHERE ID = $TeachID ";
            $result3 = mysqli_query($conn, $sql3);

            // If Else statement for running SQL query
            if(!$result3)
            {
             die(mysqli_error($conn));
            }
            if (mysqli_num_rows($result3) > 0) {
            $techData = mysqli_fetch_array($result3);
            }
            $StudID = $techData['Student'];

            $fetchstudname = "SELECT * FROM student WHERE ID = $StudID ";
            $fetchnameres = mysqli_query($conn, $fetchstudname);
            $rowfetchname = mysqli_fetch_assoc($fetchnameres);
            
?>

<form action="" method="post" id="showEval">
<div class="dashboard">
        <h1>Evaluation list of <span> PST <?php echo $rowfetchname['Name'] ?></span> </h1>
        
        <div class="logos">
            <div class="logo">
                <img src="resources/logo.png" alt="Logo 1" width="50">
            </div>
            <div class="logo">
                <img src="resources/ced.jpg" alt="Logo 2" width="50">
            </div>
        </div>
     </div>
     <div class="divider"></div>
     <div class="space" id="lightspace"></div>
     <input type="hidden" name="fetchid" id="fetchid" value="<?php echo $StudID; ?>">
     <div id="displayError"> </div>

<div id="listEvaluation">
<?php 


$evals = $ponn->query("SELECT * FROM evaluation WHERE StudentID = $StudID");
?>
<?php if($evals->rowCount() <= 0){ ?>
    <div class="todo-item">
      
       
        <button class="removee-to-do" type="button">N/A</button> 
        <h2>You haven't been evaluated by your Coordinating Teacher</h2>
        <br>
        <small>Note: Please cooridnate with your coordinating teacher with regards to you evaluation</small>
    </div>
<?php } ?>
<div class="show-todo-section">
<?php while($eval = $evals->fetch(PDO::FETCH_ASSOC)) { ?>
    <div class="todo-item">
        
       
        <button onclick="displayEval(<?php echo $eval['ID']; ?>)" class="removee-to-do" type="button">View</button> 
        <h2>Lesson/Topic: <?php echo $eval['Lesson'] ?> <span class="ave"> <?php echo $eval['Average'] ?> </span> </h2>
        <br>
        <small>Evaluated On: <?php echo $eval['Date'] ?></small>
        <button class="btn-save" type="button" onclick="deleteEvaluation(<?php echo $eval['ID']; ?>)">Delete</button>
    </div>
<?php } ?>

</div>
</div>
<div class="form-but">
           <button class="evalbtn" type="button" onclick="refAddEval()">Evaluate</button>
           </div>
<div class="space" id="lightspace"></div>
<div class="divider"></div>
</form>

    
    <form id="studEvaluation">
      <div class="dashboard">
        <h1>Scores and Remarks</h1>

        <div class="logos">
            <div class="logo">
                <img src="resources/logo.png" alt="Logo 1" width="50">
            </div>
            <div class="logo">
                <img src="resources/ced.jpg" alt="Logo 2" width="50">
            </div>
        </div>
     </div>

    <div class="divider"></div>

    <div id="catchError"></div>
    <div id="scoreRemarks"></div>


    <div class="space"></div>
    <div class="divider"></div>
</form>

<form action="" method="post" id="addEvaluation">
     <div class="dashboard">
        <h1>Evaluate<span> PST <?php echo $rowfetchname['Name'] ?></span> </h1>
        
        <div class="logos">
            <div class="logo">
                <img src="resources/logo.png" alt="Logo 1" width="50">
            </div>
            <div class="logo">
                <img src="resources/ced.jpg" alt="Logo 2" width="50">
            </div>
        </div>
     </div>
     <div class="divider"></div>
     <div class="space" id="lightspace"></div>
    <?php
    // Fetching Resource Teacher
    $ProfID = $_SESSION['ID'];
    $sql2 = "SELECT * FROM teacher WHERE ID = $ProfID";
    $rs2 = mysqli_query($conn, $sql2);

    if(!$rs2)
    {
     die(mysqli_error($conn));
    }
    if (mysqli_num_rows($rs2) > 0) {
    $rs2data = mysqli_fetch_assoc($rs2);
    
    // Getting Resource Teacher ID to enter CoordinatorUI
    $AccID = $rs2data['Student'];
    ?>
         <style>
        #accid{
            display: none;
        }
    
        </style>
         <input type="text"
                  id="accid"
                  name="accid"
                  value="<?php echo $AccID; ?>"
                  hidden>

         <div class="text-group">
            <label id="lab1" for="date">Date:</label>
            <input type="date" id="date" name="date" required>
            <label id="labelspace"></label>
            <label id="lab2" for="lesson"> Lesson:</label>
            <input type="lesson" id="lesson" name="lesson" required>
        </div>
		  
       
	
         <div class="form-group-eval-form2">
         <table class="custom-table-form2">
         <p class="eval-title">I. Conciseness</p>
                <tr class="custom-tr-form2">
                    <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td class="custom-table-column-form2">   <select id="a1" name="a1" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr class="custom-tr-form2">
                    <th class="custom-table-row-form2">2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td class="custom-table-column-form2">   <select id="a2" name="a2" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr class="custom-tr-form2">
                    <th class="custom-table-row-form2">3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td class="custom-table-column-form2">   <select id="a3" name="a3" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr class="custom-tr-form2">
                    <th class="custom-table-row-form2">4. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td class="custom-table-column-form2">   <select id="a4" name="a4" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr class="custom-tr-form2">
                    <th class="custom-table-row-form2">5. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td class="custom-table-column-form2">   <select id="a5" name="a5" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
              </table>
		   </div>

           <div class="form-group-eval-form2">
         <table class="custom-table-form2">
         <p class="eval-title">II. Coherence</p>
                <tr class="custom-tr-form2">
                    <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td class="custom-table-column-form2">   <select id="b1" name="b1" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr class="custom-tr-form2">
                    <th class="custom-table-row-form2">2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td class="custom-table-column-form2">   <select id="b2" name="b2" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr class="custom-tr-form2">
                    <th class="custom-table-row-form2">3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td class="custom-table-column-form2">   <select id="b3" name="b3" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr class="custom-tr-form2">
                    <th class="custom-table-row-form2">4. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td class="custom-table-column-form2">   <select id="b4" name="b4" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr class="custom-tr-form2">
                    <th class="custom-table-row-form2">5. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td class="custom-table-column-form2">   <select id="b5" name="b5" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                </table>
		   </div>

           <div class="form-group-eval-form2">
         <table class="custom-table-form2">
         <p class="eval-title">III. Clarity</p>
                <tr class="custom-tr-form2">
                    <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td class="custom-table-column-form2">   <select id="c1" name="c1" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr class="custom-tr-form2">
                    <th class="custom-table-row-form2">2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td class="custom-table-column-form2">   <select id="c2" name="c2" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr class="custom-tr-form2">
                    <th class="custom-table-row-form2">3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td class="custom-table-column-form2">   <select id="c3" name="c3" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr class="custom-tr-form2">
                    <th class="custom-table-row-form2">4. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td class="custom-table-column-form2">   <select id="c4" name="c4" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr class="custom-tr-form2">
                    <th class="custom-table-row-form2">5. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td class="custom-table-column-form2">   <select id="c5" name="c5" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                </table>
		   </div>

           <div class="form-group-eval-form2">
         <table class="custom-table-form2">
         <p class="eval-title">IV Correcteness</p>
                <tr class="custom-tr-form2">
                    <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td class="custom-table-column-form2">   <select id="d1" name="d1" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr class="custom-tr-form2">
                    <th class="custom-table-row-form2">2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td class="custom-table-column-form2">   <select id="d2" name="d2" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr class="custom-tr-form2">
                    <th class="custom-table-row-form2">3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td class="custom-table-column-form2">   <select id="d3" name="d3" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr class="custom-tr-form2">
                    <th class="custom-table-row-form2">4. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td class="custom-table-column-form2">   <select id="d4" name="d4" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr class="custom-tr-form2">
                    <th class="custom-table-row-form2">5. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td class="custom-table-column-form2">   <select id="d5" name="d5" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                </table>
		   </div>
           
            <div class="space"></div>
         
           <div class="text-group">
            <label id="lab3" for="remarks">Remarks:</label>
            <textarea id="remarks" name="remarks"></textarea>
        </div>

           
         
           <?php } ?>
           <div class="evaladd-but">
           <button class="evalbtn" type="button" onclick="generateEval()">Submit</button>
           </div>
     </form>
     
     <form action="" method="post" id="todolist">
        <div class="dashboard">
        <h1>To Do List of <span> PST <?php echo $rowfetchname['Name'] ?></span> </h1>
        
        <div class="logos">
            <div class="logo">
                <img src="resources/logo.png" alt="Logo 1" width="50">
            </div>
            <div class="logo">
                <img src="resources/ced.jpg" alt="Logo 2" width="50">
            </div>
        </div>
     </div>
     <div class="divider"></div>
     <div id="todoError"></div>
     <div class="horizontalTodo">
            <input type="hidden" name="SupID" value="<?php echo $_SESSION['ID']; ?>">
      
            <label id="todo">Todo:</label>
            <input type="text" name="" id="todoin" required>
            <label id="datetodo">Due: </label>
            <input type="date" name="" id="datetodoin" required>
    
        <button onclick="addTodo()" type="button" class="todobut">Post</button>
</div>


     <p class="prof-title">Cooperating Teacher Task</p>
<?php 
// Retrieving Handled Student
$TeachID = $_SESSION['ID'];
$sql3 = "SELECT * FROM teacher WHERE ID = $TeachID ";
$result3 = mysqli_query($conn, $sql3);

// If Else statement for running SQL query
if(!$result3)
{
 die(mysqli_error($conn));
}
if (mysqli_num_rows($result3) > 0) {
$techData = mysqli_fetch_array($result3);
}
$AccID = $techData['Student'];
$todo = $ponn->query("SELECT * FROM todolist WHERE AccID = $AccID");
                                                         
?>
             
<div id="updateTodo">
<?php $todo = $ponn->query("SELECT * FROM todolist WHERE AccID = $AccID"); ?>
<input type="hidden" name="StudID" id="StudID" value="<?php echo $AccID; ?>">    
<?php if($todo->rowCount() <= 0){ ?>
     <div class="todobox">
        <div class="rowtodo">
            <p class="titletodo">There is no assigned tasked</p>
            <p></p>
            </div>
    </div>
    <?php } ?>
    <?php 
    
    function hasDatePassed($dateString) {
        $today = date('Y-m-d');
        $dueDate = date('Y-m-d', strtotime($dateString));

        // Compare the dates
        return $dueDate < $today;
    }

    while($list = $todo->fetch(PDO::FETCH_ASSOC)) { 

        $hasPassed = hasDatePassed($list['Date']);

        if ($list['Checked'] == 1) { ?>
        <div class="todobox">
        <div class="rowtodo">
            <p class="titletodo" style="text-decoration: line-through;"><?php echo $list['Title'] ?></p>
            <p class="datetodo"><?php echo $list['Date'] ?></p>
            </div>
            <p class="listtodobut2" style="color: green; padding: 9px 30px;">Complete</p>
    </div>

<?php }else if ($hasPassed) { ?>
        <div class="todobox">
        <div class="rowtodo">
            <p class="titletodo" style="text-decoration: line-through;"><?php echo $list['Title'] ?></p>
            <p class="datetodo"><?php echo $list['Date'] ?></p>
            </div>
            <p class="listtodobut2" id="missing" style="color: red; padding: 9px 30px; margin-right: 1%;">Missed</p>
    </div>

<?php }else{ ?>
        
        <div class="todobox">
        <div class="rowtodo">
            <p class="titletodo"><?php echo $list['Title'] ?></p>
            <p class="datetodo"><?php echo $list['Date'] ?></p>
            </div>
            <button class="listtodobut" type="button" onclick="deletetodo(<?php echo $list['ID'] ?>)">Delete</button>
    </div>
    <?php }?>
    <?php } ?>
    </div>
      <div class="divider"></div>
     <div class="space"></div>
    </form>


    <form action="" method="post" id="profile">
    <div class="dashboard">
        <h1>Profile</h1>

        <div class="logos">
            <div class="logo">
                <img src="resources/logo.png" alt="Logo 1" width="50">
            </div>
            <div class="logo">
                <img src="resources/ced.jpg" alt="Logo 2" width="50">
            </div>
        </div>
     </div>

    <div class="divider"></div>
    <div class="prof-center">
<?php 
  $AccID = $_SESSION['ID'];
  $profsq = "SELECT * FROM teacher WHERE ID = $AccID AND Profile != ''";
  $profres = mysqli_query($conn,  $profsq);
  $images = mysqli_fetch_assoc($profres);
  if (mysqli_num_rows($profres) > 0) { 
 ?>
       <img class="profile-image" src="upload/<?=$images['Profile']?>">
          
<?php }else{?>
    <img class="profile-image" src="resources/default.jpeg">
<?php }?></div>
    <?php 
    // Fetch Student Information using ID 
    $AccID = $_SESSION['ID'];
    $getsq = "SELECT * FROM teacher WHERE ID = $AccID";
    $getres = mysqli_query($conn, $getsq);
    $getres2 = mysqli_query($conn, $getsq);

    $fetchstud = mysqli_fetch_assoc($getres2);
    $studid = $fetchstud['Student'];
    $fsql = "SELECT * FROM student WHERE ID = $studid";
    $resfsql = mysqli_query($conn, $fsql);
    $fetchname = mysqli_fetch_assoc($resfsql);

    ?>
<?php if (mysqli_num_rows($getres)) { ?>
    <?php 
           // Expansion of Table Value as long as rows are Fetched
             $i = 0;
             while($rows = mysqli_fetch_assoc($getres)){
             $i++;
           ?>
    <div class="indent-left">
        <p class="prof-title">Coordinating Teacher Profile</p>
        <table class="prof-table">
        <tr>
            <th class="profile-th">Name:</th>
            <td class="profile-td"><?php echo $rows['Name']; ?></td>
        </tr>
        <tr>
            <th class="profile-th">Email:</th>
            <td class="profile-td"><?php echo $rows['Username']; ?></td>
        </tr>
         <tr>
            <th class="profile-th">PST:</th>
            <td class="profile-td"><?php echo $fetchname['Name']; ?></td>
        </tr>
         <tr>
            <th class="profile-th">School:</th>
            <td class="profile-td"><?php echo $rows['School']; ?></td>
        </tr>
         <tr>
            <th class="profile-th">Division:</th>
            <td class="profile-td"><?php echo $rows['Division']; ?></td>
        </tr>
         <tr>
            <th class="profile-th">Grade:</th>
            <td class="profile-td"><?php echo $rows['Grade']; ?></td>
        </tr>
         <tr>
            <th class="profile-th">Coordinator:</th>
            <td class="profile-td"><?php echo $rows['Coordinator']; ?></td>
        </tr>
       
        </table>
    </div>

    <?php } ?>
    <?php } ?>
    <div class="space"></div>
<div class="divider"></div>
    <div class="button-container">
    <a  class="btn-primary" onclick="refProfileUp()">Edit</a>
</div>
  
</form>
<form action="" method="post" enctype="multipart/form-data" id="profileupdate">
        
        <?php 
                // Fetch Data from Database 
               $AccID = $_SESSION['ID'];
               $pupsql = "SELECT * FROM teacher WHERE ID = $AccID";
               $respupsql = mysqli_query($conn, $pupsql);
   
               // Checking querry 
               if(!$respupsql)
               {
                die(mysqli_error($conn));
               }
               if (mysqli_num_rows($respupsql) > 0) {
               $rowData = mysqli_fetch_array($respupsql);
               
               ?>
   
            
            <div class="dashboard">
        <h1>Set your Profile</h1>

        <div class="logos">
            <div class="logo">
                <img src="resources/logo.png" alt="Logo 1" width="50">
            </div>
            <div class="logo">
                <img src="resources/ced.jpg" alt="Logo 2" width="50">
            </div>
        </div>
     </div>

    <div class="divider"></div> 
    <div id="errorUpdate"></div>
            <style>
        #accid{
            display: none;
        }
        </style>

         <input type="text"
                  id="accid"
                  name="accid"
                  value="<?=$_SESSION['ID']?>"
                  hidden>
                  
               <div class="centered-container">
                   <div class="inner-container">
                   <input type="file" 
                      id="img" 
                      name="img"
                      class="choose" 
                      >
                   </div>
               </div>
       
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" 
                      class="form-control" 
                      id="name" 
                      name="name" 
                      placeholder=""
                      value="<?php echo $rowData['Name']; ?>" 
                                      required>
              </div>

              <div class="form-group">
                <label for="school">School</label>
                <input type="text" 
                      class="form-control" 
                      id="school" 
                      name="school" 
                      placeholder=""
                      value="<?php echo $rowData['School']; ?>" 
                                      required>
              </div>

              <div class="form-group">
                <label for="division">Division</label>
                <input type="text" 
                      class="form-control" 
                      id="division" 
                      name="division" 
                      placeholder=""
                      value="<?php echo $rowData['Division']; ?>" 
                                      required>
              </div>

              <div class="form-group">
                <label for="grade">Grade</label>
                <input type="text" 
                      class="form-control" 
                      id="grade" 
                      name="grade" 
                      placeholder=""
                      value="<?php echo $rowData['Grade']; ?>" 
                                      required>
              </div>

              <div class="form-group">
                <label for="coordinator">Coordinator</label>
                <input type="text" 
                      class="form-control" 
                      id="coordinator" 
                      name="coordinator" 
                      placeholder=""
                      value="<?php echo $rowData['Coordinator']; ?>" 
                                      required>
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" 
                      class="form-control" 
                      id="password" 
                      name="password"
                      placeholder="" 
                      value="<?php echo $rowData['Password']; ?>" 
                                      required>
              </div>
           
           <?php } ?>
            <div class="profile-button-box">
            <button onclick="updateProfile()" type="button" class="profeditbtn">Save</button>
            </div>
            <div class="space"></div>
<div class="divider"></div>
        </form>

		</section>

        <script src="cooperatingui.js"></script>
	</div>

</body>
</html>
<?php
}else{
     header("Location: index.php");
     exit();
}
?>

