<?php
include('connectmysqli.php'); // Include your database connection script
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Add Expert</title>
</head>
<body>
<main>
    <h3>Add Expert</h3>

    <div class="form">
        <form method="POST">

            <div class="form-row">
                <label for="inputName">Name</label>
                <input type="text" class="form-control" id="inputName" placeholder="Name" name="name">
            </div>

            <div class="form-row">
                <label for="inputLocation">Location</label>
                <input type="text" class="form-control" id="inputLocation" placeholder="Location" name="location">
            </div>

            <div class="form-row">
                <label for="inputPhone">Phone</label>
                <input type="text" class="form-control" id="inputPhone" placeholder="Phone" name="phone_number">
            </div>

            <div class="form-row">
                <label for="inputExpertise">Expertise</label>
                <input type="text" class="form-control" id="inputExpertise" placeholder="Expertise" name="expertise">
            </div>

            <input type="submit" name="submit" id="submit" value="Add Expert">
            <p><a href="home.php" class="btn btn-success">Go Back</a></p>
        </form>

        <?php
        if(isset($_POST['submit']))
        {
            $name = $_POST['name'];
            $location = $_POST['location'];
            $phone = $_POST['phone_number'];
            $expertise = $_POST['expertise'];

            // Create SQL query for adding expert with name, location, phone, and expertise
            $sql = "INSERT INTO expert (name, location, phone_number, expertise) 
                    VALUES ('$name', '$location', '$phone', '$expertise')";

            // Execute the query
            $result = mysqli_query($conn, $sql);

            if($result)
            {
                echo "Expert added successfully!";
            }
            else
            {
                echo "Error adding expert: " . mysqli_error($conn);
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
