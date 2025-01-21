
<?php
include ('connectmysqli.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "css/main.css">
    <title>Add Pawn Ticket</title>
</head>
<body>
<main>
<h3> Add Pawn Ticket <h3>

<div class="form">
<form method="POST">

    <div class="form-row">
    <label for="inputitem_id">Item ID</label>
    <?php 
        $query ="SELECT item_id, name FROM item WHERE status = 'pawn'";
        $result = $conn->query($query);
        if($result->num_rows> 0){
        $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
        } 
        ?>
        <select name="item_id">
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
      <label for="inputloan_amount">Loan Amount</label>
      <input type="number" class="form-control" id="inputloan_amount" placeholder="loan_amount" name="loan_amount"> 
    </div>

    <div class="form-row">
      <label for="inputcustomer_id">Customer ID</label>
      <?php 
        $query ="SELECT customer_id, name FROM customer";
        $result = $conn->query($query);
        if($result->num_rows> 0){
        $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
        } 
        ?>
        <select name="customer_id">
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
    <input type="decimal" class="form-control" id="inputinterest" placeholder="interest" name="interest">
  </div>

  <div class="form-row">
  <label for="inputdate_of_payment">Date of Loan Payment</label>
      <input type="date" class="form-control" id="inputdate_of_payment" placeholder="date_of__loan_payment" name="date_of_payment">
  </div>

    <div class="form-row">
      <label for="inputredeem_date">Redeem Date</label>
      <input type="date" class="form-control" id="inputredeem_date" placeholder="redeem_date" name="redeem_date">
    </div>

</div>
  <p><input type="submit" name="submit" id="submit" value="Add Pawn Ticket"></p>
  <p><a href="home.php" class="btn btn-success">Go Back</a></p>
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
        $sql = "INSERT INTO pawn_ticket (item_id, loan_amount, pawn_ticket_id, customer_id, interest, date_of_payment, 
                                        redeem_date) VALUES ('$item_id', '$loan_amount', '0', 
                                        '$customer_id', '$interest', '$date_of_payment', '$redeem_date')";
  
        // send query to the database to add values and confirm if successful
        $rs = mysqli_query($conn, $sql);
        if($rs)
        {
            echo "Entries added!";
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