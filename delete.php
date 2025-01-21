<?php
include('connectmysqli.php');

$db = $conn;
if(isset($_GET['delete'])){ //getting the customer id and customer
    $deets  = $_GET['delete']; // setting deets var values with a array with cus id and customer table
    $info = explode('-',$deets);
    $condition = $info[0]; //id
    $tablename = $info[1]; //customer
    $deleteMsg=delete_data($db, $tablename, $condition);
  header("location:".$tablename."list.php");
}


function delete_data($db, $tablename, $condition){   //connection var, table name , which id to be deleted
    $columnname = $tablename."_id";  
    $sql= "DELETE FROM $tablename WHERE $columnname = $condition"; // delete statement for db
    $result= $db->query($sql); //asking db for result if yes or no 
    if($result){
        $msg="data was deleted successfully";
    }else{
        $msg= $db->error;
    }
  return $msg;
}

?>