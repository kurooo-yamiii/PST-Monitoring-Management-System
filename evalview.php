<?php
// Setting up Account ID and Name
include 'db_conn.php';
if (isset($_POST['evalID']))  {

?>
    <?php
            // Reference Number to Fetch Data in Evaluation
            $ID = $_POST['evalID'];
            $sql2 = "SELECT * FROM evaluation WHERE ID = $ID";
            $rs2 = mysqli_query($conn, $sql2);

            if(!$rs2)
            {
            die(mysqli_error($conn));
            }
            if (mysqli_num_rows($rs2) > 0) {
            $rs2data = mysqli_fetch_array($rs2);
            $AccID = $rs2data['StudentID'];
            ?>
<!DOCTYPE html>
<html>
<head>
	<title>Evaluation - <?php echo $_GET['Name'];?></title>
	<link rel="stylesheet" type="text/css" href="view.css">
</head>
<body>
     <form action="evalstud.php?AccID=<?php echo $AccID?>" method="post">
     
        <div class="goldview" id="goldview">
         <h1><?php echo $rs2data['Lesson'];?></h1>
         <p><?php echo $rs2data['Date'];?> : Total Average of <?php echo $rs2data['Average'];?></p>
         </div>
		  
       
                
         <div class="form-group-eval">
         <table>
                <h2>I. Lorem Ipsum <span><?php echo $rs2data['aT'] . '%';?></span></h2>
                <tr>
                    <th>1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td><?php echo $rs2data['a1'];?></td>
                </tr>
                <tr>
                    <th>2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td><?php echo $rs2data['a2'];?></td>
                </tr>
                <tr>
                    <th>3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td><?php echo $rs2data['a3'];?></td>
                </tr>
                <tr>
                    <th>4. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td><?php echo $rs2data['a1'];?></td>
                </tr>
                <tr>
                    <th>5. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td><?php echo $rs2data['a5'];?></td>
                </tr>
              </table>
		   </div>

           <div class="form-group">
         <table>
                <h2>II. Lorem Ipsum<span><?php echo $rs2data['bT'] . '%';?></span></h2>
                <tr>
                    <th>1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td><?php echo $rs2data['b1'];?></td>
                </tr>
                <tr>
                    <th>2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td><?php echo $rs2data['b2'];?></td>
                </tr>
                <tr>
                    <th>3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td><?php echo $rs2data['b3'];?></td>
                </tr>
                <tr>
                    <th>4. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td><?php echo $rs2data['b4'];?></td>
                </tr>
                <tr>
                    <th>5. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td><?php echo $rs2data['b5'];?></td>
                </tr>
                </table>
		   </div>

           <div class="form-group">
         <table>
                <h2>III. Lorem Ipsum<span><?php echo $rs2data['cT'] . '%';?></span></h2>
                <tr>
                    <th>1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td><?php echo $rs2data['c1'];?></td>
                </tr>
                <tr>
                    <th>2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td><?php echo $rs2data['c2'];?></td>
                </tr>
                <tr>
                    <th>3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td><?php echo $rs2data['c3'];?></td>
                </tr>
                <tr>
                    <th>4. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td><?php echo $rs2data['c4'];?></td>
                </tr>
                <tr>
                    <th>5. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td><?php echo $rs2data['c5'];?></td>
                </tr>
                </table>
		   </div>

           <div class="form-group">
         <table>
                <h2>IV. Lorem Ipsum<span><?php echo $rs2data['dT'] . '%';?></span></h2>
                <tr>
                    <th>1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td><?php echo $rs2data['d1'];?></td>
                </tr>
                <tr>
                    <th>2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td><?php echo $rs2data['d2'];?></td>
                </tr>
                <tr>
                    <th>3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td><?php echo $rs2data['d3'];?></td>
                </tr>
                <tr>
                    <th>4. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td><?php echo $rs2data['d4'];?></td>
                </tr>
                <tr>
                    <th>5. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>
                    <td><?php echo $rs2data['d5'];?></td>
                </tr>
                </table>
		   </div>
         
            <label for="remarks">Remarks:<span><?php echo $rs2data['Remarks'];?></span></label>
            <div class="divider">
            <p>.</p>
            </div>
         
           <?php } ?>
     	<button type="submit" name="create" style="background-color: #000080; margin-top: 3%;">Back</button>
     </form>
</body>
</html>
<?php
}else{
    header("Location studentui.php");
}
?>