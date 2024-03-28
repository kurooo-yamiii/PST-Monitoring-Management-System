<?php 

$sName = "fdb1034.awardspace.net";
$uName = "4394207_php";
$pass = "rtupst@123";
$db_name = "4394207_php";

try {
    $ponn = new PDO("mysql:host=$sName;dbname=$db_name", 
                    $uName, $pass);
    $ponn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed : ". $e->getMessage();
}