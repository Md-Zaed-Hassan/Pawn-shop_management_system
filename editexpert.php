<?php
include('connectmysqli.php'); // Include your database connection script

if(isset($_GET['edit'])){
    $expert_id = $_GET['edit'];

    $sql = "SELECT * FROM expert WHERE expert_id = '$expert_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){

        $row = $result->fetch_assoc();
        $name = $row['name'];
        $location = $row['location'];
        $phone = $row['phone_number'];
        $expertise = $row['expertise'];
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
    <title>Edit expert</title>
</head>
<body>
<main>
    <h3>Edit expert</h3>

    <div class="form">
        <form method="POST">

            <div class="form-row">
                <label for="inputName">Name</label>
                <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" value="<?php echo $name; ?>">
            </div>

            <div class="form-row">
                <label for="inputlocation">Location</label>
                <input type="text" class="form-control" id="inputlocation" name="location" value="<?php echo $location; ?>">
            </div>

            <div class="form-row">
                <label for="inputPhone">Phone</label>
                <input type="text" class="form-control" id="inputPhone" placeholder="Phone" name="phone" value="<?php echo $phone; ?>">
            </div>

            <div class="form-row">
                <label for="inputexpertise">Expertise</label>
                <input type="text" class="form-control" id="inputexpertise" placeholder="expertise" name="expertise" value="<?php echo $expertise; ?>">
            </div>

            <input type="hidden" name="expert_id" value="<?php echo $expert_id; ?>">
            <input type="submit" name="update" id="update" value="Update expert">
        </form>
    </div>

    <?php
    if(isset($_POST['update']))
    {
        $expert_id = $_POST['expert_id'];
        $name = $_POST['name'];
        $location = $_POST['location'];
        $salary = $_POST['salary'];
        $phone = $_POST['phone'];
        $expertise = $_POST['expertise'];

        $sql = "UPDATE expert SET 
                name = '$name', 
                location = '$location', 
                phone_number = '$phone', 
                expertise = '$expertise' 
                WHERE expert_id = '$expert_id'";

        $result = mysqli_query($conn, $sql);

        if($result) {
            echo "expert updated successfully!";
            header("Location: expertlist.php");
            exit;
        } else {
            echo "Error updating expert: " . mysqli_error($conn);
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