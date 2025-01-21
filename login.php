<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//takiing inputs for db tables data comparison
        //asking if something was posted
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

		if(!empty($user_name) && !empty($password))
		{

			//reading from  database
			
			$query = "select * from customer where user_name = '$user_name' limit 1";
			
            $result = mysqli_query($con, $query);
            
            if($result)
            {
                if($result && mysqli_num_rows($result) > 0)
                {
                    $user_data = mysqli_fetch_assoc($result);

                    if($user_data['password'] == $password)
                    {
                        
                        $_SESSION['nid'] = $user_data['nid'];
                        header("Location: index.php");
                        die;
                    }
                }
            }
            echo "Wrong username or password!";
		}else
		{
			echo "Wrong username or password!";
		}
	}
?>


<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Login </title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="container">
      <form method ="post" action="#">
        <div class="title">Login</div>
        <div class="input-box underline">
          <input type="text" name="user_name" placeholder="Enter Your username" required>
          <div class="underline"></div>
        </div>
        <div class="input-box">
          <input type="password" name="password" placeholder="Enter Your Password" required>
          <div class="underline"></div>
        </div>
        <div class="input-box button">
          <input type="submit" name="#" value="Login">
        </div>
        <div class="option">
            <p>Don't have an acoount yet?<a href="signup.php"> Create your account here</a>.</p>
        </div>
      </form>
        <div class="option">or Connect With Social Media</div>
        <div class="twitter">
          <a href="https://twitter.com/?lang=en"><i class="fab fa-twitter"></i>Sign in With Twitter</a>
        </div>
        <div class="facebook">
          <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i>Sign in With Facebook</a>
        </div>
        <div >
          <a href="home.html"><i ></i>Go Back</a>
        </div>
    </div>
  </body>
</html>
