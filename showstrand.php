<?php

include "db_conn.php";
include 'db_pdo.php';
	
$section = mysqli_real_escape_string($conn, $_POST["sec"]);
$statlist = $ponn->prepare("SELECT * FROM student WHERE Resource != '' AND Program = :program");
$statlist->bindParam(':program', $section, PDO::PARAM_STR);
$statlist->execute();
// Your SQL query to search in your table

if ($statlist->rowCount() <= 0) {
	echo '<div class="monitor">';
	echo '<img src="resources/default.jpeg" id="gridpic">';
    echo '<h2>No PST is currently Deployed in the Program '. $section .' </h2>';
    echo '<br>';
    echo '<small>Note: If you want to deploy student kindly go to deoplyment button</small>';
    echo '<button type="button">N/A</button>';    
    echo '</div>';
}else {

    while($statslist = $statlist->fetch(PDO::FETCH_ASSOC)) {
       	echo '<div class="monitor">';
                if ($statslist['Profile'] == '') {
                    echo '<img src="resources/default.jpeg" id="gridpic">';
                } else {
                    echo '<img src="upload/' . $statslist['Profile'] . '" id="gridpic">';
                }

                echo '<span class="program">' . $statslist['Program'] . '</span>';
                echo '<h2>' . $statslist['Name'] . '</h2>';
                echo '<small>' . $statslist['Section'] . '</small>';
                echo '<small>Supervisor: ' . $statslist['Supervisor'] . '</small>';

                if ($statslist['Program'] == 'BSE-Math') {
                    echo '<button onclick="statisticID(' . $statslist['ID'] . ')" class="math" id="s1" type="button">Monitor</button>';
                } elseif ($statslist['Program'] == 'BSE-English') {
                    echo '<button onclick="statisticID(' . $statslist['ID'] . ')" class="english" id="s2" type="button">Monitor</button>';
                } elseif ($statslist['Program'] == 'BSE-Filipino') {
                    echo '<button onclick="statisticID(' . $statslist['ID'] . ')" class="filipino" id="s3" type="button">Monitor</button>';
                } elseif ($statslist['Program'] == 'BSE-Science') {
                    echo '<button onclick="statisticID(' . $statslist['ID'] . ')" class="removee-to-do" id="s4" type="button">Monitor</button>';
                } elseif ($statslist['Program'] == 'BSE-Social-Studies') {
                    echo '<button onclick="statisticID(' . $statslist['ID'] . ')" class="socsci" id="s5" type="button">Monitor</button>';
                } elseif ($statslist['Program'] == 'BTVTED-CSS') {
                    echo '<button onclick="statisticID(' . $statslist['ID'] . ')" class="btcss" id="s6" type="button">Monitor</button>';
                } elseif ($statslist['Program'] == 'BTVTED-VGD') {
                    echo '<button onclick="statisticID(' . $statslist['ID'] . ')" class="btvgd" id="s7" type="button">Monitor</button>';
                } elseif ($statslist['Program'] == 'BTVTED-Animation') {
                    echo '<button onclick="statisticID(' . $statslist['ID'] . ')" class="btani" id="s8" type="button">Monitor</button>';
                } else {
                    echo '<button onclick="statisticID(' . $statslist['ID'] . ')" class="removee-to-do" id="s9" type="button">Monitor</button>';
                }

                echo '</div>';
    }
    
}

?>