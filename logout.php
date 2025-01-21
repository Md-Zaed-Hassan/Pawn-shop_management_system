<?php


session_start();

if(isset($_SESSION['nid']))
{
    unset($_SESSION['nid']);
}


header("Location: login.php");
die;