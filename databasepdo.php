<?php

$dbhost = "localhost";
$dbname	= "pawnshop"; 
$dbuser	= "root"; 
$dbpass	= ""; 

try{
  $conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

}catch(PDOException $err){
  echo "Could not connect to database". $err->getMessage();
  exit();
}

?>