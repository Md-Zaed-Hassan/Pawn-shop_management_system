<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//takiing inputs for db tables
        //asking if something was posted
		$name = $_POST['name'];
        $user_name = $_POST['user_name'];
        $house_number = $_POST['house_number'];
        $road_number = $_POST['road_number'];
        $city = $_POST['city'];
        $Dob = $_POST['Dob'];
        $email = $_POST['email'];
        $password = $_POST['password'];
		$phone = $_POST['phone'];

		if(!empty($user_name) && !empty($password))
		{

			//save to database
			$nid = random_num(14);
			$query = "insert into customer (nid,name,user_name,house_number,road_number,city,Dob,email,password,phone) values ('$nid','$name','$user_name','$house_number','$road_number','$city','$Dob','$email','$password','$phone')";
			
            mysqli_query($con, $query);

			header("Location: signup-succes.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Signup</title>
    <link rel="stylesheet" href="assets/css/signup.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">Signup</div>
    <div class="content">
      <form method="post" action="#">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" name="name" placeholder="Enter your name" required>
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" name="user_name" placeholder="Enter your username" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" name = "email" placeholder="Enter your email" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" name = "phone" placeholder="Enter your number" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" name ="password" placeholder="Enter your password" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" placeholder="Confirm your password" required>
          </div>
          <div class="input-box">
            <span class="details">Date of birth</span>
            <input type="text" name="Dob" placeholder="YYYY-MM-DD" required>
          </div>
          <div class="input-box">
            <span class="details">House number</span>
            <input type="text" name="house_number" placeholder="Enter your house number" required>
          </div>
          <div class="input-box">
            <span class="details">Road number</span>
            <input type="text" name="road_number" placeholder="Enter your road number" required>
          </div>
          <div class="input-box">
            <span class="details">City</span>
            <input type="text" name="city" placeholder="Enter your city" required>
          </div>
        </div>
        <div class="button">
          <input type="submit" value="Signup">
        </div>
      </form>
      <div>
        Already have an account? <a href="login.php">Click to login.</a>
      </div>
      <div >
          <a href="home.html"><i ></i>Go Back</a>
      </div>
    </div>
  </div>
</body>
</html>