<?php
include "db_conn.php";
include 'db_pdo.php';

$statpst = mysqli_real_escape_string($conn, $_POST["search"]);
$statlist = $ponn->query("SELECT * FROM student WHERE Resource != '' AND (Name LIKE '%$statpst%' OR School LIKE '%$statpst%' OR Section LIKE '%$statpst%')");

if ($statlist) {
    if ($statlist->rowCount() > 0) {
        while ($statslist = $statlist->fetch(PDO::FETCH_ASSOC)) {
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
    } else {
        echo '<div class="todo-item">';
        echo '<h2>There is no result found</h2>';
        echo '</div>';
    }
} else {
    echo "<p>No records found for the search term '{$statpst}'</p>";
}
?>
