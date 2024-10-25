<?php 

$sName = "";
$uName = "";
$pass = "";
$db_name = "";

try {
    $ponn = new PDO("mysql:host=$sName;dbname=$db_name", 
                    $uName, $pass);
    $ponn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed : ". $e->getMessage();
}
