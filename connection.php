<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "pawnshop";


if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("Failed to connect to the servers!");
}