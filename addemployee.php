<?php
include('connectmysqli.php'); // Include your database connection script
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Add Employee</title>
</head>
<body>
<main>
    <h3>Add Employee</h3>

    <div class="form">
        <form method="POST">

            <div class="form-row">
                <label for="nid">NID</label>
                <input type="text" class="form-control" id="nid" placeholder="nid" name="nid">
            </div>

            <div class="form-row">
                <label for="inputName">Name</label>
                <input type="text" class="form-control" id="inputName" placeholder="Name" name="name">
            </div>

            <div class="form-row">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email">
            </div>

            <div class="form-row">
                <label for="inputShift">Shift</label>
                <input type="time" class="form-control" id="inputShift" name="shift">
            </div>

            <div class="form-row">
                <label for="inputSalary">Salary</label>
                <input type="text" class="form-control" id="inputSalary" placeholder="Salary" name="salary">
            </div>

            <div class="form-row">
                <label for="inputPhone">Phone</label>
                <input type="text" class="form-control" id="inputPhone" placeholder="Phone" name="phone">
            </div>

            <div class="form-row">
                <label for="inputPosition">Position</label>
                <input type="text" class="form-control" id="inputPosition" placeholder="Position" name="position">
            </div>

            <input type="submit" name="submit" id="submit" value="Add Employee">
            <p><a href="home.php" class="btn btn-success">Go Back</a></p>
        </form>

        <?php
        if(isset($_POST['submit']))
        {
            $nid = $_POST['nid'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $shift = $_POST['shift'];
            $salary = $_POST['salary'];
            $phone = $_POST['phone'];
            $position = $_POST['position'];

            // Create SQL query for adding employee with nid, email, and position
            $sql = "INSERT INTO employee (nid, name, email, shift, salary, phone, position) 
                    VALUES ('$nid', '$name', '$email', '$shift', '$salary', '$phone', '$position')";

            // Execute the query
            $result = mysqli_query($conn, $sql);

            if($result)
            {
                echo "Employee added successfully!";
            }
            else
            {
                echo "Error adding employee: " . mysqli_error($conn);
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
