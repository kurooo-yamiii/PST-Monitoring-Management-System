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
<title>Supervisor <?php echo $_SESSION['Name']; ?></title>
<link rel="icon" href="resources/cedlogo.png" type="image/x-icon">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	
	<link rel="stylesheet" href="superviui.css">
        <link rel="stylesheet" type="text/css" href="supervimedia.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

</head>
<body>
    <style>
        #studentList{
            display: none;
        }
        #studentadd{
            display: none;
        }
        #teachList{
            display: none;
        }
        #professoradd{
            display: none;
        }
        #pstDeployment{
          display:none;
        }
        #teachDeployment{
          display: none;
        }
        #statisticForm{
          display: none;
        }
        #statEval{
          display: none;
        }
        #dashboard{
            display: none;
        }
        #statboard{
            display: none;
        }
        #evalRemarks{
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
        #profilestud {
          display: none;
        }
       
      
    </style>
	<header class="header">
  <h2 class="u-name">RIZAL<b> TECHNOLOGICAL UNIVERSITY</b>
		</h2>
    <div class="dashboardstats">
    <span onclick="refStatForm()" class="material-icons-outlined">bar_chart</span>
		<span onclick="refreshDashboard()" class="material-icons-outlined">home</span>
      </div>
	</header>
	<div class="body">
		<nav class="side-bar">
			<div class="user-p">
            <?php 
          $SupervisorID = $_SESSION['ID'];
          $IDsq = "SELECT * FROM supervisor WHERE ID = $SupervisorID AND Profile != ''";
          $IDres = mysqli_query($conn,  $IDsq);
          $images = mysqli_fetch_assoc($IDres);
          if (mysqli_num_rows($IDres) > 0) { 
         ?>
               <img src="upload/<?=$images['Profile']?>">
          		
        <?php }else{?>
               <img  src="resources/default.jpeg">
        <?php }?>
        <?php 
         $SupervisorID= $_SESSION['ID'];
         $Namesq = "SELECT * FROM supervisor WHERE ID = $SupervisorID";
         $Nameres = mysqli_query($conn,  $Namesq);
         $name = mysqli_fetch_assoc($Nameres);
         if (mysqli_num_rows($Nameres) > 0) { 
            ?>
				<h4>Supervisor <?php echo $name['Name']?></h4>

                <?php }?>
			</div>
			<ul>
				<li id="studlistbut">
					<b onclick="refreshStudList()">
					<a style="text-decoration: none; color: #eee;">
					<div class="direction">
					<span class="material-icons-outlined">person_outline</span>
						<p>PST Account</p>
				    </div>
					</a>
					</b>
				</li>

				<li id="teachlistbut">
					<b onclick="refreshTeachList()">
					<a style="text-decoration: none; color: #eee;">
					<div class="direction">
					<span class="material-icons-outlined">people_alt</span>
						<p>RT Account</p>
				    </div>
					</a>
					</b>
				</li>

        <li id="deploybtn">
					<b onclick="refreshDeploy()">
					<a style="text-decoration: none; color: #eee;">
					<div class="direction">
					<span class="material-icons-outlined">person_pin_circle</span>
						<p>Deployment</p>
				    </div>
					</a>
					</b>
				</li>

				<li id="annbtn">
					<b onclick="refAnnouncement()">
					<a style="text-decoration: none; color: #eee;">
					<div class="direction">
					<span class="material-icons-outlined">campaign</span>
						<p>Announcement</p>
				    </div>
					</a>
					</b>
				</li>

				<li id="accbtn">
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
		<section class="section-1" id="sectionsss">
        
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
	<div class="card-container">

    <div class="card3">

	
	<div class="chart-container">
    <div class="bar" id="chart">
        <!-- Print my Student Graph -->
    </div>
</div>



<div class="row-total">
<?php 
           $studsql = "SELECT * FROM student";
           $studres = mysqli_query($conn,  $studsql);
           $numstud = mysqli_num_rows($studres);
           if ($numstud) {
    ?>
		<p class="total-row-space">RTU PST: </p>
		<h2><?= $numstud ?></h2>
</div>
<?php } ?>
    </div>

    <div class="card">

	
	<div class="chart-container">
    <div class="bar" id="chart3">
        <!-- Print my Student Graph -->
    </div>
</div>


<div class="row-total">
<?php 
           $studsql = "SELECT * FROM student";
           $studres = mysqli_query($conn,  $studsql);
           $numstud = mysqli_num_rows($studres);
           if ($numstud) {
    ?>
		<p class="total-row-space">RTU Pasig Coop-Teacher: </p>
		<h2><?= $numstud ?></h2>
</div>
<?php } ?>
    </div>

    <div class="card">
	<div class="chart-container">
    <div class="bar" id="chart2">
        <!-- Print my Cooperating Teacher Bar Graph -->
    </div>
</div>

<script>
    // Data for the categories and corresponding scores
    <?php
    // Gathering total students per Program
      $mathsql = "SELECT * FROM student WHERE Program ='BSE-Math'";
      $mathsqlres = mysqli_query($conn, $mathsql);
      $math = mysqli_num_rows($mathsqlres);

      $filsql = "SELECT * FROM student WHERE Program ='BSE-Filipino'";
      $filsqlres = mysqli_query($conn, $filsql);
      $fil = mysqli_num_rows($filsqlres);

      $engsql = "SELECT * FROM student WHERE Program ='BSE-English'";
      $engsqlres = mysqli_query($conn, $engsql);
      $eng = mysqli_num_rows($engsqlres);

      $socsql = "SELECT * FROM student WHERE Program ='BSE-Social-Studies'";
      $socsqlres = mysqli_query($conn, $socsql);
      $soc = mysqli_num_rows($socsqlres);

      $scisql = "SELECT * FROM student WHERE Program ='BSE-Science'";
      $scisqlres = mysqli_query($conn, $scisql);
      $sci = mysqli_num_rows($scisqlres);

      $csssql = "SELECT * FROM student WHERE Program ='BTVTED-CSS'";
      $csssqlres = mysqli_query($conn, $csssql);
      $css = mysqli_num_rows($csssqlres);

      $vgdsql = "SELECT * FROM student WHERE Program ='BTVTED-VGD'";
      $vgdsqlres = mysqli_query($conn, $vgdsql);
      $vgd = mysqli_num_rows($vgdsqlres);

      $anisql = "SELECT * FROM student WHERE Program ='BTVTED-Animation'";
      $anisqlres = mysqli_query($conn, $anisql);
      $ani = mysqli_num_rows($anisqlres);
    ?>
    const data = {
        MTH: <?php echo $math; ?>,
        FIL: <?php echo $fil; ?>,
        ENG: <?php echo $eng; ?>,
        SOC: <?php echo $soc; ?>,
        SCI: <?php echo $sci; ?>,
        CSS: <?php echo $css; ?>,
        VGD: <?php echo $vgd; ?>,
        ANI: <?php echo $ani; ?>,
    };

    const data2 = {
        ABIS: 13,
        CMS: 12,
        ERIS: 12,
        HHIS: 10,
        HIS: 15,
        IBIS: 11,
        ILIS: 10,
        JFMS: 12,
        MPG: 11,
        MHS: 10,
        RTU: 12
    };

    const data3 = {
        EHS: 11,
        KHS: 13,
        MHS: 14,
        NHS: 12,
        PHS: 15,
        RHS: 11,
        REP: 12,
        SGH: 10,
        SJK: 11,
        SHS: 10,
        SLH: 13
    };

  // Function to create vertical bars based on the data
  function createVerticalBars(chartId, data) {
        const chart = document.getElementById(chartId);
        const minBarHeight = 20;
        const maxValue = Math.max(...Object.values(data));
        for (const category in data) {
            const barContainer = document.createElement('div');
            barContainer.classList.add('bar-container');

            const bar = document.createElement('div');
            bar.classList.add('bar');

            // Calculate the scaling factor based on the maximum value
            const scaleFactor = maxValue > 0 ? (data[category] / maxValue) : 0;
            
            // Calculate the scaled bar height ensuring it's not below the minimum
            const scaledBarHeight = Math.max(scaleFactor * 100, minBarHeight);
            bar.style.height = `${scaledBarHeight}px`;

            const label = document.createElement('div');
            label.classList.add('label');
            label.textContent = data[category];

            const categoryLabel = document.createElement('div');
            categoryLabel.classList.add('category-label');
            categoryLabel.textContent = category;

            barContainer.appendChild(label);
            barContainer.appendChild(bar);
            barContainer.appendChild(categoryLabel);
            chart.appendChild(barContainer);
        }
    }

    // Call the function to create vertical bars for the first chart
    window.onload = function() {
        createVerticalBars('chart', data);
        createVerticalBars('chart2', data2);
        createVerticalBars('chart3', data3);
    };
</script>

<div class="row-total">
		<?php 
           $teachsql = "SELECT * FROM teacher";
           $teachres = mysqli_query($conn,  $teachsql);
           $numteach = mysqli_num_rows($teachres);
           if ($numteach) {
    ?>
		<p class="total-row-space">RTU Mandaluyong Coop-Teacher: </p>
		<h2><?= $numteach ?></h2>
</div>
<?php } ?>
    </div>
	

    <div class="card2">

    <div class="piehcart-justify">
    <canvas id="myPieChart" width="400" height="400"></canvas>

    <script>
  
    <?php
        // Fetching results for deployed and not deployed
        $depsql = "SELECT * FROM student WHERE Resource != ''";
        $depres = mysqli_query($conn,  $depsql);
        $deployed = mysqli_num_rows($depres);

        $standsql = "SELECT * FROM student WHERE Resource = ''";
        $standres = mysqli_query($conn,  $standsql);
        $standby = mysqli_num_rows($standres);

        $data = [$deployed, $standby];
        $labels = ['Deployed '. $deployed, 'Standby ' . $standby];
        $colors = ['#FFD700', '#000080'];
    ?>

    // Get the data from #goldPHP and convert it to JavaScript variables
    var file = <?php echo json_encode($data); ?>;
    var labels = <?php echo json_encode($labels); ?>;
    var colors = <?php echo json_encode($colors); ?>;

    // Get the canvas element
    var ctx = document.getElementById('myPieChart').getContext('2d');

    // Create the pie chart
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: file,
                backgroundColor: colors,
            }]
        },
        options: {
                plugins: {
                    legend: {
                        labels: {
                            color: 'black',
                            weight: 600
                        }
                    }
                }
            }
        });
</script>
  </div>
    </div>
  </div>

  <div class="eval-studd">
<h3>Recent Deployed PST</h3>
<?php    
$sql = "SELECT * FROM student WHERE Resource !='' ORDER BY ID DESC LIMIT 3";
			$result = mysqli_query($conn, $sql);
			?>
			<?php 
			// Display the record in Table
			if (mysqli_num_rows($result)) { ?>
			<table class="table table-striped">
			  <thead>
			    <tr>
			     
			      <th scope="col">Name</th>
			      <th scope="col">Program</th>
				  <th scope="col">Section</th>
				  <th scope="col">Resurce Teacher</th>
				  <th scope="col">Supervisor</th>
				 
		
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
			     
			      <td><?php echo $rows['Name']; ?></td>
				  <td><?php echo $rows['Program']; ?></td>
				  <td><?php echo $rows['Section']; ?></td>
				  <td><?php echo $rows['Resource']; ?></td>
                  <td><?php echo $rows['Supervisor']; ?></td>
			    </tr>
			    <?php } ?>
			  </tbody>
                  </table>
			  <?php }else{ ?>
				<table>
    <thead>
      <tr>
      <th scope="col">Name</th>
			      <th scope="col">Program</th>
				  <th scope="col">Section</th>
				  <th scope="col">Resurce Teacher</th>
				  <th scope="col">Supervisor</th>
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
    <form action="" method="post" id="studentList" >
            <?php
			// Retrieving total number of Student Account
            $sql2 = "SELECT * FROM student";
			$result2 = mysqli_query($conn, $sql2);
            $rowCount = mysqli_num_rows($result2)
			?>
<div class="dashboard">
<p class="announce-para">Student <span> (Pre-Service Teacher Account)</span> </p>
        
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
			// Student wether the DTR process succeeded or failed
			if (isset($_GET['success'])) { ?>
		    <div class="alert alert-success" role="alert">
			  <?php echo $_GET['success']; ?>
		    </div>
		    <?php } ?>
			<?php 
			// Retrieving user data from Student table 
         $searchTerm = "";

        $sqlsearch = "SELECT * FROM student";
        $resultsearch = mysqli_query($conn, $sqlsearch);
    
   
			?>
      <label for="search" class="search-label">Search:</label>
      <input type="text" name="search" id="search" placeholder="Enter your search term" class="search-input">

      <button type="button" onclick="searchRecords()" class="search-button">Search</button>
   
			<?php 
			// Display the record in Table
			if (mysqli_num_rows($resultsearch)) { ?>
			<table class="table table-striped" id="startuptable">
			  <thead>
			    <tr>
			     
			      <th scope="col">Name</th>
			      <th scope="col">Program</th>
				    <th scope="col">Section</th>
            <th scope="col">Delete</th>
            <th scope="col">Password</th>
				 
		
			    </tr>
			  </thead>
			  <tbody>
			  <?php 
			  // Continue adding rows depening to the Fetch Data
			  	   $i = 0;
			  	   while($rows = mysqli_fetch_assoc($resultsearch)){
			  	   $i++;
			  	 ?>
			    <tr>
			     
			      <td><?php echo $rows['Name']; ?></td>
				  <td><?php echo $rows['Program']; ?></td>
				  <td><?php echo $rows['Section']; ?></td>
                  <td><a href="javascript:void(0);" onclick="deleteRecord(<?php echo $rows['ID']; ?>);"
			      	     class="red-button">Delete</a> </td>
                          <td> <a href="javascript:void(0);" onclick="updateRecord(<?php echo $rows['ID']; ?>);"
			      	     class="blue-button">Set Default Password</a>
                    </td>
			    </tr>
			    <?php } ?>
			  </tbody>
			  <?php }else  ?>
			</table>
     
      <?php { ?>
        <div id="searchResults">
        <!-- Content will be dynamically loaded here -->
    </div>
    <?php }?>
      <div class="space"></div>
<div class="divider"></div>
            <div class="button-container">
            <a onclick="studentAdd()" class="btn-primary">Add PST Account</a>
        </div>
	</form>

  <form action="" method="post" id="teachList">
     
     <div class="dashboard">
     <p class="announce-para">Cooperating <span> Teacher Account</span> </p>
             
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
           // Retrieving user data from Student table 
              $searchTerm = "";
     
             $sqlsearch = "SELECT * FROM teacher";
             $resultsearch = mysqli_query($conn, $sqlsearch);
         
        
           ?>
           <label for="searchprof" class="search-label">Search:</label>
           <input type="text" name="searchprof" id="searchprof" placeholder="Enter your search term" class="search-input">
     
           <button type="button" onclick="searchprofRecords()" class="search-button">Search</button>
        
           <?php 
           // Display the record in Table
           if (mysqli_num_rows($resultsearch)) { ?>
           <table class="table table-striped" id="startupproftable">
             <thead>
               <tr>
                
                 <th scope="col">Name</th>
                 <th scope="col">School</th>
                 <th scope="col">Division</th>
                 <th scope="col">Delete</th>
                 <th scope="col">Password</th>
              
         
               </tr>
             </thead>
             <tbody>
             <?php 
             // Continue adding rows depening to the Fetch Data
                  $i = 0;
                  while($rows = mysqli_fetch_assoc($resultsearch)){
                  $i++;
                ?>
               <tr>
                
                 <td><?php echo $rows['Name']; ?></td>
               <td><?php echo $rows['School']; ?></td>
               <td><?php echo $rows['Division']; ?></td>
                       <td><a href="javascript:void(0);" onclick="deleteprofRecord(<?php echo $rows['ID']; ?>);"
                        class="red-button">Delete</a> </td>
                               <td> <a href="javascript:void(0);" onclick="updateprofRecord(<?php echo $rows['ID']; ?>);"
                        class="blue-button">Set Default Password</a>
                         </td>
               </tr>
               <?php } ?>
             </tbody>
             <?php }else  ?>
           </table>
          
           <?php { ?>
             <div id="searchprofResults">
             <!-- Content will be dynamically loaded here -->
         </div>
         <?php }?>
           <div class="space"></div>
     <div class="divider"></div>
                 <div class="button-container">
                 <a onclick="professorAdd()" class="btn-primary">Add Cooperating Teacher Account</a>
             </div>
       </form>   

       <form action="" method="post" id="professoradd">
        
        <div class="dashboard">
      <p class="announce-para">Create <span> Cooperating Teacher Account</span> </p>
              
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
      
      <div class="form-group"> 
      <div class="form-group2">
            <label for="email">Email</label>
            <div class="email-container">
            <input type="text" 
                  class="form-control" 
                  id="email" 
                  name="email"
                  pattern="[a-zA-Z0-9]+" 
                  title="Only letters and numbers are allowed"
                  value="<?php if(isset($_GET['email']))
                                  echo($_GET['email']); ?>" 
                      required>
            <div class="extension-email"><p>@rtu.ced.com</p></div>
            </div>
           </div>
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
         <select id="school" name="school" required>
                  <option value=""></option>
                                      <option value="Andres Bonifacio Integrated School">Andres Bonifacio Integrated School (ABIS)</option>
                                      <option value="City of Mandaluyong Science High School">City of Mandaluyong Science High School</option>
                                      <option value="Eulogio Rodriguez Integrated School">Eulogio Rodriguez Integrated School (ERIS)</option>
                                      <option value="Eusebio High School">Eusebio High School</option>
                                      <option value="Highway Hills Itegrated School">Highway Hills Itegrated School (HHIS)</option>
                                      <option value="Hulo Integrated School">Hulo Integrated School (HIS)</option>
                                      <option value="Ilaya Barangka Integrated School">Ilaya Barangka Integrated School (IBIS)</option>
                                      <option value="Isaac Lopez Integrated School">Isaac Lopez Integrated School (ILIS)</option>
                                      <option value="Jose Fabella Memorial School">Jose Fabella Memorial School (JFMS)</option>
                                      <option value="Mandaluyong High School">Mandaluyong High School (MHS)</option>
                                      <option value="Manggahan High School">Manggahan High School</option>
                                      <option value="Mataas na Paaralang Neptali A. Gonzales">Mataas na Paaralang Neptali A. Gonzales</option>
                                      <option value="Nagpayong High School">Nagpayong High School</option>
                                      <option value="Pinagbuhatan High School">Pinagbuhatan High School</option>
                                      <option value="Rizal Experimental Station and Pilot School">Rizal Experimental Station and Pilot School (REPSCI)</option>
                                      <option value="Rizal High School">Rizal High School</option>
                                      <option value="Rizal Technological University">Rizal Technological University (RTU)</option>
                                      <option value="Sagad High School">Sagad High School</option>
                                      <option value="San Joaquin-Kalawaan High School">San Joaquin-Kalawaan High School</option>
                                      <option value="Santolan High School">Santolan High School</option>
                                      <option value="Sta. Lucia High School">Sta. Lucia High School</option>
                                  </select>
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
		     <select id="grade" name="grade" required>
                  <option value=""></option>
                                      <option value="Grade 6">Grade 6 JHS</option>
                                      <option value="Grade 7">Grade 7 JHS</option>
                                      <option value="Grade 8">Grade 8 JHS</option>
                                      <option value="Grade 9">Grade 9 JHS</option>
                                      <option value="Grade 10">Grade 10 JHS</option>
                                      <option value="Grade 11">Grade 11 SHS</option>
                                      <option value="Grade 12">Grade 12 SHS</option>
                          
                                  </select>
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
                  <div class="form-group"> 
                <button type="submit" id="profAcc" class="form-but">Add</button>
                <div class="divider"></div>
           </div>
              </form>

  <form action="" method="post" id="studentadd">
        
  <div class="dashboard">
<p class="announce-para">Create <span> Pre-Service Teacher Account</span> </p>
        
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

           <style> #supervisor, #id{
               display: none;
           }</style>
   
            <div class="form-group">
            <input type="text" 
                  class="form-control" 
                  id="supervisor" 
                  name="supervisor"
                  value="<?php echo $_SESSION['Name']; ?>" 
                      hidden></div>
                                      <div class="form-group">
            <input type="id" 
                  class="form-control" 
                  id="id" 
                  name="id"
                  value="<?php echo $_SESSION['ID']; ?>" 
                      hidden>
   
           </div>

           <div class="form-group">
            <div class="form-group2">
            <label for="email">Email</label>
            <div class="email-container">
            <input type="text" 
                  class="form-control" 
                  id="email" 
                  name="email"
                  pattern="[a-zA-Z0-9]+" 
                  title="Only letters and numbers are allowed"
                  value="<?php if(isset($_GET['email']))
                                  echo($_GET['email']); ?>" 
                      required>
            <div class="extension-email"><p>@rtu.ced.com</p></div>
            </div>
          </div>
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
            <select id="section" name="section" required>
            <option value=""></option>
                                <option value="PCED-13-701P">PCED-13-701P</option>
                            </select>
          </div>
              <div class="form-group">
            <label for="program">Program</label>
            <select id="program" name="program" required>
            <option value=""></option>
                                <option value="BTVTED-CSS">BTVTED-CSS</option>
                                <option value="BTVTED-VGD">BTVTED-VGD</option>
                                <option value="BTVTED-Animation">BTVTED-Animation</option>
                                <option value="BSE-Math">BSE-Math</option>
                                <option value="BSE-English">BSE-English</option>
                                <option value="BSE-Science">BSE-Science</option>
                                <option value="BSE-Social-Studies">BSE-Social-Studies</option>
                                <option value="BSE-Filipino">BSE-Filipino</option>
                            </select>
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
            
      
          <div class="form-group"> 
          <button type="submit" id="studAcc" class="form-but">Add</button>
          <div class="divider"></div>
          </div>
        </form>

<form action="" method="post" id="pstDeployment">

		
<div class="dashboard">
<p class="announce-para">Deployment <span>Pre-Service Teachers</span> </p>
        
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
           // Search Container
            
           ?>
           <label for="depstudent" class="search-label">Search:</label>
           <input type="text" name="depstudent" id="depstudent" placeholder="Enter your search term" class="search-input">
     
           <button type="button" onclick="searchdeploystudent()" class="search-button">Search</button>
           <div class="space"></div>
           <input type="hidden" name="SupID" value="<?php echo $_SESSION['ID']; ?>">

       
           <div id="DeployResult">
             <!-- Content will be dynamically loaded here -->
         </div>
            <?php
            // Fetching Student that is not yet Deployed or Does not have a Coordinating Teacher 
          $studlist = $ponn->query("SELECT * FROM student WHERE Resource = ''");
       ?>
        <?php if($studlist->rowCount() <= 0){ ?>
          <div class="todo-item">
        
       
        <button class="removee-to-do" type="button">N/A</button> 
        <h2>All of the PST Student has been Deployed</h2>
        <br>
        <small>Note: If you want to undeploy student kindly delete his/her account and create new account</small>
    </div>
  
            <?php } ?>
            <div id="showstudent">
            <?php while($studdep = $studlist->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="todo-item">

                <button onclick="deploymentID(<?php echo $studdep['ID']; ?>)" class="removee-to-do" type="button">Deploy</button> 
                    <h2><?php echo $studdep['Name'] ?> <span class="ave"> <?php echo $studdep['Program'] ?> </span> </h2>
                    <br>
                    <small><?php echo $studdep['Section'] ?></small> 
                    <small>Supervisor: <?php echo $studdep['Supervisor'] ?></small> 
                </div>
            <?php } ?>
            </div>
            <div class="space"></div>
            <div class="divider"></div>
	</form>
  <form action="" method="post" id="teachDeployment">

		
<div class="dashboard">
<p class="announce-para">Deployment <span>Cooperating Teachers</span> </p>
        
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
        $supID = $_SESSION['ID'];
        $selectstud = "SELECT * FROM supervisor WHERE ID = $supID ";
        $selectstudres = mysqli_query($conn, $selectstud);
        $selstud = mysqli_fetch_assoc($selectstudres);
        if ($selstud){    
           ?>
             <input type="hidden" name="StudID" value="<?php echo $selstud['DepID']; ?>">
         <?php } ?>   
           <label for="depteach" class="search-label">Search:</label>
           <input type="text" name="depteach" id="depteach" placeholder="Enter your search term" class="search-input">
     
           <button type="button" onclick="searchdeployteach()" class="search-button">Search</button>
           <div class="space"></div>
          
           <div id="TeachResult">
             <!-- Content will be dynamically loaded here -->
         </div>
            <?php
            // Fetching Student that is not yet Deployed or Does not have a Coordinating Teacher 
          $proflist = $ponn->query("SELECT * FROM teacher WHERE Student = ''");
       ?>
        <?php if($proflist->rowCount() <= 0){ ?>
          <div class="todo-item">
        
       
        <button class="removee-to-do" type="button">N/A</button> 
        <h2>All of the Coordinating Teacher has been deployed</h2>
        <br>
        <small>Note: You can add and delete account in the RT Account button</small>
    </div>
  
            <?php } ?>
            <div id="showteach">
            <?php while($profdep = $proflist->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="todo-item">
                
                   <button onclick="deployTwoID(<?php echo $profdep['ID']; ?>)" class="removee-to-do" type="button">Deploy</button>  
                    <h2><?php echo $profdep['Name'] ?> <span id="yellow" class="ave"> <?php echo $profdep['School'] ?> </span> </h2>
                    <br>
                    <small><?php echo $profdep['Division'] ?></small> 
                    <small>Coordinator: <?php echo $profdep['Coordinator'] ?></small> 
                </div>
            <?php } ?>
            </div>
            <div class="space"></div>
            <div class="divider"></div>
	</form>
  <form method="post" id="statisticForm">
  <div class="dashboard">
      <p class="announce-para">Monitor <span> PST Progress</span> </p>
              
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
     
      <div class="statlistbtn">
          <a onclick="showStrand('BSE-Math')" class="btn-stats one">Math</a>
          <a onclick="showStrand('BSE-English')" class="btn-stats two">English</a>
          <a onclick="showStrand('BSE-Filipino')" class="btn-stats three">Filipino</a>
          <a onclick="showStrand('BSE-Science')" class="btn-stats four">Science</a>
          <a onclick="showStrand('BSE-Social-Studies')" class="btn-stats five">SocStud</a>
          <a onclick="showStrand('BTVTED-CSS')" class="btn-stats six">CSS</a>
          <a onclick="showStrand('BTVTED-VGD')" class="btn-stats seven">VGD</a>
          <a onclick="showStrand('BTVTED-Animation')" class="btn-stats eight">Animation</a>
      </div>
              
      <div class="space"></div>
      <?php 
           // Search Container
            
           ?>
           <label for="statpst" class="search-label">Search:</label>
           <input type="text" name="statpst" id="statpst" placeholder="Enter your search term" class="search-input">
     
           <button type="button" onclick="searchStatPst()" class="search-button">Search</button>
           <div class="lightspace"></div>

           <input type="hidden" id="SupID" name="SupID" value="<?php echo $_SESSION['ID']; ?>">

       
           <div id="StatResult">
             <!-- Content will be dynamically loaded here -->
         </div>
            <?php
            // Fetching Student that is not yet Deployed or Does not have a Coordinating Teacher 
          $statlist = $ponn->query("SELECT * FROM student WHERE Resource != ''");
       ?>
        <?php if($statlist->rowCount() <= 0){ ?>
          <div class="todo-item">
        
       
        <button class="removee-to-do" type="button">N/A</button> 
        <h2>No PST is currently Deployed</h2>
        <br>
        <small>Note: If you want to deploy student kindly go to deoplyment button</small>
    </div>
  
            <?php } ?>
            <div id="showstats">
            <?php while($statslist = $statlist->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="monitor">
                     <?php 
                                                         if ($statslist['Profile'] == '') {
                                                        ?>
                                                             <img  src="resources/default.jpeg" id="gridpic">
                                                              
                                                        <?php }else{?>
                                                              <img src="upload/<?=$statslist['Profile']?>" id="gridpic">
                                                        <?php }?>
                        
                    <span class="program"><?php echo $statslist['Program'] ?></span> 
                    <h2><?php echo $statslist['Name'] ?></h2>
				
                    <small><?php echo $statslist['Section'] ?></small> 
                    <small>Supervisor: <?php echo $statslist['Supervisor'] ?></small>
                                                       
                <?php
                   if ($statslist['Program'] == 'BSE-Math'){ ?>
                   <button onclick="statisticID(<?php echo $statslist['ID']; ?>)" class="math" id="s1" type="button">Monitor</button> 
                   <?php }else if($statslist['Program'] == 'BSE-English'){?>
                    <button onclick="statisticID(<?php echo $statslist['ID']; ?>)" class="english" id="s2" type="button">Monitor</button> 
                    <?php }else if ($statslist['Program'] == 'BSE-Filipino'){?>
                      <button onclick="statisticID(<?php echo $statslist['ID']; ?>)" class="filipino" id="s3" type="button">Monitor</button>
                      <?php }else if ($statslist['Program'] == 'BSE-Science'){?>
                      <button onclick="statisticID(<?php echo $statslist['ID']; ?>)" class="removee-to-do" id="s4" type="button">Monitor</button> 
                      <?php }else if ($statslist['Program'] == 'BSE-Social-Studies'){?>
                      <button onclick="statisticID(<?php echo $statslist['ID']; ?>)" class="socsci" id="s5" type="button">Monitor</button>
                      <?php }else if ($statslist['Program'] == 'BTVTED-CSS'){?>
                      <button onclick="statisticID(<?php echo $statslist['ID']; ?>)" class="btcss" id="s6" type="button">Monitor</button>
                      <?php }else if ($statslist['Program'] == 'BTVTED-VGD'){?>
                      <button onclick="statisticID(<?php echo $statslist['ID']; ?>)" class="btvgd" id="s7" type="button">Monitor</button>
                      <?php }else if ($statslist['Program'] == 'BTVTED-Animation'){?>
                      <button onclick="statisticID(<?php echo $statslist['ID']; ?>)" class="btani" id="s8" type="button">Monitor</button>     
                   <?php }else{?>
                    
                <button onclick="statisticID(<?php echo $statslist['ID']; ?>)" class="removee-to-do" id="s9" type="button">Monitor</button>
                <?php } ?> 
                   
                </div>
            <?php } ?>
            </div>

      <div class="space"></div>
            <div class="divider"></div>
  </form>
  
  <form id="statboard">
  <?php
     $statsup = $_SESSION['ID'];
     $statidsql = "SELECT * FROM supervisor WHERE ID = $statsup ";
     $statidres = mysqli_query($conn, $statidsql);
     $fetchstatid = mysqli_fetch_assoc($statidres);
     $StudID = $fetchstatid['StatID'];
     $namestatsql = "SELECT * FROM student WHERE ID = $StudID";
     $namestatres = mysqli_query($conn, $namestatsql);
     $fetchnamestat = mysqli_fetch_assoc($namestatres);

     ?>
  <div class="dashboard">
        <h1>PST <?php echo $fetchnamestat['Name'] ?> - DTR and Statistics</h1>

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
    $StudID = $fetchstatid['StatID'];
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
                            labels: <?php echo json_encode(range(1, count($scores))); ?>,
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
<div class="form-group3"> 
          <button onclick="refStatEval()" class="form-but2">Evaluation List</button>
          <button onclick="refProfilestud()" class="form-but3">Profile</button>
              </div>
              <div class="divider"></div>
</form>


<form action="" method="post" id="statEval">
    <?php
        $statsup = $_SESSION['ID'];
        $statidsql = "SELECT * FROM supervisor WHERE ID = $statsup ";
        $statidres = mysqli_query($conn, $statidsql);
        $fetchstatid = mysqli_fetch_assoc($statidres);
        $StudID = $fetchstatid['StatID'];
        $namestatsql = "SELECT * FROM student WHERE ID = $StudID";
        $namestatres = mysqli_query($conn, $namestatsql);
        $fetchnamestat = mysqli_fetch_assoc($namestatres);
    ?>
<div class="dashboard">
        <h1>Evaluation list of <span> PST <?php echo $fetchnamestat['Name'] ?></span> </h1>
        
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
$evals = $ponn->query("SELECT * FROM evaluation WHERE StudentID = $StudID");
?>
<?php if($evals->rowCount() <= 0){ ?>
    <div class="todo-item">
        <input type="hidden" name="evalID" value="<?php echo $eval['ID']; ?>">
       
        <button class="removee-to-do" type="button">N/A</button> 
        <h2>PST haven't been evaluated by the Coordinating Teacher</h2>
        <br>
        <small>Note: Ask the student to cooridnate with coordinating teacher with regards to you evaluation</small>
    </div>
<?php } ?>
<div class="show-todo-section">
<?php while($eval = $evals->fetch(PDO::FETCH_ASSOC)) { ?>
    <div class="todo-item">
        <input type="hidden" id ="RemID" name="RemID" value="<?php echo $eval['ID']; ?>">
        <input type="hidden" name="SupID" value="<?php echo $_SESSION['ID']; ?>">
       
        <button onclick="remarksDisplay()" class="removee-to-do" type="button">View</button> 
        <h2>Lesson/Topic: <?php echo $eval['Lesson'] ?> <span class="ave"> <?php echo $eval['Average'] ?> </span> </h2>
        <br>
        <small>Evaluated On: <?php echo $eval['Date'] ?></small>
    </div>
<?php } ?>


</div>
<div class="space"></div>
<div class="divider"></div>
<div class="form-group3"> 
          <button onclick="refStatBoard()" class="form-but3">Back</button>
        </div>
	</form>

<form action="" method="post" id="evalRemarks">
<div class="dashboard">
        <h1>Scores and <span> Remarks </h1>
        
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
// Reference Number to Fetch Data in Evaluation
$ID = $_SESSION['ID'];
$sqleval = "SELECT * FROM supervisor WHERE ID = $ID";
$rseval = mysqli_query($conn, $sqleval);

if(!$rseval)
{
die(mysqli_error($conn));
}

if ($rseval) {
$rsevaldata = mysqli_fetch_assoc($rseval);
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
         <div class="space"></div>
            <p class="remarks-label">Remarks: <?php echo $rs2data['Remarks'];?><p>
            <div class="divider">

            </div>
         
           <?php } ?>
           <div class="form-group3"> 
          <button onclick="refStatEval()" class="form-but3">Back</button>
        </div>
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
<div id="newannouncelist"></div>
<div id="announcelist">
       <?php     
            $posts = $ponn->query("SELECT * FROM announce");
       ?>
            <?php while($post = $posts->fetch(PDO::FETCH_ASSOC)) { ?>
                <?php if( $post['Picture'] == ''){ ?>
                    <div class="todo-item">
				    <a 
			      	    class="date-pin" onclick="deleteAnnounce(<?php echo $post['ID']?>)"><?php echo $post['Date']?></a> <br>
                        <h2><?php echo $post['Post']?>
                    </h2>
                <br>
            <small>- <?php echo $post['Author']?></small> 
            </div>
              <?php  }else{ ?>
                <div class="todo-item">
				    <a 
			      	    class="date-pin" onclick="deleteAnnounce(<?php echo $post['ID']?>)"><?php echo $post['Date']?></a> <br>
                            <div class="empty">
                            <div class="pic-announce">
                             <img src="upload/<?php echo $post['Picture']?>">
                             </div>
                             <div class="pic-description">
                             <h2><?php echo $post['Post']?>
                                </h2>
                                <br>
                            <small>- <?php echo $post['Author']?></small> 
                             </div>
                            </div>
                      
            </div>
            <?php } ?>
            <?php } ?>
              </div>
            <div class="todo-item">
            <input type="hidden" name="SupID" value="<?php echo $_SESSION['ID']; ?>">
        <div class="post-group">
            <label for="post" id="plab1">Post:</label>
            <textarea  name="post" id="post" rows="4" placeholder="Enter announcement here..." required></textarea>
        </div>
        <div class="post-group">
            <div class="choose-post">
            <label for="img" id="plab2">Img: </label>
            <input type="file" name="img" id="choosepost">
            </div>
            <button onclick="postAnnouncement()" type="button">Post</button>
        </div>
</div>

           
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
  $profsq = "SELECT * FROM supervisor WHERE ID = $AccID AND Profile != ''";
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
    $getsq = "SELECT * FROM supervisor WHERE ID = $AccID";
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
        <p class="prof-title">Supervisor Profile</p>
        <table class="prof-table">
        <tr>
            <th class="profile-th">Name:</th>
            <td class="profile-td"><?php echo $rows['Name']; ?></td>
        </tr>
        <tr>
            <th class="profile-th">Email:</th>
            <td class="profile-td"><?php echo $rows['Username']; ?></td>
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
               $pupsql = "SELECT * FROM supervisor WHERE ID = $AccID";
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
            <button onclick="updateProfile()" id="centerbtn" type="button">Save</button>
            </div>
            <div class="space"></div>
<div class="divider"></div>
        </form>


<form action="" method="post" id="profilestud">

<?php
  $statsup = $_SESSION['ID'];
  $statidsql = "SELECT * FROM supervisor WHERE ID = $statsup ";
  $statidres = mysqli_query($conn, $statidsql);
  $fetchstatid = mysqli_fetch_assoc($statidres);
  $StudID = $fetchstatid['StatID'];
  $namestatsql = "SELECT * FROM student WHERE ID = $StudID";
  $namestatres = mysqli_query($conn, $namestatsql);
  $fetchnamestat = mysqli_fetch_assoc($namestatres);

 ?>
    <div class="dashboard">
        <h1>Profile of PST <?php echo $fetchnamestat['Name']; ?></h1>

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
    <?php $profsq = "SELECT * FROM student WHERE ID = $StudID AND Profile != ''";
  $profres = mysqli_query($conn,  $profsq);
  $images = mysqli_fetch_assoc($profres);
  if (mysqli_num_rows($profres) > 0) { ?>
       <img class="profile-image" src="upload/<?=$images['Profile']?>">
          
<?php }else{?>
      <img class="profile-image" src="resources/default.jpeg">
<?php }?></div>
    <?php 
    // Fetch Student Information using ID 
    $getsq = "SELECT * FROM student WHERE ID = $StudID";
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
    <div class="space"></div>
<div class="divider"></div>
<div class="form-group3"> 
          <button onclick="refStatBoard()" class="form-but3">Back</button>
        </div>
  
</form>
    </section>

        <script src="superviui.js"></script>
	</div>

</body>
</html>
<?php
}else{
     header("Location: index.php");
     exit();
}
?>