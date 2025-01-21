<?php
include('databasepdo.php');
@session_start();

if(isset($_POST["Clearbutton"])){
  unset($_SESSION["filter"]);
}

//retrieve all pawn_ticket list
$strsql = "SELECT item.name, item.item_id, pawn_ticket.loan_amount,
            pawn_ticket.pawn_ticket_id, pawn_ticket.customer_id, pawn_ticket.interest, pawn_ticket.date_of_payment,
            pawn_ticket.redeem_date FROM item INNER JOIN pawn_ticket ON item.item_id = pawn_ticket.item_id"; 
$parameters = array(); //empty initially

//filter added to query
if(isset($_POST['filter'])){
   $filter = $_POST['filter'];
   $strsql .= " WHERE item.name LIKE ? OR item.item_id LIKE ? OR pawn_ticket.loan_amount LIKE ?
              OR pawn_ticket.pawn_ticket_id LIKE ? OR pawn_ticket.customer_id LIKE ? OR pawn_ticket.interest LIKE ?
              OR pawn_ticket.date_of_payment LIKE ? OR pawn_ticket.redeem_date LIKE ?";
   $parameters = ["%{$filter}%","%{$filter}%","%{$filter}%", "%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%"];
   $_SESSION['filter'] = $filter; 
}else{
  if(isset($_SESSION['filter']) && strlen($_SESSION['filter'])>0 ){
    //reapply old filter if user is just sorting
    $filter = $_SESSION['filter'];
    $strsql .= " WHERE item.name LIKE ? OR item.item_id LIKE ? OR pawn_ticket.loan_amount LIKE ?
              OR pawn_ticket.pawn_ticket_id LIKE ? OR pawn_ticket.customer_id LIKE ? OR pawn_ticket.interest LIKE ?
              OR pawn_ticket.date_of_payment LIKE ? OR pawn_ticket.redeem_date LIKE ?";
   $parameters = ["%{$filter}%","%{$filter}%","%{$filter}%", "%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%"];
  }
}

//descending sorting
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
  <title>Pawn Ticket Table</title>
</head>
<body>

    <h2>List of Pawn Tickets
      <form class="filterForm" method="POST" action="pawnticketlist.php">
        <input type="text" id="filter" name="filter" placeholder="filter keyword" tabindex="0" value="<?= $filter ?? '' ?>"/>
        <input type="submit" name="Filterbutton" id="Filterbutton" value="Go"/>
        <input type="submit" name="Clearbutton" id="Clearbutton" value="Clear Filters"/>
      </form>
    </h2>

  <div class="table-wrapper">
  <table class="fl-table">
  <?php
    //list of product names with links
    if($prepared->rowCount() > 0){
      //table headers with links for sorting
      echo '<thead>';
      echo '<tr>';
      echo '<th class="name"><a href="pawnticketlist.php?sort=name">Name</a></th>';
      echo '<th class="item_id"><a href="pawnticketlist.php?sort=item_id">Item ID</a></th>';
      echo '<th class="loan_amount"><a href="pawnticketlist.php?sort=loan_amount">Loan Amount</a></th>';
      echo '<th class="pawn_ticket_id"><a href="pawnticketlist.php?sort=pawn_ticket_id">Pawn Ticket ID</a></th>';
      echo '<th class="customer_id"><a href="pawnticketlist.php?sort=customer_id">Customer ID</a></th>';
      echo '<th class="interest"><a href="pawnticketlist.php?sort=interest">Interest</a></th>';
      echo '<th class="date_of_payment"><a href="pawnticketlist.php?sort=date_of_payment">Date of Payment</a></th>';
      echo '<th class="redeem_date"><a href="pawnticketlist.php?sort=redeem_date">Redeem Date</a></th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
      $prepared->setFetchMode(PDO::FETCH_ASSOC);
      while($row= $prepared->fetch()){
        echo '<tr>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['item_id'] . '</td>';
        echo '<td>' . $row['loan_amount'] . '</td>';
        echo '<td>' . $row['pawn_ticket_id'] . '</td>';
        echo '<td>' . $row['customer_id'] . '</td>';
        echo '<td>' . $row['interest'] . '</td>';
        echo '<td>' . $row['date_of_payment'] . '</td>';
        echo '<td>' . $row['redeem_date'] . '</td>';
        echo '<td><a href="editpawnticket.php?edit='. $row['item_id'].'-'. $row['name'].'" class="btn btn-success">Edit</a></td>';
        echo '<td><a href="delete.php?delete='.$row['item_id'].'-pawn_ticket"class="btn btn-danger">Delete</a></td>';
        echo '</tr>';
      }
      echo '<tbody>';
    }else{
      //no products
      echo '<p>No pawn tickets currently available.</p>';
    }
  ?>


<script>
  document.getElementById('Clearbutton').addEventListener('click', (ev)=>{
  document.getElementById('filter').value = '';
  })
</script>    
</body>
</html>