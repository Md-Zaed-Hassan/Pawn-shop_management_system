

<?php
require_once('databasepdo.php');


if(isset($_GET['customer_id']))
{
    $customer_id = $_GET['customer_id'];
    //$password = $_POST['password'];
}
//echo $customer_id;

if(isset($_POST["Clearbutton"])){
    unset($_SESSION["filter"]);
}

//customer_id = 3;
//retrieve all transactions
$strsql = "SELECT item.name, invoice.invoice_id, invoice.buying_price, invoice.customer_id, invoice.selling_price,
         invoice.date_of_payment, invoice.action FROM item INNER JOIN invoice ON item.item_id = invoice.item_id 
         WHERE invoice.customer_id = '$customer_id'";
$parameters = array(); //empty initially

//filter added to query
if(isset($_POST['filter'])){
   $filter = $_POST['filter'];
   $para = "%{$filter}%";
   $strsql .= " AND (item.name LIKE ? OR invoice.buying_price LIKE ?
              OR invoice.selling_price LIKE ? OR invoice.date_of_payment LIKE ?
              OR invoice.action LIKE ?)";
   $parameters = ["%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%"];
   $_SESSION['filter'] = $filter; 
}else{
  if(isset($_SESSION['filter']) && strlen($_SESSION['filter'])>0 ){
    //reapply old filter if user is just sorting
    $filter = $_SESSION['filter'];
    $strsql .= " AND (item.name LIKE ? OR invoice.buying_price LIKE ?
            OR invoice.selling_price LIKE ? OR invoice.date_of_payment LIKE ?
            OR invoice.action LIKE ?)";
$parameters = ["%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%","%{$filter}%"];
  }
}



  $prepared = $conn->prepare($strsql);
  $prepared->execute($parameters);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Invoice History</title>
  <meta name="description" content="Contact - website starter HTML template for an application" >
  <meta name="apple-mobile-web-app-status-bar-style" content="black" />
  <meta name="theme-color" content="currentColor">
  <meta property="og:image" content="https://saltui.com/assets/images/page.jpg?v=7" />
  <link rel="icon" type="image/x-icon" href="/assets/images/favicon.png">

  <!-- Bootstrap CSS library -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous">
  
    
  
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body id="saltuiHtml">

  <header data-aos="fade-zoom-in">
    <div class="d-flex py-4 px-3">
      <div class=""> <a href="/" class="d-flex align-items-center text-dark text-decoration-none"> <img
            src="assets/images/logo.jpg" class="mt-1" width="70"> </a> </div>
<div class="ms-auto">          <a
          class="btn btn-sm btn-secondary rounded-5 px-3" href="logout.php">Logout</a> </div>
    </div>
    <div class="menu bg-primary">
      <nav class="navbar navbar-expand-md p-0 m-0">
        <div class="container-fluid"> <a class="navbar-toggler ms-sm-auto mx-3 me-md-0 p-2 border-0 text-white"
            data-bs-toggle="collapse" data-bs-target="#navbarCategoryCollapse" aria-controls="navbarCategoryCollapse"
            aria-expanded="false" aria-label="Toggle navigation"> <i class="bi bi-list fs-4"></i> </a>
          <div class="navbar-collapse collapse" id="navbarCategoryCollapse">
            <ul class="navbar-nav navbar-nav-scroll nav-pills-primary-soft text-center p-0">
              <li class="nav-item active"> <a class="nav-link" href="index.php">Home</a></li>
              <li class="nav-item "> <a class="nav-link" href="cus-item-list2.php">Item List</a></li>
              <li class="nav-item"> <a class="nav-link" href="pawn-sell2.html">Pawn/sell</a></li>
              <li class="nav-item"> <a class="nav-link" href="cus-expert-list2.php">Expert List</a></li>
              <li class="nav-item"> <a class="nav-link" href="contact2.html">Contact</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
  




  <section class="content">
    <div class="container-fluid p-3 p-md-5">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="bg-slate border p-5 rounded-5" data-aos="fade-up" style="background: linear-gradient(175deg, rgb(104 137 200 / 16%) 0%, rgb(227 93 141 / 12%) 100%)">
            <h1 class="my-3 text-center">Invoice History</h1>
            <form class="filterForm" method="POST" action="cus-invoicelist.php?customer_id=<?php echo $customer_id?>">
              <input type="text" id="filter" name="filter" placeholder="filter keyword" tabindex="0" value="<?= $filter ?? '' ?>"/>
              <input type="submit" name="Filterbutton" id="Filterbutton" value="Go"/>
              <input type="submit" name="Clearbutton" id="Clearbutton" value="Clear Filters"/>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div>
      <table class="table table-hover">
      <?php
        if($prepared->rowCount() > 0){
          echo '<thead>';
          echo '<tr>';
            echo '<th scope="col">Invoice ID</a></th>';
            echo '<th scope="col">Name</a></th>';
            echo '<th scope="col">Action</a></th>';
            echo '<th scope="col">Buying Price</a></th>';
            echo '<th scope="col">Selling Price</a></th>';
            echo '<th scope="col">Date of Payment</a></th>';
            echo '</tr>';
          echo '<thead>';
          echo '<tbody>';
          $prepared->setFetchMode(PDO::FETCH_ASSOC);
          while($row= $prepared->fetch()){
            echo '<tr>';
            echo '<td>'. $row['invoice_id'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            if($row['action']=='for sale'){
            echo '<td>'.'sold'. '</td>';
            echo '<td>'.''. '</td>';
            echo '<td>'.$row['buying_price'];
            }else{
            echo '<td>'.'bought'. '</td>';
            echo '<td>'.$row['selling_price']. '</td>';
            echo '<td>'.''. '</td>';
            }
            echo '<td>' . $row['date_of_payment'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        }else{
          //no products
          echo '<p>No invoices currently available.</p>';
        }
      ?>
      </table>
    </div> 
<script>
    document.getElementById('Clearbutton').addEventListener('click', (ev)=>{
    document.getElementById('filter').value = '';
    })
</script>
  </section>


  <section class="feature" data-aos="fade-up">
    <div class="container py-5">
      <h2 class="h1 text-center text-primary pb-4 py-2">Benefits</h2>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 gy-4 gy-sm-5 gx-4 pb-3 pb-md-4 pb-lg-5 mb-md-3 mb-lg-0">
        <!-- Item-->
        <div class="col text-center">
          <div class="ratio ratio-1x1 position-relative mx-auto mb-3 mb-sm-4" style="width: 68px;">
            <i class="bi bi-tools text-secondary fs-3 d-flex align-items-center justify-content-center position-absolute start-0"></i>
            <svg class="position-absolute top-0 start-0 text-secondary" width="68" height="68" viewbox="0 0 68 68"
              fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M56.0059 60.5579C44.1549 78.9787 18.0053 58.9081 6.41191 46.5701C-2.92817 35.5074 -2.81987 12.1818 11.7792 3.74605C30.0281 -6.79858 48.0623 7.40439 59.8703 15.7971C71.6784 24.1897 70.8197 37.5319 56.0059 60.5579Z"
                fill-opacity="0.1"></path>
            </svg>
          </div>
          <h3 class="h4 pb-2 mb-1">Online support</h3>
          <p class="fs-sm mb-0">Pharetra morbi quis is massa maecenas vulputate elit non nullage a duis tortor mi massa
            pharetra.</p>
        </div> <!-- Item-->
        <div class="col text-center">
          <div class="ratio ratio-1x1 position-relative mx-auto mb-3 mb-sm-4" style="width: 68px;"> <i
              class="bi bi-chat-square-heart text-secondary fs-3 d-flex align-items-center justify-content-center position-absolute start-0"></i>
            <svg class="position-absolute top-0 start-0 text-secondary" width="68" height="68" viewbox="0 0 68 68"
              fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M65.0556 29.2672C75.4219 46.3175 48.5577 59.7388 33.8299 64.3181C21.0447 67.5599 1.98006 58.174 0.888673 42.8524C-0.475555 23.7004 18.3473 14.5883 29.9289 8.26059C41.5104 1.93285 52.0978 7.9543 65.0556 29.2672Z"
                fill-opacity="0.1"></path>
            </svg> </div>
          <h3 class="h4 pb-2 mb-1">100% guarantee</h3>
          <p class="fs-sm mb-0">Sapien ultrices egestas at faucibus eu diam velit diam id amet nibh quam rutrum diam
            diam natoque scelerisque.</p>
        </div> <!-- Item-->
        <div class="col text-center">
          <div class="ratio ratio-1x1 position-relative mx-auto mb-3 mb-sm-4" style="width: 68px;"> <i
              class="bi bi-life-preserver text-secondary fs-3 d-flex align-items-center justify-content-center position-absolute start-0"></i>
            <svg class="position-absolute top-0 start-0 text-secondary" width="68" height="68" viewbox="0 0 68 68"
              fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M6.61057 18.2783C10.8205 -1.22686 39.549 7.51899 53.3869 14.3301C64.8949 20.7749 72.2705 40.7038 62.5199 52.5725C50.3318 67.4085 30.4034 61.0689 17.6454 57.6914C4.88745 54.314 1.3482 42.6597 6.61057 18.2783Z"
                fill-opacity="0.1"></path>
            </svg> </div>
          <h3 class="h4 pb-2 mb-1">Work on time</h3>
          <p class="fs-sm mb-0">Morbi et massa fames ac scelerisque sit commodo dignissim faucibus vel quisque proin
            lectus orbi et massa fames.</p>
        </div> <!-- Item-->
        <div class="col text-center">
          <div class="ratio ratio-1x1 position-relative mx-auto mb-3 mb-sm-4" style="width: 68px;"> <i
              class="bi bi-shop-window text-secondary fs-3 d-flex align-items-center justify-content-center position-absolute start-0"></i>
            <svg class="position-absolute top-0 start-0 text-secondary" width="68" height="68" viewbox="0 0 68 68"
              fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M9.34481 53.5078C-7.24653 42.4218 11.4487 18.9206 22.8702 8.55583C33.0946 0.223307 54.3393 0.690942 61.7922 14.1221C71.1082 30.9111 57.886 47.1131 50.0546 57.7358C42.2233 68.3586 30.084 67.3653 9.34481 53.5078Z"
                fill-opacity="0.1"></path>
            </svg> </div>
          <h3 class="h4 pb-2 mb-1">Free consultation</h3>
          <p class="fs-sm mb-0">Consectetur adipiscing elit proin volutpat mollis egestas nam luctus facilisis ultrices
            pellentesque volutpat ligula est.</p>
        </div>
      </div>
    </div>
  </section>

  <footer class="bg-primary text-white" data-aos="fade-zoom-in">
    <div class="py-5">
      <div class="container">
        <div class="row mx-auto">
          <div class="col-md-4 mx-auto text-center">
            <!-- Links -->
            <ul class="nav justify-content-between mt-5 mt-md-0">
              <li class="nav-item"><a href="index.php" class="nav-link p-2">Home</a></li>
              <li class="nav-item"> <a class="nav-link" href="cus-item-list2.php">Item List</a></li>
              <li class="nav-item"> <a class="nav-link" href="pawn-sell2.html">Pawn/sell</a></li>
              <li class="nav-item"> <a class="nav-link" href="cus-expert-list2.php">Expert List</a></li>
              <li class="nav-item"> <a class="nav-link" href="contact2.html">Contact</a></li>
            </ul>
            <!-- Social media button -->
            <ul class="list-inline mt-4 mb-0">
              <li class="list-inline-item">
                <a class="btn btn-light btn-sm px-2 text-facebook" href="#">
                  <i class="bi bi-facebook"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-light btn-sm px-2 text-instagram" href="#">
                  <i class="bi bi-instagram"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-light btn-sm px-2 text-twitter" href="#">
                  <i class="bi bi-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-light btn-sm px-2 text-linkedin" href="#">
                  <i class="bi bi-linkedin"></i>
                </a>
              </li>
            </ul>
            <!-- copyright text -->
            <div class="text-white-50 mt-4"> <small>Copyrights ©2023 saltui.com Powered by
                <a href="https://www.saltui.com/" class="text-white fw-semibold text-decoration-none">SALTUI</a></small>
            </div>
          </div>
        </div>

      </div>
    </div>
  </footer>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <script>
    AOS.init({
      duration: 1200,
    })
  </script>
  <!-- Bootstrap JavaScript library -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
</body>

</html>