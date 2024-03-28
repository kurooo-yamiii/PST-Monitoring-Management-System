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

<title>PST <?php echo $_SESSION['Name']; ?></title>
<link rel="icon" href="resources/cedlogo.png" type="image/x-icon">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="studentui.js"></script>

      

	<link rel="stylesheet" href="studentui.css">
    <link rel="stylesheet" href="studentmedia.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

</head>
<body>
    <style>
        #dtr{
            display: none;
        }
        #addDtr{
            display: none;
        }
        #showEval{
            display: none;
        }
        #displayEval{
            display: none;
        }
        #announcement{
            display: none;
        }
        #profile{
            display: none;
        }
        #profileupdate{
            display: none;
        }
        #dashboard{
            display: none;
        }
        #todolist {
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
          $IDsq = "SELECT * FROM student WHERE ID = $StudID AND Profile != ''";
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
         $Namesq = "SELECT * FROM student WHERE ID = $StudID";
         $Nameres = mysqli_query($conn,  $Namesq);
         $name = mysqli_fetch_assoc($Nameres);
         if (mysqli_num_rows($Nameres) > 0) { 
            ?>
				<h4>PST <?php echo $name['Name']?></h4>

                <?php }?>
			</div>
			<ul>
				<li id="dtrbtn">
					<b onclick="refreshDtr()">
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

				<li id="anounbtn">
					<b onclick="showAnou()">
					<a style="text-decoration: none; color: #eee;">
					<div class="direction">
					<span class="material-icons-outlined">campaign</span>
						<p>Announcement</p>
				    </div>
					</a>
					</b>
				</li>

				<li id="todobtn">
					<b onclick="refTodoList()">
					<a style="text-decoration: none; color: #eee;">
					<div class="direction">
					<span class="material-icons-outlined">checklist</span>
						<p>To-Do-List</p>
				    </div>
					</a>
					</b>
				</li>

				<li id="profbtn">
					<b onclick="refreshProf()">
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
    <?php
    $StudID = $_SESSION['ID'];
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
      
      <h2> Evaluation Statistic Total average of <?php echo $totalave ?></h2>

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
                                borderColor: 'rgba(0, 0, 128, 1)',
                                backgroundColor: 'rgba(0, 0, 128, 0.1)', 
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
      <h2>Scores and Ratings</h2>
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
            backgroundColor: 'rgba(255, 215, 0, 0.7)',
            borderColor: 'rgba(255, 215, 0, 1)',
            borderWidth: 3
        },
        {
            label: 'Clearness',
            data: <?php echo json_encode($bt); ?>,
            borderColor: 'rgba(0, 0, 128, 1)',
            backgroundColor: 'rgba(0, 0, 128, 0.7)',
            borderWidth: 3
        },
        {
            label: 'Clarity',
            data: <?php echo json_encode($ct); ?>,
            borderColor: 'rgba(192, 192, 192, 1)',
            backgroundColor: 'rgba(192, 192, 192, 0.7)',
            borderWidth: 3
        },
        {
            label: 'Correcteness',
            data: <?php echo json_encode($dt); ?>,
            borderColor: 'rgba(255, 141, 105, 1)',
            backgroundColor: 'rgba(255, 141, 105, 0.7)',
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
    
<div class="eval-studd">
<h3>Recent DTR</h3>
<?php    
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
     </form>

<!--Here goes another form for DTR -->
<form action="" method="post" id="dtr">
            <?php
			// Retrieving Data from the User Account
            $AccID = $_SESSION['ID'];
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
        <h1>Daily Time Record </h1>
        
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
         <input type="text"
                  id="accid"
                  name="accid"
                  value="<?=$_SESSION['ID']?>"
                  hidden>
		<div class="sortalign" id="sortalign">
        <select id="datee" name="datee" onchange="fetchData()" required>
    		<option value="2024-01">January 2024</option>
    		<option value="2024-02">February 2024</option>
   			 <option value="2024-03">March 2024</option>
                	 <option value="2024-04">April 2024</option>
                	 <option value="2024-05">May 2024</option>
                	 <option value="2024-06">June 2024</option>
                	 <option value="2024-07">July 2024</option>
                 <option value="2024-08">August 2024</option>
		</select>
                </div>
			<?php 
			// Display wether the DTR process succeeded or failed
			if (isset($_GET['success'])) { ?>
		    <div class="alert alert-success" role="alert">
              
			  <?php echo $_GET['success']; ?>
		    </div>
        	
        
		    <?php } ?>
        	<div id="sortresult">
            </div>        
        	<div id="sort">
			<?php 
			// Retrieving user data from DTR table 
			$AccID = $_SESSION['ID'];
			$sql = "SELECT * FROM dtr WHERE AccID = $AccID";
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
       
            <div class="button-container">
  
            <a onclick="AddDtr()" class="btn-primary">Log DTR</a>
                       <a onclick="generatePDF()" class="btn-primary">Print</a>
                    <script>
    window.jsPDF = window.jspdf.jsPDF;
</script>
                    
        </div>
        <div class="divider"></div>
            <h1 id="totalacc">Total accumulated time <?php echo $hours?> hours and <?php echo $minutes?> minutes</h1>
	</form>

    <form id="addDtr">

    <div class="dashboard">
        <h1>List Daily Time Record </h1>
        
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

		

		   <div id="dtrfailed">
			  
		    </div>
		
           <input type="text"
                  id="accid"
                  name="accid"
                  value="<?=$_SESSION['ID']?>"
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

            <div class="form-but">
           <button type="button" id="insertDtr">Log</button>
           </div>

           <div class="divider"></div>
	    </form>

       
<form action="studentui.php" method="post" id="showEval">
<div class="dashboard">
        <h1>Evaluation list of <span> PST <?php echo $_SESSION['Name'] ?></span> </h1>
        
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
     <div class="space"></div>
<?php 
$StudID = $_SESSION['ID'];
$evals = $ponn->query("SELECT * FROM evaluation WHERE StudentID = $StudID");
?>
<?php if($evals->rowCount() <= 0){ ?>
    <div class="todo-item">
        <input type="hidden" name="evalID" value="<?php echo $eval['ID']; ?>">
       
        <button class="removee-to-do" type="button">N/A</button> 
        <h2>You haven't been evaluated by your Coordinating Teacher</h2>
        <br>
        <small>Note: Please cooridnate with your coordinating teacher with regards to you evaluation</small>
    </div>
<?php } ?>
<div class="show-todo-section">
<?php while($eval = $evals->fetch(PDO::FETCH_ASSOC)) { ?>
    <div class="todo-item">
        <input type="hidden" name="evalID" value="<?php echo $eval['ID']; ?>">
       
        <button onclick="refreshEval(this)" class="removee-to-do" type="button">View</button> 
        <h2>Lesson/Topic: <?php echo $eval['Lesson'] ?> <span class="ave"> <?php echo $eval['Average'] ?> </span> </h2>
        <br>
        <small>Evaluated On: <?php echo $eval['Date'] ?></small>
    </div>
<?php } ?>


</div>
<div class="space"></div>
<div class="divider"></div>
	</form>

<form action="" method="post" id="displayEval">
    <div id="resultView" >
   
    </div>
    <?php
// Reference Number to Fetch Data in Evaluation
$ID = $_SESSION['ID'];
$sqleval = "SELECT * FROM student WHERE ID = $ID";
$rseval = mysqli_query($conn, $sqleval);

if(!$rseval)
{
die(mysqli_error($conn));
}
if (mysqli_num_rows($rseval) > 0) {
$rsevaldata = mysqli_fetch_array($rseval);
$EvalID = $rsevaldata['EvalID'];
}

  $sql2 = "SELECT * FROM evaluation WHERE ID = $EvalID";
            $rs2 = mysqli_query($conn, $sql2);

            if(!$rs2)
            {
            die(mysqli_error($conn));
            }
            if (mysqli_num_rows($rs2) > 0) {
            $rs2data = mysqli_fetch_array($rs2);
            $AccID = $_SESSION['ID'];
            ?>
<div class="goldview" id="goldview">
         <h1><?php echo $rs2data['Lesson'];?></h1>
         <p><?php echo $rs2data['Date'];?> : Total Average of <?php echo $rs2data['Average'];?></p>
         </div>
		  
         <div class="form-group-eval-form2">
  <table class="custom-table-form2">
  <p class="eval-title">I. Conciseness <span><?php echo $rs2data['aT'] . '%';?></span></p>
    <tbody>
      <tr class="custom-tr-form2">
        <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
        <td class="custom-table-column-form2"><?php echo $rs2data['a1'];?></td>
      </tr>
      <tr class="custom-tr-form2">
        <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
        <td class="custom-table-column-form2"><?php echo $rs2data['a2'];?></td>
      </tr>
      <tr class="custom-tr-form2">
        <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
        <td class="custom-table-column-form2"><?php echo $rs2data['a3'];?></td>
      </tr>
      <tr class="custom-tr-form2">
        <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
        <td class="custom-table-column-form2"><?php echo $rs2data['a4'];?></td>
      </tr>
      <tr class="custom-tr-form2">
        <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
        <td class="custom-table-column-form2"><?php echo $rs2data['a5'];?></td>
      </tr>
        </tbody>
    </table>
</div>
           <div class="form-group-eval-form2">
         <table class="custom-table-form2">
                <p class="eval-title">II. Coherence <span><?php echo $rs2data['bT'] . '%';?></span></p>
                <tbody>
      <tr class="custom-tr-form2">
        <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
        <td class="custom-table-column-form2"><?php echo $rs2data['b1'];?></td>
      </tr>
      <tr class="custom-tr-form2">
        <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
        <td class="custom-table-column-form2"><?php echo $rs2data['b2'];?></td>
      </tr>
      <tr class="custom-tr-form2">
        <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
        <td class="custom-table-column-form2"><?php echo $rs2data['b3'];?></td>
      </tr>
      <tr class="custom-tr-form2">
        <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
        <td class="custom-table-column-form2"><?php echo $rs2data['b4'];?></td>
      </tr>
      <tr class="custom-tr-form2">
        <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
        <td class="custom-table-column-form2"><?php echo $rs2data['b5'];?></td>
      </tr>
        </tbody>
                </table>
		   </div>

           <div class="form-group-eval-form2">
  <table class="custom-table-form2">
  <p class="eval-title">III. Clarity <span><?php echo $rs2data['cT'] . '%';?></span></p>
    <tbody>
      <tr class="custom-tr-form2">
        <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
        <td class="custom-table-column-form2"><?php echo $rs2data['c1'];?></td>
      </tr>
      <tr class="custom-tr-form2">
        <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
        <td class="custom-table-column-form2"><?php echo $rs2data['c2'];?></td>
      </tr>
      <tr class="custom-tr-form2">
        <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
        <td class="custom-table-column-form2"><?php echo $rs2data['c3'];?></td>
      </tr>
      <tr class="custom-tr-form2">
        <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
        <td class="custom-table-column-form2"><?php echo $rs2data['c4'];?></td>
      </tr>
      <tr class="custom-tr-form2">
        <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
        <td class="custom-table-column-form2"><?php echo $rs2data['c5'];?></td>
      </tr>
        </tbody>
    </table>
</div>

<div class="form-group-eval-form2">
  <table class="custom-table-form2">
  <p class="eval-title">IV Correcteness <span><?php echo $rs2data['dT'] . '%';?></span></p>
    <tbody>
      <tr class="custom-tr-form2">
        <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
        <td class="custom-table-column-form2"><?php echo $rs2data['d1'];?></td>
      </tr>
      <tr class="custom-tr-form2">
        <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
        <td class="custom-table-column-form2"><?php echo $rs2data['d2'];?></td>
      </tr>
      <tr class="custom-tr-form2">
        <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
        <td class="custom-table-column-form2"><?php echo $rs2data['d3'];?></td>
      </tr>
      <tr class="custom-tr-form2">
        <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
        <td class="custom-table-column-form2"><?php echo $rs2data['d4'];?></td>
      </tr>
      <tr class="custom-tr-form2">
        <th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
        <td class="custom-table-column-form2"><?php echo $rs2data['d5'];?></td>
      </tr>
        </tbody>
    </table>
</div>
         
            <label for="remarks" class="remarks-label">Remarks: <?php echo $rs2data['Remarks'];?></label>
            <div class="divider">
        
            </div>
         
           <?php } ?>
     	
</form>
<form action="" method="post" id="announcement">
<div class="dashboard">
<p class="announce-para">Updates and<span> Announcement</span> </p>
        
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
<?php     
            $posts = $ponn->query("SELECT * FROM announce");
       ?>
            <?php while($post = $posts->fetch(PDO::FETCH_ASSOC)) { ?>
                <?php if( $post['Picture'] == ''){ ?>
                    <div class="todo-item">
				    <a href="" 
			      	    class="date-pin"><?php echo $post['Date']?></a> <br>
                        <h2><?php echo $post['Post']?>
                    </h2>
                <br>
            <small>- <?php echo $post['Author']?></small> 
            </div>
              <?php  }else{ ?>
                <div class="todo-item" id="announcebox">
				    <a href="" 
			      	    class="date-pin"><?php echo $post['Date']?></a> <br>
                            <div class="empty">
                            <div class="pic-announce">
                             <img src="upload/<?php echo $post['Picture']?>">
                             </div>
                             <div class="pic-description">
                             <h2 id="postfont"><?php echo $post['Post']?>
                                </h2>
                                <br>
                            <small id="announcesmall">- <?php echo $post['Author']?></small> 
                             </div>
                            </div>
                      
            </div>
            <?php } ?>
            <?php } ?>
        <div class="space"></div>
<div class="divider"></div>

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
  $profsq = "SELECT * FROM student WHERE ID = $AccID AND Profile != ''";
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
    $getsq = "SELECT * FROM student WHERE ID = $AccID";
    $getres = mysqli_query($conn, $getsq);
    ?>
<?php if (mysqli_num_rows($getres)) { ?>
    <?php 
           // Expansion of Table Value as long as rows are Fetched
             $i = 0;
             while($rows = mysqli_fetch_assoc($getres)){
             $i++;
           ?>
    <div class="indent-left">
        <p class="prof-title">I. Profile of the Student</p>
        <table class="prof-table">
        <tr>
            <th class="profile-th">Name:</th>
            <td class="profile-td"><?php echo $rows['Name']; ?></td>
        </tr>
        <tr>
            <th class="profile-th">Section:</th>
            <td class="profile-td"><?php echo $rows['Section']; ?></td>
        </tr>
        <tr>
            <th class="profile-th">Program:</th>
            <td class="profile-td"><?php echo $rows['Program']; ?></td>
        </tr>
        <tr>
            <th class="profile-th">Contact:</th>
            <td class="profile-td"><?php echo $rows['Contact']; ?></td>
        </tr>
        <tr>
            <th class="profile-th">Email:</th>
            <td class="profile-td"><?php echo $rows['Username']; ?></td>
        </tr>
        </table>
    </div>

    <div class="indent-left">
        <p class="prof-title">II. Deployment Info</p>
        <table class="prof-table">
        <tr>
            <th class="profile-th">Supervisor:</th>
            <td class="profile-td"><?php echo $rows['Supervisor']; ?></td>
        </tr>
        <tr>
            <th class="profile-th">Coordinator:</th>
            <td class="profile-td"><?php echo $rows['Coordinator']; ?></td>
        </tr>
        <tr>
            <th class="profile-th">School:</th>
            <td class="profile-td"><?php echo $rows['School']; ?></td>
        </tr>
        <tr>
            <th class="profile-th">Resource Teacher:</th>
            <td class="profile-td"><?php echo $rows['Resource']; ?></td>
        </tr>
        <tr>
            <th class="profile-th">Division:</th>
            <td class="profile-td"><?php echo $rows['Division']; ?></td>
        </tr>
        <tr>
            <th class="profile-th">Grade Level:</th>
            <td class="profile-td"><?php echo $rows['Grade']; ?></td>
        </tr>
        </table>
    </div>
    <?php } ?>
    <?php } ?>
    <div class="space" id="adjustspace"></div>
<div class="divider"></div>
    <div class="button-container">
    <a href="studentui.php" class="btn-primary" onclick="refreshprofileUp()">Edit</a>
</div>
  
</form>
<form method="post" enctype="multipart/form-data" id="profileupdate">
        
        <?php 
                // Fetch Data from Database 
               $AccID = $_SESSION['ID'];
               $pupsql = "SELECT * FROM student WHERE ID = $AccID";
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

            <style>
        #accid{
            display: none;
        }
        </style>
            <div id="updatefeedback"> 

            
            </div>
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
                <label for="section">Section</label>
                <input type="section" 
                      class="form-control" 
                      id="section" 
                      name="section"
                      placeholder="" 
                      value="<?php echo $rowData['Section']; ?>" 
                                      required>
              </div>
              <div class="form-group">
                <label for="program">Program</label>
                <input type="program" 
                      class="form-control" 
                      id="program" 
                      name="program"
                      placeholder="" 
                      value="<?php echo $rowData['Program']; ?>" 
                                      required>
              </div>
              <div class="form-group">
                <label for="contact">Contact</label>
                <input type="contact" 
                      class="form-control" 
                      id="contact" 
                      name="contact"
                      placeholder="" 
                      value="<?php echo $rowData['Contact']; ?>" 
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
            <button class="btn-save" onclick="setProfile()" type="button">Save</button>
            </div>
           
            <div class="space"></div>
            <div class="divider"></div>
        
</form>
<form action="" method="post" id="todolist">
        <div class="dashboard">
        <h1>To Do List of <span> PST <?php echo $_SESSION['Name'] ?></span> </h1>
        
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
    
<p class="prof-title">List of Task</p>
<?php 

$AccID = $_SESSION['ID'];
$todo = $ponn->query("SELECT * FROM todolist WHERE AccID = $AccID");
?>
<div id="todoError"></div>
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
             <button class="listtodobut" type="button" onclick="deletetodo(<?php echo $list['ID'] ?>)">Mark as Done</button>
    </div>
    <?php }?>
    <?php } ?>
    </div>
      <div class="divider"></div>
     <div class="space"></div>
    </form>

		</section>

        <script src="studentui.js"></script>
	</div>

</body>
</html>
<?php
}else{
     header("Location: index.php");
     exit();
}
?>