<?php
include('connectmysqli.php'); // Include your database connection script
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Add Customer</title>
</head>
<body>
<main>
    <h3>Add Customer</h3>

    <div class="form">
        <form method="POST">

            <div class="form-row">
                <label for="inputName">Name</label>
                <input type="text" class="form-control" id="inputName" placeholder="Name" name="name">
            </div>

            <div class="form-row">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email">
            </div>

            <div class="form-row">
                <label for="inputnid">NID</label>
                <input type="nid" class="form-control" id="inputnid" placeholder="nid" name="nid">
            </div>

            <div class="form-row">
                <label for="inputPhone">Phone</label>
                <input type="text" class="form-control" id="inputPhone" placeholder="Phone" name="phone">
            </div>

            <div class="form-row">
                <label for="inputDOB">Date of Birth</label>
                <input type="date" class="form-control" id="inputDOB" name="dob">
            </div>

            <div class="form-row">
                <label for="inputHouseNumber">House Number</label>
                <input type="text" class="form-control" id="inputHouseNumber" placeholder="House Number" name="house_number">
            </div>

            <div class="form-row">
                <label for="inputRoadNumber">Road Number</label>
                <input type="text" class="form-control" id="inputRoadNumber" placeholder="Road Number" name="road_number">
            </div>

            <div class="form-row">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity" placeholder="City" name="city">
            </div>

            <input type="submit" name="submit" id="submit" value="Add Customer">
            <p><a href="home.php" class="btn btn-success">Go Back</a></p>
        </form>

        <?php
        if(isset($_POST['submit']))
        {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $nid = $_POST['nid'];
            $phone = $_POST['phone'];
            $dob = $_POST['dob'];
            $house_number = $_POST['house_number'];
            $road_number = $_POST['road_number'];
            $city = $_POST['city'];

            // Create SQL query for adding customer
            $sql = "INSERT INTO customer (name, email, phone, dob, house_number, road_number, zip, city) 
                    VALUES ('$name', '$email', '$phone', '$dob', '$house_number', '$road_number', '$zip', '$city')";

            // Execute the query
            $result = mysqli_query($conn, $sql);

            if($result)
            {
                echo "Customer added successfully!";
            }
            else
            {
                echo "Error adding customer: " . mysqli_error($conn);
            }
        }

        // Close connection
        mysqli_close($conn);
        ?>
    </div>
</main>
<!-- Prevent resubmission when refreshing the page -->
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</body>
</html>
