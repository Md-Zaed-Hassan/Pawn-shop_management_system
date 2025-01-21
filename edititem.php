<?php
include('connectmysqli.php');

if(isset($_GET['edit'])){
  $item_id = $_GET['edit'];

  $sql = "select * from item where item_id='$item_id'";

  $result = $conn->query($sql);

  if ($result->num_rows > 0){

  $row = $result->fetch_assoc();

  $name = $row["name"];
  $customer_id = $row["customer_id"];
  $brand = $row["brand"];
  $type = $row["type"];
  $model = $row["model"];
  $status = $row["status"];
  $old_status = $status;
  $expert_id = $row["expert_id"];
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
    <title>Update Item</title>
</head>
<body>
<main>
<h3> Update Item <h3>

<div class="form">
<form method="POST">

    <div class="form-row">
      <label for="inputname">Name</label>
      <input type="name" class="form-control" id="inputname" value= "<?php echo $name?>" name="name">
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
      <label for="inputbrand">Brand</label>
      <input type="brand" class="form-control" id="inputbrand" value= "<?php echo $brand?>" name="brand">
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
        <option selected><?php echo $type ?></option>
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
    <input type="text" class="form-control" id="inputmodel" value= "<?php echo $model?>" name="model">
  </div>

    <div class="form-row">
      <label for="inputstatus">Status</label>
      <select id="inputstatus" class="form-control" name="status">
        <option selected><?php echo $status ?></option>
        <option>pawn</option>
        <option>for sale</option>
        <option>sent to expert</option>
        <option>sold</option>
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
        <option selected><?php echo $expert_id ?></option>
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
    <input type="submit" name="submit" id="submit" value="Update Item">
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
      $sql = "UPDATE item SET name='$name', customer_id='$customer_id', brand='$brand', 
              type='$type', model='$model', status='$status', expert_id='$expert_id'
              WHERE item_id='$item_id'";

      // send query to the database to add values and confirm if successful
      $rs = mysqli_query($conn, $sql);
      
      $new_status = $status;
      //if status is pawn, then redirect to pawn ticket form
      if ($new_status != $old_status && $new_status == 'pawn'){
        //$sql= "DELETE FROM invoice WHERE item_id = '$item_id'";
        //$result = mysqli_query($conn, $sql);
        header("Location: addpawnticket.php");
      }
      //if status is for sale, then redirect to invoice form
      elseif($new_status == 'sold' && $old_status == 'pawn'){
        header("Location: loanredeemed.php?redeem=".$item_id);
      }elseif(($new_status != $old_status && $new_status == 'for sale') 
        ||($new_status != $old_status && $new_status == 'sold')){
          //if(($new_status == 'sold' && $old_status == 'for sale')
          //||($new_status == 'for sale' && $old_status == 'sold')){ 
          // header("Location: editinvoice.php?edit=".$item_id."-".$name); 
          //}else{
          header("Location: addinvoice.php");
      }else{   
        header( "Location: itemlist.php");
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

