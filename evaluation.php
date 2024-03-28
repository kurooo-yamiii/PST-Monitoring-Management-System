<?php
// Getting the User Account ID
include 'db_conn.php';
if (isset($_GET['AccID']))  {
    
    // Fetching the account Name
    $AccID = $_GET['AccID'];
    $sql = "SELECT * FROM student WHERE ID = $AccID";
    $result = mysqli_query($conn, $sql);

    // Using the Resource Teacher ID Fetching the Handled Student
    if(!$result)
    {
     die(mysqli_error($conn));
    }
    if (mysqli_num_rows($result) > 0) {
    $rowData = mysqli_fetch_array($result);
    
?>
<!DOCTYPE html>
<html>
<head>
	<title>Evaluation - <?php echo $rowData['Name'];?></title>
	<link rel="stylesheet" type="text/css" href="evaluation.css">
</head>
<body>
     <form action="evaladd.php" method="post">
     	<?php
        // Feedback Notification if adding evaluation fail or suceeded
        if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

         <?php
    // Fetching Resource Teacher
    $AccID = $_GET['AccID'];
    $sql2 = "SELECT * FROM teacher WHERE Student = $AccID";
    $rs2 = mysqli_query($conn, $sql2);

    if(!$rs2)
    {
     die(mysqli_error($conn));
    }
    if (mysqli_num_rows($rs2) > 0) {
    $rs2data = mysqli_fetch_array($rs2);
    }
    // Getting Resource Teacher ID to enter CoordinatorUI
    $coop = $rs2data['ID'];
    ?>
         <style>
        #accid, #coop{
            display: none;
        }
    
        </style>
         <input type="text"
                  id="accid"
                  name="accid"
                  value="<?=$_GET['AccID'] // Assign Hidden Value Student ID?>"
                  hidden>
         <input type="text"
                  id="coop"
                  name="coop"
                  value="<?php echo $coop; // Assign Hidden Value Resource Teacher ID?>"
                  hidden>

         <div class="text-group">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
            <label></label>
            <label for="lesson"> Lesson:</label>
            <input type="lesson" id="lesson" name="lesson" required>
        </div>
		  
       
	
         <div class="form-group">
         <table>
                <h2>I. Lorem Ipsum</h2>
                <tr>
                    <th>1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td>   <select id="a1" name="a1" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr>
                    <th>2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td>   <select id="a2" name="a2" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr>
                    <th>3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td>   <select id="a3" name="a3" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr>
                    <th>4. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td>   <select id="a4" name="a4" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr>
                    <th>5. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td>   <select id="a5" name="a5" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
              </table>
		   </div>

           <div class="form-group">
         <table>
                <h2>II. Lorem Ipsum</h2>
                <tr>
                    <th>1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td>   <select id="b1" name="b1" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr>
                    <th>2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td>   <select id="b2" name="b2" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr>
                    <th>3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td>   <select id="b3" name="b3" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr>
                    <th>4. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td>   <select id="b4" name="b4" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr>
                    <th>5. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td>   <select id="b5" name="b5" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                </table>
		   </div>

           <div class="form-group">
         <table>
                <h2>III. Lorem Ipsum</h2>
                <tr>
                    <th>1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td>   <select id="c1" name="c1" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr>
                    <th>2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td>   <select id="c2" name="c2" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr>
                    <th>3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td>   <select id="c3" name="c3" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr>
                    <th>4. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td>   <select id="c4" name="c4" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr>
                    <th>5. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td>   <select id="c5" name="c5" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                </table>
		   </div>

           <div class="form-group">
         <table>
                <h2>IV. Lorem Ipsum</h2>
                <tr>
                    <th>1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td>   <select id="d1" name="d1" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr>
                    <th>2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td>   <select id="d2" name="d2" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr>
                    <th>3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td>   <select id="d3" name="d3" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr>
                    <th>4. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td>   <select id="d4" name="d4" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                <tr>
                    <th>5. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td>   <select id="d5" name="d5" required>
                                <option value="5">5-Strongly Agree</option>
                                <option value="4">4-Agree</option>
                                <option value="3">3-Neutral</option>
                                <option value="2">2-Disagree</option>
                                <option value="1">1-Strongly Disagree</option>
                            </select></td>
                </tr>
                </table>
		   </div>
           
		 
         
           <div class="text-group">
            <label for="remarks">Remarks:</label>
            <input type="remarks" id="remarks" name="remarks">
        </div>

           
         
           <?php } ?>
     	<button type="submit" name="create" style="background-color: #000080; margin-top: 3%;">Submit</button>
     </form>
</body>
</html>
<?php
}else{
    header("Location evaluation.php");
}
?>