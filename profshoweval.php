<?php

include "db_conn.php";
	
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if (isset($_POST['id'])) {
    $EvalID = $_POST['id'];
    
    $sql2 = "SELECT * FROM evaluation WHERE ID = $EvalID";
    $rs2 = mysqli_query($conn, $sql2);
    
    if (!$rs2) {
        die(mysqli_error($conn));
    }
    
    if (mysqli_num_rows($rs2) > 0) {
        $rs2data = mysqli_fetch_array($rs2);
  
        echo '<div class="space"></div>';
        echo '<div class="goldview" id="goldview">';
        echo '<h1>' . $rs2data['Lesson'] . '</h1>';
        echo '<p>' . $rs2data['Date'] . ' : Total Average of ' . $rs2data['Average'] . '</p>';
        echo '</div>';
    
        echo '<div class="form-group-eval-form2">';
        echo '<table class="custom-table-form2">';
        echo '<p class="eval-title">I. Conciseness <span>' . $rs2data['aT'] . '%</span></p>';
        echo '<tbody>';
        echo '<tr class="custom-tr-form2">';
        echo '<th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>';
        echo '<td class="custom-table-column-form2">' . $rs2data['a1'] . '</td>';
        echo '</tr>';
        echo '<tr class="custom-tr-form2">';
        echo '<th class="custom-table-row-form2">2. ...</th>';
        echo '<td class="custom-table-column-form2">' . $rs2data['a2'] . '</td>';
        echo '</tr>';
        echo '<tr class="custom-tr-form2">';
        echo '<th class="custom-table-row-form2">3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>';
        echo '<td class="custom-table-column-form2">' . $rs2data['a3'] . '</td>';
        echo '</tr>';
        echo '<tr class="custom-tr-form2">';
        echo '<th class="custom-table-row-form2">4. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>';
        echo '<td class="custom-table-column-form2">' . $rs2data['a4'] . '</td>';
        echo '</tr>';
        echo '<tr class="custom-tr-form2">';
        echo '<th class="custom-table-row-form2">5. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>';
        echo '<td class="custom-table-column-form2">' . $rs2data['a5'] . '</td>';
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    
        echo '<div class="form-group-eval-form2">';
        echo '<table class="custom-table-form2">';
        echo '<p class="eval-title">II. Coherence <span>' . $rs2data['bT'] . '%</span></p>';
        echo '<tbody>';
        echo '<tr class="custom-tr-form2">';
        echo '<th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>';
        echo '<td class="custom-table-column-form2">' . $rs2data['b1'] . '</td>';
        echo '</tr>';
        echo '<tr class="custom-tr-form2">';
        echo '<th class="custom-table-row-form2">2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>';
        echo '<td class="custom-table-column-form2">' . $rs2data['b2'] . '</td>';
        echo '</tr>';
        echo '<tr class="custom-tr-form2">';
        echo '<th class="custom-table-row-form2">3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>';
        echo '<td class="custom-table-column-form2">' . $rs2data['b3'] . '</td>';
        echo '</tr>';
        echo '<tr class="custom-tr-form2">';
        echo '<th class="custom-table-row-form2">4. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>';
        echo '<td class="custom-table-column-form2">' . $rs2data['b4'] . '</td>';
        echo '</tr>';
        echo '<tr class="custom-tr-form2">';
        echo '<th class="custom-table-row-form2">5. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>';
        echo '<td class="custom-table-column-form2">' . $rs2data['b5'] . '</td>';
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    
        echo '<div class="form-group-eval-form2">';
        echo '<table class="custom-table-form2">';
        echo '<p class="eval-title">III. Clarity <span>' . $rs2data['cT'] . '%</span></p>';
        echo '<tbody>';
        echo '<tr class="custom-tr-form2">';
        echo '<th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>';
        echo '<td class="custom-table-column-form2">' . $rs2data['c1'] . '</td>';
        echo '</tr>';
        echo '<tr class="custom-tr-form2">';
        echo '<th class="custom-table-row-form2">2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>';
        echo '<td class="custom-table-column-form2">' . $rs2data['c2'] . '</td>';
        echo '</tr>';
        echo '<tr class="custom-tr-form2">';
        echo '<th class="custom-table-row-form2">3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>';
        echo '<td class="custom-table-column-form2">' . $rs2data['c3'] . '</td>';
        echo '</tr>';
        echo '<tr class="custom-tr-form2">';
        echo '<th class="custom-table-row-form2">4. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>';
        echo '<td class="custom-table-column-form2">' . $rs2data['c4'] . '</td>';
        echo '</tr>';
        echo '<tr class="custom-tr-form2">';
        echo '<th class="custom-table-row-form2">5. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>';
        echo '<td class="custom-table-column-form2">' . $rs2data['c5'] . '</td>';
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    
        echo '<div class="form-group-eval-form2">';
        echo '<table class="custom-table-form2">';
        echo '<p class="eval-title">IV Correctness <span>' . $rs2data['dT'] . '%</span></p>';
        echo '<tbody>';
        echo '<tr class="custom-tr-form2">';
        echo '<th class="custom-table-row-form2">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>';
        echo '<td class="custom-table-column-form2">' . $rs2data['d1'] . '</td>';
        echo '</tr>';
        echo '<tr class="custom-tr-form2">';
        echo '<th class="custom-table-row-form2">2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>';
        echo '<td class="custom-table-column-form2">' . $rs2data['d2'] . '</td>';
        echo '</tr>';
        echo '<tr class="custom-tr-form2">';
        echo '<th class="custom-table-row-form2">3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>';
        echo '<td class="custom-table-column-form2">' . $rs2data['d3'] . '</td>';
        echo '</tr>';
        echo '<tr class="custom-tr-form2">';
        echo '<th class="custom-table-row-form2">4. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>';
        echo '<td class="custom-table-column-form2">' . $rs2data['d4'] . '</td>';
        echo '</tr>';
        echo '<tr class="custom-tr-form2">';
        echo '<th class="custom-table-row-form2">5. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac tortor imperdiet, convallis risus a, molestie augue.</th>';
        echo '<td class="custom-table-column-form2">' . $rs2data['d5'] . '</td>';
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        
        echo '<div class="space"></div>';
        echo '<p class="remarks-label">Remarks: ' . $rs2data['Remarks'] . '</p>';
        echo '<div class="space">';
        echo '</div>';
    }
  
    
    }else {
        echo '<div class="alert alert-error" role="alert">';
        echo "<p>Unknown Error Occured</p>";
        echo '</div>';
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>