<?php
require_once('databasepdo.php');
@session_start();

if(isset($_POST["Clearbutton"])){
    unset($_SESSION["filter"]);
}

// Retrieve all customer list
$strsql = "SELECT * FROM customer"; 
$parameters = array(); // Empty initially

//filter added to query
if(isset($_POST['filter'])){
    $filter = $_POST['filter'];
    $strsql .= " WHERE name LIKE ? OR nid LIKE ? OR house_number LIKE ? OR road_number LIKE ? OR city LIKE ? OR
                Dob LIKE ? OR customer_id LIKE ? OR email LIKE ? OR phone LIKE ?";
    $parameters = ["%{$filter}%","%{$filter}%", "%{$filter}%","%{$filter}%", "%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%"]; 
}else{
    if(isset($_SESSION['filter']) && strlen($_SESSION['filter']) > 0 ){
        // Reapply old filter if user is just sorting
        $filter = $_SESSION['filter'];
        $strsql .= " WHERE name LIKE ? OR nid LIKE ? OR house_number LIKE ? OR road_number LIKE ? OR city LIKE ? OR
                Dob LIKE ? OR customer_id LIKE ? OR email LIKE ? OR phone LIKE ?";
        $parameters = ["%{$filter}%","%{$filter}%", "%{$filter}%","%{$filter}%", "%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%"]; 
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
    <title>Customer List</title>
</head>
<body>

    <h2>List of Customers
        <form class="filterForm" method="POST" action="customerlist.php">
            <input type="text" id="filter" name="filter" placeholder="Filter by name" tabindex="0" value="<?= $filter ?? '' ?>"/>
            <input type="submit" name="Filterbutton" id="Filterbutton" value="Go"/>
            <input type="submit" name="Clearbutton" id="Clearbutton" value="Clear Filters"/>
        </form>
    </h2>
    
    <div class="table-wrapper">
    <table class="fl-table">
    <?php
    // List of customer names with links
    if($prepared->rowCount() > 0){
        echo '<thead>';
        echo '<tr>';
        echo '<th class="name"><a href="customerlist.php?sort=name">Name</a></th>';
        echo '<th class="nid"><a href="customerlist.php?sort=nid">NID</a></th>';
        echo '<th class="house_number"><a href="customerlist.php?sort=house_number">House Number</a></th>';
        echo '<th class="road_number"><a href="customerlist.php?sort=road_number">Road Number</a></th>';
        echo '<th class="city"><a href="customerlist.php?sort=city">City</a></th>';
        echo '<th class="Dob"><a href="customerlist.php?sort=Dob">Date of Birth</a></th>';
        echo '<th class="customer_id"><a href="customerlist.php?sort=customer_id">Customer ID</a></th>';
        echo '<th class="email"><a href="customerlist.php?sort=email">Email</a></th>';
        echo '<th class="phone"><a href="customerlist.php?sort=phone">Phone</a></th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        $prepared->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $prepared->fetch()){
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['nid'] . '</td>';
            echo '<td>' . $row['house_number'] . '</td>';
            echo '<td>' . $row['road_number'] . '</td>';
            echo '<td>' . $row['city'] . '</td>';
            echo '<td>' . $row['Dob'] . '</td>';
            echo '<td>' . $row['customer_id'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['phone'] . '</td>';
            echo '<td><a href="editcustomer.php?edit='. $row['customer_id'].'" class="btn btn-success">Edit</a></td>';
            echo '<td><a href="delete.php?delete='.$row['customer_id'].'-customer"class="btn btn-danger">Delete</a></td>';
            echo '</tr>';
        }
        echo '<tbody>';
    }else{
        echo '<p>No customers available.</p>';
    }
    ?>

<script>
    document.getElementById('Clearbutton').addEventListener('click', (ev)=>{
    document.getElementById('filter').value = '';
    });
</script>
</body>
</html>
