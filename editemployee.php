<?php
include('connectmysqli.php'); // Include your database connection script

if(isset($_GET['edit'])){
    $employee_id = $_GET['edit'];

    $sql = "SELECT * FROM employee WHERE employee_id = '$employee_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){

        $row = $result->fetch_assoc();
        $name = $row['name'];
        $shift = $row['shift'];
        $salary = $row['salary'];
        $phone = $row['phone_number'];
        $position = $row['position'];
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
    <title>Edit Employee</title>
</head>
<body>
<main>
    <h3>Edit Employee</h3>

    <div class="form">
        <form method="POST">

            <div class="form-row">
                <label for="inputName">Name</label>
                <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" value="<?php echo $name; ?>">
            </div>

            <div class="form-row">
                <label for="inputShift">Shift</label>
                <input type="time" class="form-control" id="inputShift" name="shift" value="<?php echo $shift; ?>">
            </div>

            <div class="form-row">
                <label for="inputSalary">Salary</label>
                <input type="text" class="form-control" id="inputSalary" placeholder="Salary" name="salary" value="<?php echo $salary; ?>">
            </div>

            <div class="form-row">
                <label for="inputPhone">Phone</label>
                <input type="text" class="form-control" id="inputPhone" placeholder="Phone" name="phone" value="<?php echo $phone; ?>">
            </div>

            <div class="form-row">
                <label for="inputPosition">Position</label>
                <input type="text" class="form-control" id="inputPosition" placeholder="Position" name="position" value="<?php echo $position; ?>">
            </div>

            <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
            <input type="submit" name="update" id="update" value="Update Employee">
        </form>
    </div>

    <?php
    if(isset($_POST['update']))
    {
        $employee_id = $_POST['employee_id'];
        $name = $_POST['name'];
        $shift = $_POST['shift'];
        $salary = $_POST['salary'];
        $phone = $_POST['phone'];
        $position = $_POST['position'];

        $sql = "UPDATE employee SET 
                name = '$name', 
                shift = '$shift', 
                salary = '$salary', 
                phone_number = '$phone', 
                position = '$position' 
                WHERE employee_id = '$employee_id'";

        $result = mysqli_query($conn, $sql);

        if($result) {
            echo "Employee updated successfully!";
            header("Location: employeelist.php");
            exit;
        } else {
            echo "Error updating employee: " . mysqli_error($conn);
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
