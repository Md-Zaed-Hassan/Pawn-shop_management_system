<?php
require_once('databasepdo.php');
@session_start();

if(isset($_POST["Clearbutton"])){
    unset($_SESSION["filter"]);
}

// Retrieve all expert list
$strsql = "SELECT * FROM expert";
$parameters = array(); // Empty initially

//filter added to query
if(isset($_POST['filter'])){
    $filter = $_POST['filter'];
    $strsql .= " WHERE name LIKE ? OR location LIKE ? OR expert_id LIKE ? OR phone_number LIKE ? OR expertise LIKE ?";
    $parameters = ["%{$filter}%", "%{$filter}%","%{$filter}%", "%{$filter}%","%{$filter}%"];
    $_SESSION['filter'] = $filter; 
}else{
    if(isset($_SESSION['filter']) && strlen($_SESSION['filter']) > 0 ){
        // Reapply old filter if user is just sorting
        $filter = $_SESSION['filter'];
        $strsql .= " WHERE name LIKE ? OR location LIKE ? OR expert_id LIKE ? OR phone_number LIKE ? OR expertise LIKE ?";
        $parameters = ["%{$filter}%", "%{$filter}%","%{$filter}%", "%{$filter}%","%{$filter}%"];
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
    <title>Expert List</title>
</head>
<body>
    
    <h2>List of Experts
        <form class="filterForm" method="POST" action="expertlist.php">
            <input type="text" id="filter" name="filter" placeholder="Filter keyword" tabindex="0" value="<?= $filter ?? '' ?>"/>
            <input type="submit" name="Filterbutton" id="Filterbutton" value="Go"/>
            <input type="submit" name="Clearbutton" id="Clearbutton" value="Clear Filters"/>
        </form>
    </h2>

    <div class="table-wrapper">
    <table class="fl-table">
    <?php
    // List of expert names with links
    if($prepared->rowCount() > 0){
        echo '<thead>';
        echo '<tr>';
        echo '<th class="name"><a href="expertlist.php?sort=name">Name</a></th>';
        echo '<th class="location"><a href="expertlist.php?sort=location">Location</a></th>';
        echo '<th class="expert_id"><a href="expertlist.php?sort=expert_id">Expert ID</a></th>';
        echo '<th class="phone_number"><a href="expertlist.php?sort=phone_number">Phone</a></th>';
        echo '<th class="expertise"><a href="expertlist.php?sort=expertise">Expertise</a></th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        $prepared->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $prepared->fetch()){
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['location'] . '</td>';
            echo '<td>' . $row['expert_id'] . '</td>';
            echo '<td>' . $row['phone_number'] . '</td>';
            echo '<td>' . $row['expertise'] . '</td>';
            echo '<td><a href="editexpert.php?edit='. $row['expert_id'].'" class="btn btn-success">Edit</a></td>';
            echo '<td><a href="delete.php?delete='.$row['expert_id'].'-expert"class="btn btn-danger">Delete</a></td>';
            echo '</tr>';
        }
        echo '<tbody>';
    } else {
        echo '<p>No experts available.</p>';
    }
    ?>

<script>
    document.getElementById('Clearbutton').addEventListener('click', (ev)=>{
    document.getElementById('filter').value = '';
    });
</script>
</body>
</html>
