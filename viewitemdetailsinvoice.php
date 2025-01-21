<?php
include('connectmysqli.php');

if(isset($_GET['details'])){
    $deets  = $_GET['details'];
    $info = explode('-',$deets);
    $item_id = $info[0];
    $status = $info[1];
    $tablename = 'invoice';
    $sql = "SELECT * FROM $tablename WHERE item_id='$item_id' AND action = '$status'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $invoice_id = $row['invoice_id'];
        $buying_price = $row['buying_price'];
        $customer_id = $row['customer_id'];
        $selling_price = $row['selling_price'];
        $date_of_payment = $row['date_of_payment'];
        $action = $status;
    }else{
        echo 'Invoice not found. Please add invoice!';
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

<h2>Item Details</h2> </div>

<div class="table-wrapper">
<table class="fl-table">
<?php
echo '<thead>';
echo '<tr>';
echo '<th class="item_id">Item ID</a></th>';
echo '<th class="invoice_id">Invoice ID</a></th>';
echo '<th class="buying_price">Buying Price</a></th>';
echo '<th class="customer_id">Customer ID</a></th>';
echo '<th class="selling_price">Selling price</a></th>';
echo '<th class="date_of_payment">Date of Payment</a></th>';
echo '<th class="status">Status</a></th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

    echo '<tr>';
    echo '<td>' . $invoice_id. '</td>';
    echo '<td>' . $item_id. '</td>';
    echo '<td>' . $buying_price.'</td>';
    echo '<td>' . $customer_id.'</td>';
    echo '<td>' . $selling_price.'</td>';
    echo '<td>' . $date_of_payment.'</td>';
    echo '<td>'.$status.'</td>';
    echo '</tr>';
    
    echo '<tbody>';
?>
<a href="itemlist.php" class="btn btn-success">Go Back</a>

</body>
</html>