<?php
include('databasepdo.php');
@session_start();

if(isset($_POST["Clearbutton"])){
  unset($_SESSION["filter"]);
}

//retrieve all invoice list
$strsql = "SELECT item.name, item.item_id, invoice.invoice_id, invoice.item_id,
            invoice.buying_price, invoice.customer_id, invoice.selling_price, invoice.date_of_payment,
            invoice.action FROM item INNER JOIN invoice ON item.item_id = invoice.item_id";
$parameters = array(); //empty initially

//filter added to query
if(isset($_POST['filter'])){
   $filter = $_POST['filter'];
   $para = "%{$filter}%";
   $strsql .= " WHERE item.name LIKE ? OR item.item_id LIKE ? OR invoice.buying_price LIKE ?
              OR invoice.customer_id LIKE ? OR invoice.selling_price LIKE ? OR invoice.date_of_payment LIKE ?
              OR invoice.action LIKE ?";
   $parameters = ["%{$filter}%","%{$filter}%", "%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%"];
   $_SESSION['filter'] = $filter; 
}else{
  if(isset($_SESSION['filter']) && strlen($_SESSION['filter'])>0 ){
    //reapply old filter if user is just sorting
    $filter = $_SESSION['filter'];
    $strsql .= " WHERE item.name LIKE ? OR item.item_id LIKE ? OR invoice.buying_price LIKE ?
              OR invoice.customer_id LIKE ? OR invoice.selling_price LIKE ? OR invoice.date_of_payment LIKE ?
              OR invoice.action LIKE ?";
    $parameters = ["%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%"];
  }
}

//sorting
if(isset($_GET['sort'])){
    $sort = $_GET['sort'];
    $strsql .= " ORDER BY $sort DESC";
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
    <title>Invoice Table</title>
</head>
<body>
    <h2>List of Invoices
      <form class="filterForm" method="POST" action="invoicelist.php">
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
      echo '<th class="name"><a href="invoicelist.php?sort=name">Name</a></th>';
      echo '<th class="item_id"><a href="invoicelist.php?sort=item_id">Item ID</a></th>';
      echo '<th class="buying_price"><a href="invoicelist.php?sort=buying_price">Buying Price</a></th>';
      echo '<th class="customer_id"><a href="invoicelist.php?sort=customer_id">Customer ID</a></th>';
      echo '<th class="selling_price"><a href="invoicelist.php?sort=selling_price">Seling Price</a></th>';
      echo '<th class="date_of_payment"><a href="invoicelist.php?sort=date_of_payment">Date of Payment</a></th>';
      echo '<th class="action"><a href="invoicelist.php?sort=action">Action</a></th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
      $prepared->setFetchMode(PDO::FETCH_ASSOC);
      while($row= $prepared->fetch()){
        echo '<tr>';
        echo '<tr data-ref="' . $row['invoice_id'] . '">';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['item_id'] . '</td>';
        echo '<td>' . $row['buying_price'] . '</td>';
        echo '<td>' . $row['customer_id'] . '</td>';
        echo '<td>' . $row['selling_price'] . '</td>';
        echo '<td>' . $row['date_of_payment'] . '</td>';
        echo '<td>' . $row['action'] . '</td>';
        echo '<td><a href="editinvoice.php?edit='. $row['item_id'].'-'. $row['name'].'" class="btn btn-success">Edit</a></td>';
        echo '<td><a href="delete.php?delete='.$row['invoice_id'].'-invoice"class="btn btn-danger">Delete</a></td>';
        echo '</tr>';
      }
      echo '<tbody>';
    }else{
      //no products
      echo '<p>No invoices currently available.</p>';
    }
  ?>


<script>
    document.getElementById('Clearbutton').addEventListener('click', (ev)=>{
    document.getElementById('filter').value = '';
    })
</script>    
</body>
</html>