<?php
// Getting Connection to the published Database
$sname= "fdb1034.awardspace.net";
$unmae= "4394207_php";
$password = "rtupst@123";

$db_name = "4394207_php";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}