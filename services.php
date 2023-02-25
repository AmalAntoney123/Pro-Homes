<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>ProHomes - House services</title>

  <link rel="icon" href="assets/imgs/Logo.png" type="image/icon type">





  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />


  <!-- font icons -->
  <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">




  <!-- Bootstrap + Ollie main styles -->
  <link rel="stylesheet" href="assets/css/ollie.css">
  <?php
  if (isset($_SESSION["l_id"])) {

    include("connection.php");
    $lid = $_SESSION["l_id"];
    if ($lid) {
      $lid = $_SESSION["l_id"];
      $query = "SELECT * FROM `tbl_user` 
                    WHERE `User_ID` = '$lid'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      $target = $row["Profile_Picture"];
      $fname = ucfirst($row["First_Name"]);
      $lname = ucfirst($row["Last_Name"]);
    } else {
      $target = "default.webp";
    }
  }
  ?>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home" class="">

  <nav id="scrollspy" class="navbar navbar-black bg-light navbar-expand-lg ">
    <div class="container">
      <a class="navbar-brand" href="#"><img src="assets/imgs/logo.png" alt="" class="brand-img"></a>
      <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse"
        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon navbar-light"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <?php
          if (isset($_SESSION["l_id"])) {
            ?>
            <li class="nav-item">
              <a class="nav-link mt-2" href="index.php">Home</a>
            </li>


            <div class="nav-item dropdown ">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <span class="d-none d-lg-inline-flex">
                  <?php echo "$fname $lname"; ?>
                </span>
                <img class="rounded-circle ml-2 me-lg-2" src="uploaded files/Profile Pictures/<?php echo $target; ?>"
                  alt="" style="width: 40px; height: 40px;">

              </a>
              <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="user_profile.php" class="dropdown-item">My Profile</a>
                <a href="user_profile.php" class="dropdown-item">Settings</a>
                <a href="logout.php" class="dropdown-item">Log Out</a>
              </div>
            </div>

            <?php
          } else {
            ?>
            <li class="nav-item">
              <a class="nav-link pb-2" href="index.php">Home</a>
            </li>
            <li class="nav-item ml-0 ml-lg-4">
              <a class="nav-link btn btn-primary" href="signin.php">Login</a>
            </li>
            <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>



  <section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-3 bg-light pr-0">
          <div class="p-3">
            <!-- Sidebar (desktop) -->
            <div class="btn-group-vertical collapse d-md-block justify-content-center" style="height: 100vh;">
              <h3>Filters</h3>
              <hr>
              <h5>City</h5>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                  Kochi
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                <label class="form-check-label" for="defaultCheck2">
                  Kottayam
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck3">
                <label class="form-check-label" for="defaultCheck3">
                  Trivandrum
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck4">
                <label class="form-check-label" for="defaultCheck4">
                  Calicut
                </label>
              </div>
              <hr>
              <h5>Price Range</h5>
              <div class="form-group">
                <input type="range" class="form-control-range" id="priceRange">
              </div>
              <hr>
              <h5>Type</h5>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="colorCheck1">
                <label class="form-check-label" for="colorCheck1">
                  Organisation
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="colorCheck2">
                <label class="form-check-label" for="colorCheck2">
                  Personal
                </label>
              </div>

              <hr>
              <h5>Service</h5>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="sizeCheck1">
                <label class="form-check-label" for="sizeCheck1">
                  Plumber
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="sizeCheck2">
                <label class="form-check-label" for="sizeCheck2">
                  Electrician
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="sizeCheck3">
                <label class="form-check-label" for="sizeCheck3">
                  Exterminator
                </label>
              </div>
              <hr>

            </div>
            <!-- Show/hide sidebar (mobile) -->
            <button class="btn btn-primary d-lg-none w-100  d-md-none" type="button" data-toggle="collapse"
              data-target="#sidebar" aria-expanded="false" aria-controls="sidebar">
              <i class="fa fa-filter"></i> Filters
            </button>

            <!-- Sidebar (mobile) -->
            <div class="collapse d-lg-none w-100" id="sidebar">
              <div class="btn-group-vertical">
                <hr>
                <h5>City</h5>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1">
                    Kochi
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                  <label class="form-check-label" for="defaultCheck2">
                    Kottayam
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck3">
                  <label class="form-check-label" for="defaultCheck3">
                    Trivandrum
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck4">
                  <label class="form-check-label" for="defaultCheck4">
                    Calicut
                  </label>
                </div>
                <hr>
                <h5>Price Range</h5>
                <div class="form-group">
                  <input type="range" class="form-control-range" id="priceRange">
                </div>
                <hr>
                <h5>Type</h5>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="colorCheck1">
                  <label class="form-check-label" for="colorCheck1">
                    Organisation
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="colorCheck2">
                  <label class="form-check-label" for="colorCheck2">
                    Personal
                  </label>
                </div>

                <hr>
                <h5>Service</h5>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="sizeCheck1">
                  <label class="form-check-label" for="sizeCheck1">
                    Plumber
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="sizeCheck2">
                  <label class="form-check-label" for="sizeCheck2">
                    Electrician
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="sizeCheck3">
                  <label class="form-check-label" for="sizeCheck3">
                    Exterminator
                  </label>
                </div>
                <hr>

              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-9 col-md-9">
          <!-- Main content -->
          <!-- Product Listing -->
          <div class="col-12">
            <div class="container">
              <div class="container mt-5 mb-5">
                <div class="d-flex justify-content-center row">
                  <div class="col-md-12">
                     <?php include 'Service_list_paged.php' ?>
                     
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  </section>



  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="lib/chart/chart.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/tempusdominus/js/moment.min.js"></script>
  <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
  <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

  <!-- Template Javascript -->
  <script src="js/main.js"></script>
  <!-- core  -->
  <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
  <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>

  <!-- bootstrap 3 affix -->
  <script src="assets/vendors/bootstrap/bootstrap.affix.js"></script>


</body>

</html>