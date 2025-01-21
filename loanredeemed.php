<?php
include('connectmysqli.php');

if(isset($_GET['redeem'])){
    $item_id = $_GET['redeem'];

    $sql = "SELECT item.name, item.item_id, pawn_ticket.loan_amount, pawn_ticket.customer_id, pawn_ticket.interest, pawn_ticket.date_of_payment,
    pawn_ticket.redeem_date FROM item INNER JOIN pawn_ticket ON item.item_id = pawn_ticket.item_id where item.item_id = $item_id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0){

        $row = $result->fetch_assoc();

        $item_id = $row["item_id"];
        $name = $row["name"];
        $loan_amount = $row["loan_amount"];
        $customer_id = $row["customer_id"];
        $interest = $row["interest"];
        $date_of_payment = $row["date_of_payment"];
        $redeem_date = $row["redeem_date"];
        $date1 = new DateTime($date_of_payment);
        $date2 = new DateTime(date('m/d/Y h:i:s a'));
        $interval = $date1->diff($date2);
        $days = $interval->days;
        $selling_price = ($days/30)*$interest*$loan_amount + $loan_amount;
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
    <link rel = "stylesheet" href = "css/main.css">
    <title>Add Invoice</title>
</head>
<body>
<main>
<h3>Add Invoice<h3>

<div class="form">
<form method="POST">


    <div class="form-row">
      <label for="inputitem_id">Item ID</label>
      <input type="text" class="form-control" id="inputitem_id" value= "<?php echo $item_id.'-'.$name?>" name="item_id"> 
    </div>

    <div class="form-row">
      <label for="inputcustomer_id">Customer ID</label>
      <input type="text" class="form-control" id="inputcustomer_id" value= "<?php echo $customer_id?>" name="customer_id"> 
    </div>

    <div class="form-row">
      <label for="inputbuying_price">Buying Price</label>
      <input type="decimal" class="form-control" id="inputbuying_price" value= "<?php echo $loan_amount?>" name="buying_price"> 
    </div>

    <div class="form-row">
      <label for="inputselling_price">Selling Price</label>
      <input type="decimal" class="form-control" id="inputselling_price" value= "<?php echo $selling_price?>" name="selling_price"> 
    </div>

    <div class="form-row">
      <label for="inputdate_of_payment">Date of Payment</label>
      <input type="date" class="form-control" id="inputdate_of_payment" value= "<?php echo $selling_price?>" name="date_of_payment"> 
    </div>

    <div class="form-row">
        <label for="inputaction">Action</label>
            <select id="inputaction" class="form-control" name="action">
            <option selected>sold</option>
            </select>
    </div>
    <input type="submit" name="submit" id="submit" value="Add Invoice">
</form>

<?php
    
    if(isset($_POST['submit']))
    {
        $item_id = $_POST['item_id'];
        $buying_price = $_POST['buying_price'];
        $customer_id = $_POST['customer_id'];
        $selling_price = $_POST['selling_price'];
        $date_of_payment = $_POST['date_of_payment'];
        $action = $_POST['action'];

        // using sql to create a data entry query
        $sql = "INSERT INTO invoice (invoice_id, item_id, buying_price, customer_id, 
                selling_price, date_of_payment, action) VALUES ('0', '$item_id', '$buying_price',
                '$customer_id', '$selling_price', '$date_of_payment', '$action')";
  
        // send query to the database to add values and confirm if successful
        $rs = mysqli_query($conn, $sql);
        if($rs)
        {
            echo "Entries added!";
            header("Location:itemlist.php");
        }
    }
  
    // close connection
    mysqli_close($conn);
?>
</main> 
<!-- to prevent resubmission when refreshing page -->
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script> 
</body>
</html>