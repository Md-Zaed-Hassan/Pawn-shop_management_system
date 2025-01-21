<?php
include('connectmysqli.php');

if(isset($_GET['details'])){
    $deets  = $_GET['details'];
    $info = explode('-',$deets);
    $item_id = $info[0];
    $status = $info[1];
    $tablename = 'pawn_ticket';
    $sql = "SELECT * FROM $tablename WHERE item_id=$item_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $loan_amount = $row["loan_amount"];
        $pawn_ticket_id = $row["pawn_ticket_id"];
        $customer_id = $row["customer_id"];
        $interest = $row["interest"];
        $date_of_payment = $row["date_of_payment"];
        $redeem_date = $row["redeem_date"];
    }else{
        echo 'Pawn ticket not found. Please add pawn ticket!';
        exit();
    }
}
?>
            
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel = "stylesheet" href = "./assets/css/table.css">
<title>Item Details</title>
</head>
<body>

<h2>Item Detail</h2> </div>

<div class="table-wrapper">
<table class="fl-table">
<?php 
echo '<thead>';
echo '<tr>';
echo '<th class="item_id">Item ID</a></th>';
echo '<th class="loan_amount">Loan Amount</a></th>';
echo '<th class="pawn_ticket_id">Pawn Ticket ID</a></th>';
echo '<th class="customer_id">Customer ID</a></th>';
echo '<th class="interest">Interest</a></th>';
echo '<th class="date_of_payment">Date of Payment</a></th>';
echo '<th class="redeem_date">Redeem Date</a></th>';
echo '<th class="redeem_date">Status</a></th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

    echo '<tr>';
    echo '<td>' . $item_id.'</td>';
    echo '<td>' . $loan_amount.'</td>';
    echo '<td>' . $pawn_ticket_id.'</td>';
    echo '<td>' . $customer_id.'</td>';
    echo '<td>' . $interest.'</td>';
    echo '<td>' . $date_of_payment.'</td>';
    echo '<td>' . $redeem_date.'</td>';
    echo '<td>'.$status.'</td>';
    echo '</tr>'; 

echo '<tbody>';
?>
<a href="itemlist.php" class="btn btn-success">Go Back</a>
</body>
</html>