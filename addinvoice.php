<?php
include('connectmysqli.php');
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
<h3> Add Invoice <h3>

<div class="form">
<form method="POST">

    <div class="form-row">
    <label for="inputitem_id">Item ID</label>
    <?php 
        $query ="SELECT item_id, name FROM item WHERE status = 'for sale' or status = 'sold'";
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
      <label for="inputbuying_price">Buying Price</label>
      <input type="number" class="form-control" id="inputbuying_price" placeholder="buying_price" name="buying_price"> 
    </div>

  <div class="form-row">
    <label for="inputselling_price">Selling Price</label>
    <input type="number" class="form-control" id="inputselling_price" placeholder="selling_price" name="selling_price">
  </div>

  <div class="form-row">
  <label for="inputdate_of_payment">Date of Payment</label>
      <input type="date" class="form-control" id="inputdate_of_payment" placeholder="date_of_payment" name="date_of_payment">
  </div>

    <div class="form-row">
    <label for="inputaction">Action</label>
      <select id="inputaction" class="form-control" name="action">
        <option selected>for sale</option>
        <option>sold</option>
      </select>
    </div>

</div>
    <p><input type="submit" name="submit" id="submit" value="Add Invoice"></p>
    <p><a href="home.php" class="btn btn-success">Go Back</a></p>
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