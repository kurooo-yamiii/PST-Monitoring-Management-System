<?php
// Getting Connection to the published Database
$sname= "";
$unmae= "";
$password = "";

$db_name = "";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}
