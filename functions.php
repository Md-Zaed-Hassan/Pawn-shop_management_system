<?php

function check_login($con)
{

    if(isset($_SESSION['nid']))
    {
        $id = $_SESSION['nid'];
        $query = "select * from customer where nid = '$id' limit 1";

        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    //if session value doesn't exist
    //redirecting to login
    header("Location: login.php");
    die;

}


function random_num($length)
{
    $text = "";
    if ($length < 9)
    {
        $length = 9;

    }


    $len = rand(8, $length);

    for ($i=0; $i < $len; $i++) { 
       # code...
       $text .= rand(0,9);
       
    }
    return $text;
}