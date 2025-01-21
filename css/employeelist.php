<?php
require_once('databasepdo.php');
@session_start();

if(isset($_POST["Clearbutton"])){
    unset($_SESSION["filter"]);
}

// Retrieve all employee list
$strsql = "SELECT * FROM employee";
$parameters = array(); // Empty initially

//filter added to query
if(isset($_POST['filter'])){
    $filter = $_POST['filter'];
    $strsql .= " WHERE nid LIKE ? OR name LIKE ? OR employee_id LIKE ?
            OR shift LIKE ? OR salary LIKE ? OR phone_number LIKE ?
            OR position LIKE ?";
    $parameters = ["%{$filter}%","%{$filter}%", "%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%"];
    $_SESSION['filter'] = $filter; 
}else{
    if(isset($_SESSION['filter']) && strlen($_SESSION['filter']) > 0 ){
        // Reapply old filter if user is just sorting
        $filter = $_SESSION['filter'];
        $strsql .= " WHERE nid LIKE ? OR name LIKE ? OR employee_id LIKE ?
                OR shift LIKE ? OR salary LIKE ? OR phone_number LIKE ?
                OR position LIKE ?";
        $parameters = ["%{$filter}%","%{$filter}%", "%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%"];
    }
}

// Sorting
if(isset($_GET['sort'])){
    $sort = $_GET['sort'];
    $strsql .= " ORDER BY $sort";
}

$prepared = $conn->prepare($strsql);
$prepared->execute($parameters);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "./css/ppp.css">
    <title>Employee List</title>
</head>
<body>

    <h2>List of Employees
        <form class="filterForm" method="POST" action="employeelist.php">
            <input type="text" id="filter" name="filter" placeholder="Filter by name" tabindex="0" value="<?= $filter ?? '' ?>"/>
            <input type="submit" name="Filterbutton" id="Filterbutton" value="Go"/>
            <input type="submit" name="Clearbutton" id="Clearbutton" value="Clear Filters"/>
        </form>
    </h2>

    <div class="table-wrapper">
    <table class="fl-table">
    <?php
    // List of employee names with links
    if($prepared->rowCount() > 0){
        echo '<thead>';
        echo '<tr>';
        echo '<th class="nid"><a href="employeelist.php?sort=nid">NID</a></th>';
        echo '<th class="name"><a href="employeelist.php?sort=name">Name</a></th>';
        echo '<th class="employee_id"><a href="employeelist.php?sort=employee_id">Employee ID</a></th>';
        echo '<th class="shift"><a href="employeelist.php?sort=shift">Shift</a></th>';
        echo '<th class="salary"><a href="employeelist.php?sort=salary">Salary</a></th>';
        echo '<th class="phone_number"><a href="employeelist.php?sort=phone_number">Phone</a></th>';
        echo '<th class="position"><a href="employeelist.php?sort=position">Position</a></th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        $prepared->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $prepared->fetch()){
            echo '<tr>';
            echo '<td>' . $row['nid'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['employee_id'] . '</td>';
            echo '<td>' . $row['shift'] . '</td>';
            echo '<td>' . $row['salary'] . '</td>';
            echo '<td>' . $row['phone_number'] . '</td>';
            echo '<td>' . $row['position'] . '</td>';
            echo '<td><a href="editemployee.php?edit='. $row['employee_id'].'" class="btn btn-success">Edit</a></td>';
            echo '<td><a href="delete.php?delete='.$row['employee_id'].'-employee"class="btn btn-danger">Delete</a></td>';
            echo '</tr>';
        }
        echo '<tbody>';
    } else {
        echo '<p>No employees available.</p>';
    }
    ?>

<script>
    document.getElementById('Clearbutton').addEventListener('click', (ev)=>{
    document.getElementById('filter').value = '';
    });
</script>
</body>
</html>
