<?php
require_once('databasepdo.php');
@session_start();

if(isset($_POST["Clearbutton"])){
  unset($_SESSION["filter"]);
}

//retrieve all item list
$strsql = "SELECT * FROM item";
$parameters = array(); //empty initially

//filter added to query
if(isset($_POST['filter'])){
  $filter = $_POST['filter'];
  $strsql .= " WHERE name LIKE ? OR item_id LIKE ? OR customer_id LIKE ? OR brand LIKE ? OR type LIKE ? OR
            model LIKE ? OR status LIKE ? OR expert_id LIKE ?";
  $parameters = ["%{$filter}%", "%{$filter}%","%{$filter}%", "%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%"];
  $_SESSION['filter'] = $filter;  
}else{
  if(isset($_SESSION['filter']) && strlen($_SESSION['filter'])>0 ){
    //reapply old filter if user is just sorting
    $filter = $_SESSION['filter'];
    $strsql .= " WHERE name LIKE ? OR item_id LIKE ? OR customer_id LIKE ? OR brand LIKE ? OR type LIKE ? OR
      model LIKE ? OR status LIKE ? OR expert_id LIKE ?";
      $parameters = ["%{$filter}%", "%{$filter}%","%{$filter}%", "%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%"];
  }
}

//sorting
if(isset($_GET['sort'])){
    $sort = $_GET['sort'];
    $strsql .= " ORDER BY $sort";
  }

  $prepared = $conn->prepare($strsql);
  $prepared->execute($parameters);

if(isset($_GET['view'])){
  $deets  = $_GET['view'];
  $info = explode('-',$deets);
  $item_id = $info[0];
  $status = $info[1];

  if($status == 'pawn'){
    header("Location: viewitemdetailspawn.php?details=".$item_id.'-'.$status);  
  }elseif($status == 'for sale' || $status == 'sold'){
    header("Location: viewitemdetailsinvoice.php?details=".$item_id.'-'.$status); 
  }else{
    echo "Item sent to expert for evaluation";
  } 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel = "stylesheet" href = "./css/ppp.css">
  <title>Item Table</title>
</head>
<body>

    <h2>List of Items
      <form class="filterForm" method="POST" action="itemlist.php">
        <input type="text" id="filter" name="filter" placeholder="filter keyword" tabindex="0" value="<?= $filter ?? '' ?>"/>
        <input type="submit" name="Filterbutton" id="Filterbutton" value="Go"/>
        <input type="submit" name="Clearbutton" id="Clearbutton" value="Clear Filters"/>
      </form>
    </h2>

  <div class="table-wrapper">
  <table class="fl-table">
  <?php
    //list of product names with links
    //echo $prepared->debugDumpParams();
    if($prepared->rowCount() > 0){
      //table headers with links for sorting
      echo '<thead>';
      echo '<tr>';
      echo '<th class="name"><a href="itemlist.php?sort=name">Name</a></th>';
      echo '<th class="item_id"><a href="itemlist.php?sort=item_id">Item ID</a></th>';
      echo '<th class="customer_id"><a href="itemlist.php?sort=customer_id">Customer ID</a></th>';
      echo '<th class="brand"><a href="itemlist.php?sort=brand">Brand</a></th>';
      echo '<th class="type"><a href="itemlist.php?sort=type">Type</a></th>';
      echo '<th class="model"><a href="itemlist.php?sort=model">Model</a></th>';
      echo '<th class="status"><a href="itemlist.php?sort=status">Status</a></th>';
      echo '<th class="expert_id"><a href="itemlist.php?sort=expert_id">Expert ID</a></th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
      $prepared->setFetchMode(PDO::FETCH_ASSOC);
      while($row= $prepared->fetch()){
        echo '<tr>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['item_id'] . '</td>';
        echo '<td>' . $row['customer_id'] . '</td>';
        echo '<td>' . $row['brand'] . '</td>';
        echo '<td>' . $row['type'] . '</td>';
        echo '<td>' . $row['model'] . '</td>';
        echo '<td>' . $row['status'] . '</td>';
        echo '<td>' . $row['expert_id'] . '</td>';
        echo '<td><a href="edititem.php?edit='. $row['item_id'].'" class="btn btn-success">Edit</a></td>';
        echo '<td><a href="itemlist.php?view='. $row['item_id'].'-'.$row['status'].'
              " class="btn btn-success">View Details</a></td>';
        echo '<td><a href="delete.php?delete='.$row['item_id'].'-item"class="btn btn-danger">Delete</a></td>';
        echo '</tr>';
      }
      echo '<tbody>';
    }else{
      //no products
      echo '<p>No products currently available.</p>';
    }
  ?>


<script>
    document.getElementById('Clearbutton').addEventListener('click', (ev)=>{
    document.getElementById('filter').value = '';
    })
</script>    
</body>
</html>
