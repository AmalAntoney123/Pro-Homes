<?php session_start();
include("connection.php"); ?>
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
  <link rel="stylesheet" href="assets/css/scrollbar.css" />



  <!-- Bootstrap + Ollie main styles -->
  <link rel="stylesheet" href="assets/css/ollie.css">
  <?php
  if (isset($_SESSION["l_id"])) {


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
  <style>
    .pagination li a,
    .pagination li span {
      color: #f06161;
      border-color: #f06161;
    }

    .pagination li.active a,
    .pagination li.active span {
      background-color: #f06161;
      border-color: #f06161;
      color: white;
    }

    .pagination li.disabled a,
    .pagination li.disabled span {
      color: #ccc;
      pointer-events: none;
      cursor: default;
    }

    .bg-white {
      background-color: white;
    }

    .border {
      border: 1px solid #f06161;
    }

    .text-info {
      color: #f06161;
    }

    .btn-primary {
      background-color: #f06161;
      border-color: #f06161;
    }

    .btn-primary:hover {
      background-color: white;
      border-color: #f06161;
      color: #f06161;
    }

    .btn-outline-primary {
      border-color: #f06161;
      color: #f06161;
    }

    .btn-outline-primary:hover {
      background-color: #f06161;
      border-color: #f06161;
      color: white;
    }

    .strike-text {
      color: #f06161;
      text-decoration: line-through;
    }

    .text-success {
      color: #28a745;
    }

    .dot {
      height: 10px;
      width: 10px;
      margin-left: 5px;
      margin-right: 5px;
      background-color: #f06161;
      border-radius: 50%;
      display: inline-block;
    }

    .review {
      max-height: 400px;
      /* set a maximum height for the modal body */
      overflow-y: auto;
      /* add a scrollbar when the content exceeds the maximum height */
    }


    .form-group #rangeValue {
      margin-top: 10px;
      text-align: center;
    }
  </style>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home" class="">

  <nav id="scrollspy" class="navbar navbar-black bg-light navbar-expand-lg ">
    <div class="container">
      <a class="navbar-brand" href="index.php"><img src="assets/imgs/logo.png" alt="" class="brand-img"></a>
      <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                <img class="rounded-circle ml-2 me-lg-2" src="uploaded files/Profile Pictures/<?php echo $target; ?>" alt="" style="width: 40px; height: 40px; object-fit: cover;">

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
            <div class="btn-group-vertical mb-3 collapse d-md-block justify-content-center" style="height: 200vh;">

              <form action="#" method="GET">
                <h3>Filters</h3>
                <hr>
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" id="searchBar" name="search" placeholder="Search...">
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="submit" name="sub_search">Search</button>
                    </div>
                  </div>
                </div>
                <hr>
                <h5>City</h5>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="kochi" id="defaultCheck1" name="city[]" <?php
                                                                                                                  if (isset($_REQUEST['city']) && in_array('kochi', $_REQUEST['city']))
                                                                                                                    echo "checked" ?>>
                  <label class="form-check-label" for="defaultCheck1">
                    Kochi
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="kottayam" id="defaultCheck2" name="city[]" <?php if (isset($_REQUEST['city']) && in_array('kottayam', $_REQUEST['city']))
                                                                                                                      echo "checked" ?>>
                  <label class="form-check-label" for="defaultCheck2">
                    Kottayam
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="trivandrum" id="defaultCheck3" name="city[]" <?php if (isset($_REQUEST['city']) && in_array('trivandrum', $_REQUEST['city']))
                                                                                                                        echo "checked" ?>>
                  <label class="form-check-label" for="defaultCheck3">
                    Trivandrum
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="calicut" id="defaultCheck4" name="city[]" <?php
                                                                                                                    if (isset($_REQUEST['city']) && in_array('calicut', $_REQUEST['city']))
                                                                                                                      echo "checked" ?>>
                  <label class="form-check-label" for="defaultCheck4">
                    Calicut
                  </label>
                </div>
                <hr>
                <h5>Price Range</h5>
                <div class="form-group">
                  <input type="range" value="<?php if (isset($_REQUEST['pricefilter']))
                                                echo $_REQUEST['pricefilter'];
                                              else
                                                echo '0' ?>" class="form-control-range" id="priceRange" min="0" step="50" max="2000" name="pricefilter" oninput="this.nextElementSibling.value = this.value">
                  <output id="rangeValue">
                    <?php if (isset($_REQUEST['pricefilter']))
                      echo $_REQUEST['pricefilter']; ?>
                  </output><span>₹</span>
                </div>
                <hr>
                <h5>Service</h5>
                <?php $query = "SELECT * FROM `tbl_services`";
                $result = mysqli_query($con, $query);
                while ($tbl_service = mysqli_fetch_array($result)) { ?>

                  <?php echo '<div class="form-check">
                                  <input class="form-check-input" name="service_filter[]" type="checkbox" value="' . $tbl_service['Service_Name'] . '" id="sizeCheck3" ';
                  if (isset($_REQUEST['service_filter']) && in_array($tbl_service['Service_Name'], $_REQUEST['service_filter']))
                    echo "checked";
                  echo '>
                                  <label class="form-check-label" for="sizeCheck3">
                                    ' . $tbl_service['Service_Name'] . '
                                  </label>
                                </div>';
                  ?>
                <?php } ?>

                <hr>
                <div class="mb-3 block"><button type="submit" name="sub_filter" class="btn btn-primary">Apply
                    Filters</button>
                  <button type="submit" name="sub_unset" class="btn btn-primary">Remove Filters</button>
                </div>
              </form>
            </div>
            <!-- Show/hide sidebar (mobile) -->
            <button class="btn btn-primary d-lg-none w-100  d-md-none" type="button" data-toggle="collapse" data-target="#sidebar" aria-expanded="false" aria-controls="sidebar">
              <i class="fa fa-filter"></i> Filters
            </button>

            <!-- Sidebar (mobile) -->
            <div class="collapse d-lg-none w-100" id="sidebar">
              <div class="btn-group-vertical">
                <div class="form-group">
                  <label for="searchBar">Search:</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="searchBar" name="search" placeholder="Search...">
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="submit" name="sub_search">Search</button>
                    </div>
                  </div>
                </div>
                <form action="#" method="GET">
                  <h3>Filters</h3>
                  <hr>
                  <h5>City</h5>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="kochi" id="defaultCheck1" name="city[]" <?php
                                                                                                                    if (isset($_REQUEST['city']) && in_array('kochi', $_REQUEST['city']))
                                                                                                                      echo "checked" ?>>
                    <label class="form-check-label" for="defaultCheck1">
                      Kochi
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="kottayam" id="defaultCheck2" name="city[]" <?php if (isset($_REQUEST['city']) && in_array('kottayam', $_REQUEST['city']))
                                                                                                                        echo "checked" ?>>
                    <label class="form-check-label" for="defaultCheck2">
                      Kottayam
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="trivandrum" id="defaultCheck3" name="city[]" <?php if (isset($_REQUEST['city']) && in_array('trivandrum', $_REQUEST['city']))
                                                                                                                          echo "checked" ?>>
                    <label class="form-check-label" for="defaultCheck3">
                      Trivandrum
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="calicut" id="defaultCheck4" name="city[]" <?php
                                                                                                                      if (isset($_REQUEST['city']) && in_array('calicut', $_REQUEST['city']))
                                                                                                                        echo "checked" ?>>
                    <label class="form-check-label" for="defaultCheck4">
                      Calicut
                    </label>
                  </div>
                  <hr>
                  <h5>Price Range</h5>
                  <div class="form-group">
                    <input type="range" value="<?php if (isset($_REQUEST['pricefilter']))
                                                  echo $_REQUEST['pricefilter'];
                                                else
                                                  echo '0' ?>" class="form-control-range" id="priceRange" min="0" step="50" max="2000" name="pricefilter" oninput="this.nextElementSibling.value = this.value">
                    <output id="rangeValue">
                      <?php if (isset($_REQUEST['pricefilter']))
                        echo $_REQUEST['pricefilter']; ?>
                    </output><span>₹</span>
                  </div>
                  <hr>
                  <h5>Service</h5>
                  <?php $query = "SELECT * FROM `tbl_services`";
                  $result = mysqli_query($con, $query);
                  while ($tbl_service = mysqli_fetch_array($result)) { ?>

                    <?php echo '<div class="form-check">
                                  <input class="form-check-input" name="service_filter[]" type="checkbox" value="' . $tbl_service['Service_Name'] . '" id="sizeCheck3" ';
                    if (isset($_REQUEST['service_filter']) && in_array($tbl_service['Service_Name'], $_REQUEST['service_filter']))
                      echo "checked";
                    echo '>
                                  <label class="form-check-label" for="sizeCheck3">
                                    ' . $tbl_service['Service_Name'] . '
                                  </label>
                                </div>';
                    ?>
                  <?php } ?>

                  <hr>
                  <div class="mb-3 block"><button type="submit" name="sub_filter" class="btn btn-primary">Apply
                      Filters</button>
                    <button type="submit" name="sub_unset" class="btn btn-primary">Remove Filters</button>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-9 col-md-9">
          <!-- <div class="btn-group btn-group-toggle d-flex justify-content-center" data-toggle="buttons">
            <label class="btn btn-secondary rounded-0 active mr-2">
              <input type="radio" name="options" id="option1" autocomplete="off" checked>
              Name <i class="fas fa-sort"></i>
            </label>
            <label class="btn btn-secondary rounded-0 mr-2">
              <input type="radio" name="options" id="option2" autocomplete="off">
              Rating <i class="fas fa-sort"></i>
            </label>
            <label class="btn btn-secondary rounded-0 mr-2">
              <input type="radio" name="options" id="option3" autocomplete="off">
              Price <i class="fas fa-sort"></i>
            </label>
          </div> -->

          <!-- Main content -->
          <!-- Product Listing -->
          <div class="col-12">

            <?php include 'Service_list_paged.php' ?>


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