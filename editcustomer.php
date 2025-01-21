<?php
include('connectmysqli.php'); // Include your database connection script

if(isset($_GET['edit'])){
    $customer_id = $_GET['edit'];

    $sql = "SELECT * FROM customer WHERE customer_id = '$customer_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){

        $row = $result->fetch_assoc();
        $name = $row['name'];
        $nid = $row['nid'];
        $email = $row['email'];
        $phone = $row['phone'];
        $dob = $row['Dob'];
        $house_number = $row['house_number'];
        $road_number = $row['road_number'];
        $city = $row['city'];
    } else {
        echo "Not Found";
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Edit Customer</title>
</head>
<body>
<main>
    <h3>Edit Customer</h3>

    <div class="form">
        <form method="POST">

            <div class="form-row">
                <label for="inputName">Name</label>
                <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" value="<?php echo $name; ?>">
            </div>

            <div class="form-row">
                <label for="inputnid">NID</label>
                <input type="text" class="form-control" id="inputnid" placeholder=nid name="nid" value="<?php echo $nid; ?>">
            </div>

            <div class="form-row">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" value="<?php echo $email; ?>">
            </div>

            <div class="form-row">
                <label for="inputPhone">Phone</label>
                <input type="text" class="form-control" id="inputPhone" placeholder="Phone" name="phone" value="<?php echo $phone; ?>">
            </div>

            <div class="form-row">
                <label for="inputDOB">Date of Birth</label>
                <input type="date" class="form-control" id="inputDOB" name="dob" value="<?php echo $dob; ?>">
            </div>

            <div class="form-row">
                <label for="inputHouseNumber">House Number</label>
                <input type="text" class="form-control" id="inputHouseNumber" placeholder="House Number" name="house_number" value="<?php echo $house_number; ?>">
            </div>

            <div class="form-row">
                <label for="inputRoadNumber">Road Number</label>
                <input type="text" class="form-control" id="inputRoadNumber" placeholder="Road Number" name="road_number" value="<?php echo $road_number; ?>">
            </div>

            <div class="form-row">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity" placeholder="City" name="city" value="<?php echo $city; ?>">
            </div>

            <input type="submit" name="update" id="update" value="Update Customer">
        </form>
    </div>

    <?php
    if(isset($_POST['update']))
    {
        $name = $_POST['name'];
        $nid = $_POST['nid'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];
        $house_number = $_POST['house_number'];
        $road_number = $_POST['road_number'];
        $zip = $_POST['zip'];
        $city = $_POST['city'];

        $sql = "UPDATE customer SET 
                name = '$name', nid = '$nid',
                email = '$email', 
                phone = '$phone', 
                dob = '$dob', 
                house_number = '$house_number', 
                road_number = '$road_number', 
                city = '$city' 
                WHERE customer_id = '$customer_id'";

        $result = mysqli_query($conn, $sql);

        if($result) {
            echo "Customer updated successfully!";
            header("Location: customerlist.php");
            exit;
        } else {
            echo "Error updating customer: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
    ?>
</main>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</body>
</html>
