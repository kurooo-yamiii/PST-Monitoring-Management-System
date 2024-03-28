<?php
// Getting the User Account ID
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="document.css">
</head>
<body>
<?php
        // Gettind ID of Pre-Service Teacher
        $StudID = $_GET['AccID'];
        $sql3 = "SELECT * FROM student WHERE ID = $StudID";
        $rs3 = mysqli_query($conn, $sql3);
        if(!$rs3)
        {
         die(mysqli_error($conn));
        }
        if (mysqli_num_rows($rs3) > 0) {
        $rs3row = mysqli_fetch_array($rs3);
        }
        $Name = $rs3row['Name'];
        ?>

<form action="studentui.php" method="post">
           

			<p>Evaluation list of <span> PST <?php echo $rs3row['Name'] ?></span> </p><br>
			<?php 
          $evals = $ponn->query("SELECT * FROM evaluation WHERE StudentID = $StudID");
       ?>
        <?php if($evals->rowCount() <= 0){ ?>
                    <div class="empty">
                    <img src="resources/tooltip.jpg" width="100%" >
                    <p>No evaluation record found</p>
                    </div>
            <?php } ?>
       <div class="show-todo-section">
           
                

            <?php while($eval = $evals->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="todo-item">

				<a href="evalview.php?ID=<?php echo $eval['ID']?>&Name=<?php echo $rs3row['Name'] ?>"
                class="remove-to-do">View</a>
                        <h2>Lesson/Topic: <?php echo $eval['Lesson'] ?> <span class="ave"> <?php echo $eval['Average'] ?> </span> </h2>
                    <br>
                    <small>Evaluated On: <?php echo $eval['Date'] ?></small> 
                </div>
            <?php } ?>

                <?php
                // Use for getting all the averages of data that was fetch in the table
                $sql = "SELECT AVG(average) as average_value FROM evaluation WHERE StudentID = $StudID";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $averageValue = $row["average_value"];
                        $totalave = intval($averageValue) . "%";
                    }
                } 
                // Starts creating arrays and querries to catch student average
                $scores = [0];
                $tablequery = "SELECT REPLACE(Average, '%', '') as cleaned_score FROM evaluation WHERE StudentID = $StudID ORDER BY ID DESC
                LIMIT 5";
                $rowquery = $conn->query($tablequery);
                 if ($rowquery->num_rows > 0) {
                // Output data of each row
                while($datarow = $rowquery->fetch_assoc()) {
                    $scores[] = $datarow['cleaned_score'];
                   
                }
                }
                ?>
                    <canvas id="scoreChart" width="400" height="200"></canvas>

                    <script>
                    // Use Chart.js to create a line chart
                    var ctx = document.getElementById('scoreChart').getContext('2d');
                    var chart = new Chart(ctx, {
                        type: "line",
                        data: {
                            labels: <?php echo json_encode(range(1, count($scores))); ?>,
                            datasets: [{
                                label: 'Statistical Data Evaluation of <?php echo $rs3row['Name'] ?> with a Total average of <?php echo $totalave ?>',
                                data: <?php echo json_encode($scores); ?>,
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 5,  
                            }]
                             },
                        options: {
                        scales: {
                        y: { beginAtZero: true }
                                 },
                        plugins: {
                        tooltip: {
                        callbacks: {
                        label: function(context) {
                        return context.dataset.label + ': ' + context.parsed.y + '%';
                                  }
                              }
                          }
                         },
                        afterDatasetsDraw: function (chart, easing) {
                            var ctx = chart.ctx;
                            chart.data.datasets.forEach(function (dataset, datasetIndex) {
                                var meta = chart.getDatasetMeta(datasetIndex);
                                meta.data.forEach(function (bar, index) {
                                    var data = dataset.data[index];
                                    var xPos = bar.tooltipPosition().x; 
                                    var yPos = bar.tooltipPosition().y - 5; 
                                    ctx.fillStyle = 'black'; 
                                    ctx.font = '12px Arial';
                                    ctx.fillText(data + '%', xPos, yPos);
                                });
                            });
                        }
                        }
                    });
                    </script>

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



<canvas id="varChart" width="400" height="200"></canvas>

<script>
// Chart for Evaluation (4 Variables)
var ctx = document.getElementById('varChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode(range(1, count($at))); ?>,
        datasets: [{
            label: 'Conciseness',
            data: <?php echo json_encode($at); ?>,
            backgroundColor: 'rgba(255, 215, 0, 1)',
            borderColor: 'rgba(0, 0, 0, 1)',
            borderWidth: 1
        },
        {
            label: 'Clearness',
            data: <?php echo json_encode($bt); ?>,
            borderColor: 'rgba(0, 0, 0, 1)',
            backgroundColor: 'rgba(0, 0, 128, 1)',
            borderWidth: 1
        },
        {
            label: 'Clarity',
            data: <?php echo json_encode($ct); ?>,
            borderColor: 'rgba(0, 0, 0, 1)',
            backgroundColor: 'rgba(192, 192, 192, 1)',
            borderWidth: 1
        },
        {
            label: 'Correcteness',
            data: <?php echo json_encode($dt); ?>,
            borderColor: 'rgba(0, 0, 0, 1)',
            backgroundColor: 'rgba(255, 141, 105, 1)',
            borderWidth: 1
        }
    ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
        tooltip: {
            callbacks: {
                label: function(context) {
                    return context.dataset.label + ': ' + context.parsed.y + '%';
                                    }
                                }
                            }
                        },
                        afterDatasetsDraw: function (chart, easing) {
        // Draw scores next to data points
        var ctx = chart.ctx;
        chart.data.datasets.forEach(function (dataset, datasetIndex) {
            var meta = chart.getDatasetMeta(datasetIndex);
            meta.data.forEach(function (bar, index) {
                var data = dataset.data[index];
                var xPos = bar.tooltipPosition().x; // Use tooltip position for better accuracy
                var yPos = bar.tooltipPosition().y - 5; // Adjust the position of the text
                ctx.fillStyle = 'black'; // Color of the text
                ctx.font = '12px Arial';
                ctx.fillText(data + '%', xPos, yPos);
            });
        });
    }

    } 
});
</script>
<?php
$scores = [0];
                $tablequery = "SELECT REPLACE(Average, '%', '') as cleaned_score FROM evaluation WHERE StudentID = $StudID";
                $rowquery = $conn->query($tablequery);
                 if ($rowquery->num_rows > 0) {
                // Output data of each row
                while($datarow = $rowquery->fetch_assoc()) {
                    $scores[] = $datarow['cleaned_score'];
                   
                }
                }
?>
                            <div class="button-container">
		
                            <button type="submit">Back</button>
			</div>
	</form>
</body>
</html>
<?php
}else{
    header("Location studentui.php");
}
?>