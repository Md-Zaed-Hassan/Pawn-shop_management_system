<?php
include('connectmysqli.php');

if(isset($_GET['edit'])){
    $deets  = $_GET['edit'];
    $info = explode('-',$deets);
    $item_id = $info[0];
    $name = $info[1];

    $sql = "select * from pawn_ticket where item_id='$item_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){

    $row = $result->fetch_assoc();
    $loan_amount = $row["loan_amount"];
    $pawn_ticket_id = $row["pawn_ticket_id"];
    $customer_id = $row["customer_id"];
    $interest = $row["interest"];
    $date_of_payment = $row["date_of_payment"];
    $redeem_date = $row['redeem_date'];
}else{
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
    <title>Update Pawn Ticket</title>
</head>
<body>
<main>
<h3>Update Pawn Ticket<h3>

<div class="form">
<form method="POST">

    <div class="form-row">
    <label for="inputitem_id4">Item ID</label>
    <?php 
        $query ="SELECT item_id, name FROM item WHERE status = 'pawn'";
        $result = $conn->query($query);
        if($result->num_rows> 0){
        $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
        } 
        ?>
        <select name="item_id">
        <option selected><?php echo $item_id ?></option>
        <?php 
        foreach ($options as $option) {
        ?>
        <option><?php echo $option['item_id'];
                      echo $option['name']; ?> </option>
        <?php 
        }
        ?>
        </select>
    </div>

    <div class="form-row">
      <label for="inputloan_amount4">Loan Amount</label>
      <input type="number" class="form-control" id="inputloan_amount4" value= "<?php echo $loan_amount?>" name="loan_amount"> 
    </div>

    <div class="form-row">
      <label for="inputcustomer_id4">Customer ID</label>
      <?php 
        $query ="SELECT customer_id, name FROM customer";
        $result = $conn->query($query);
        if($result->num_rows> 0){
        $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
        } 
        ?>
        <select name="customer_id">
        <option selected><?php echo $customer_id ?></option>
        <?php 
        foreach ($options as $option) {
        ?>
        <option><?php echo $option['customer_id'];
                      echo $option['name']; ?> </option>
        <?php 
        }
        ?>
        </select>
    </div>

    <div class="form-row">
    <label for="inputinterest">Interest(%)</label>
    <input type="decimal"  class="form-control" id="inputinterest" value= "<?php echo $interest?>" name="interest">
  </div>

  <div class="form-row">
  <label for="inputdate_of_payment">Date of Payment</label>
      <input type="date" class="form-control" id="inputdate_of_payment" value= "<?php echo $date_of_payment?>" name="date_of_payment">
  </div>

  <div class="form-row">
      <label for="inputredeem_date">Redeem Date</label>
      <input type="date" class="form-control" id="inputredeem_date" value= "<?php echo $redeem_date?>" name="redeem_date">
    </div>
</div>
    <input type="submit" name="submit" id="submit" value="Update Pawn Ticket">
</form>

<?php
    
    if(isset($_POST['submit']))
    {
        $item_id = $_POST['item_id'];
        $loan_amount = $_POST['loan_amount'];
        $customer_id = $_POST['customer_id'];
        $interest = $_POST['interest'];
        $date_of_payment = $_POST['date_of_payment'];
        $redeem_date = $_POST['redeem_date'];
    

        // using sql to create a data entry query
        $sql = "UPDATE pawn_ticket SET item_id='$item_id', loan_amount='$loan_amount', customer_id='$customer_id', 
                interest='$interest', date_of_payment='$date_of_payment', redeem_date='$redeem_date'
                WHERE item_id='$item_id'";
  
        // send query to the database to add values and confirm if successful
        $rs = mysqli_query($conn, $sql);
        if($rs){   
          header( "Location: pawnticketlist.php");
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