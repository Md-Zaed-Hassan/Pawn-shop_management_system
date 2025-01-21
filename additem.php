
<?php
include('connectmysqli.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "css/main.css">
    <title>Add Item</title>
</head>
<body>
<main>
<h3> Add Item <h3>

<div class="form">
<form method="POST">

    <div class="form-row">
      <label for="inputname">Name</label>
      <input type="name" class="form-control" id="inputname" placeholder="name" name="name">
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
      <label for="inputbrand">Brand</label>
      <input type="brand" class="form-control" id="inputbrand" placeholder="brand" name="brand">
    </div>

  <div class="form-row">
    <label for="inputtype">Type</label>
    <?php 
        $query ="SELECT name FROM category";
        $result = $conn->query($query);
        if($result->num_rows> 0){
        $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
        } 
        ?>

        <select name="type">
        <?php 
        foreach ($options as $option) {
        ?>
        <option><?php echo $option['name']; ?> </option>
        <?php 
        }
        ?>
        </select>
  </div>

  <div class="form-row">
    <label for="inputmodel">Model</label>
    <input type="text" class="form-control" id="inputmodel" placeholder="model" name="model">
  </div>

    <div class="form-row">
      <label for="inputstatus">Status</label>
      <select id="inputstatus" class="form-control" name="status">
        <option selected>pawn</option>
        <option>for sale</option>
        <option>sent to expert</option>
      </select>
    </div>

    <div class="form-row">
      <label for="inputexpert_id">Expert ID</label>
      <?php 
        $query ="SELECT expert_id, expertise FROM expert";
        $result = $conn->query($query);
        if($result->num_rows> 0){
        $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
        } 
        ?>
        <select name="expert_id">
        <?php 
        foreach ($options as $option) {
        ?>
        <option><?php echo $option['expert_id'];
                      echo $option['expertise']?> </option>
                <?php 
        }
        ?>
        </select>
    </div>
</div>
  <p><input type="submit" name="submit" id="submit" value="Add Item"></p>
  <p><a href="home.php" class="btn btn-success">Go Back</a></p>
</form>

<?php
    
    if(isset($_POST['submit']))
    {
        $name = $_POST['name'];
        //$item_id = $_POST['item_id'];
        $customer_id = $_POST['customer_id'];
        $brand = $_POST['brand'];
        $type = $_POST['type'];
        $model = $_POST['model'];
        $status = $_POST['status'];
        $expert_id = $_POST['expert_id'];
    

        // using sql to create a data entry query
        $sql = "INSERT INTO item (name, item_id, customer_id, brand, type, model, status, expert_id) VALUES ('$name', '0',
            '$customer_id', '$brand', '$type', '$model', '$status', '$expert_id')";
  
        // send query to the database to add values and confirm if successful
        $rs = mysqli_query($conn, $sql);
        if($rs)
        {
            echo "Entries added!";
        }
        //if status is pawn, then redirect to pawn ticket form
        if ($status == 'pawn'){
          header("Location: addpawnticket.php");
        }
        //if status is for sale, then redirect to invoice form
        if ($status == 'for sale'){
          header("Location: addinvoice.php");
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