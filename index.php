<?php
session_start();


    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo $user_data['user_name'];?></title>
  <meta name="description" content="Website starter HTML template for an application">
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
      <div class=""> <a href="index.html" class="d-flex align-items-center text-dark text-decoration-none"> <img
            src="assets/images/logo.jpg" class="mt-1" width="70"> </a> </div>
      <div class="ms-auto">        <a
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
              <li class="nav-item"> <a class="nav-link" href="cus-item-list2.php">Item List</a></li>
              <li class="nav-item"> <a class="nav-link" href="pawn-sell2.html">Pawn/sell</a></li>
              <li class="nav-item"> <a class="nav-link" href="cus-expert-list2.php">Expert List</a></li>
              <li class="nav-item"> <a class="nav-link" href="contact2.html">Contacts</a></li>
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
            <h1 class="my-3 text-center">Hello <?php echo $user_data['user_name']?></h1>
            <div class="row align-items-center justify-content-center">
              <div class="col-md-8 text-center my-3">
                <p>Below are navigation tools tailored to meet all your pawn experiences in the best possible way.
                    Here you can find the necessary navigation tools to see all your past purchases and invoices you have been provided with the items you have previously puruchased or sold to us.
                    
                </p> 
                  <!-- button -->
                  <a href="cus-invoicelist.php?customer_id=<?php echo $user_data['customer_id']?>" class="btn btn-secondary btn-lg me-2 shadow mb-2">View Your Invoice History</a> 
                  <a href="cus-pawnticketlist.php?customer_id=<?php echo $user_data['customer_id']?>" class="btn btn-lg btn-secondary shadow mb-2">View Your Pawn Status</a>
              </div>
            </div>
          </div>
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
              <li class="nav-item"><a href="index.html" class="nav-link p-2">Home</a></li>
              <li class="nav-item"> <a class="nav-link" href="cus-item-list2.php">Item list</a></li>
              <li class="nav-item"> <a class="nav-link" href="pawn-sell2.html">Pawn/Sell</a></li>
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
            <div class="text-white-50 mt-4"> <small>Copyrights ©2023 pawnasiba.com Powered by
                <a href="./index.html" class="text-white fw-semibold text-decoration-none">PAWNASIBA</a></small>
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