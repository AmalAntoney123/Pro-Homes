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
                <span class="d-none d-lg-inline-flex"><?php echo "$fname $lname";  ?></span>
                <img class="rounded-circle ml-2 me-lg-2" src="uploads/<?php echo $target; ?>" alt="" style="width: 40px; height: 40px;">

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
            <button class="btn btn-primary d-lg-none w-100  d-md-none" type="button" data-toggle="collapse" data-target="#sidebar" aria-expanded="false" aria-controls="sidebar">
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
                    <div class="row p-2 bg-white border rounded">
                      <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="assets/imgs/p1.jpg"></div>
                      <div class="col-md-6 mt-1">
                        <h5>Jordan Carter</h5>
                        <div class="d-flex flex-row">
                          <div class="ratings mr-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div><span>310</span>
                        </div>
                        <div class="mt-1 mb-1 spec-1"><span>Plumber</span><span class="dot"></span><span> Dummy</span><span class="dot"></span><span> ✓<br></span></div>
                        <div class="mt-1 mb-1 spec-1"><span>Unique design</span><span class="dot"></span><span>For
                            men</span><span class="dot"></span><span>Casual<br></span></div>
                        <p class="text-justify text-truncate para mb-0">There are many variations of passages of Lorem Ipsum
                          available, but the majority have suffeOrganisation alteration in some form, by injected humour, or
                          randomised words which don't look even slightly believable.<br><br></p>
                      </div>
                      <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                        <div class="d-flex flex-row align-items-center">
                          <h4 class="mr-1">$13.99</h4><span class="strike-text">/ hr</span>
                        </div>
                        <h6 class="text-success">Blank</h6>
                        <div class="d-flex flex-column mt-4"><button class="btn btn-primary btn-sm" type="button">Details</button><button class="btn btn-outline-primary btn-sm mt-2" type="button">Book Now</button></div>
                      </div>
                    </div>
                    <div class="row p-2 bg-white border rounded mt-2">
                      <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="assets/imgs/p2.jpg"></div>
                      <div class="col-md-6 mt-1">
                        <h5>Marcus Lee</h5>
                        <div class="d-flex flex-row">
                          <div class="ratings mr-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div><span>310</span>
                        </div>
                        <div class="mt-1 mb-1 spec-1"><span>Electrician</span><span class="dot"></span><span> Dummy</span><span class="dot"></span><span> ✓<br></span></div>
                        <div class="mt-1 mb-1 spec-1"><span>Unique design</span><span class="dot"></span><span>For
                            men</span><span class="dot"></span><span>Casual<br></span></div>
                        <p class="text-justify text-truncate para mb-0">There are many variations of passages of Lorem Ipsum
                          available, but the majority have suffeOrganisation alteration in some form, by injected humour, or
                          randomised words which don't look even slightly believable.<br><br></p>
                      </div>
                      <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                        <div class="d-flex flex-row align-items-center">
                          <h4 class="mr-1">$14.99</h4><span class="strike-text">/ hr</span>
                        </div>
                        <h6 class="text-success">Blank</h6>
                        <div class="d-flex flex-column mt-4"><button class="btn btn-primary btn-sm" type="button">Details</button><button class="btn btn-outline-primary btn-sm mt-2" type="button">Book Now</button></div>
                      </div>
                    </div>
                    <div class="row p-2 bg-white border rounded mt-2">
                      <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="assets/imgs/p3.jpg"></div>
                      <div class="col-md-6 mt-1">
                        <h5>Aria Patel</h5>
                        <div class="d-flex flex-row">
                          <div class="ratings mr-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div><span>123</span>
                        </div>
                        <div class="mt-1 mb-1 spec-1"><span>Maid</span><span class="dot"></span><span> Dummy</span><span class="dot"></span><span> ✓<br></span></div>
                        <div class="mt-1 mb-1 spec-1"><span>Unique design</span><span class="dot"></span><span>For
                            men</span><span class="dot"></span><span>Casual<br></span></div>
                        <p class="text-justify text-truncate para mb-0">There are many variations of passages of Lorem Ipsum
                          available, but the majority have suffeOrganisation alteration in some form, by injected humour, or
                          randomised words which don't look even slightly believable.<br><br></p>
                      </div>
                      <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                        <div class="d-flex flex-row align-items-center">
                          <h4 class="mr-1">$13.99</h4><span class="strike-text">/ hr</span>
                        </div>
                        <h6 class="text-success">Blank</h6>
                        <div class="d-flex flex-column mt-4"><button class="btn btn-primary btn-sm" type="button">Details</button><button class="btn btn-outline-primary btn-sm mt-2" type="button">Book Now</button></div>
                      </div>
                    </div>
                    <div class="row p-2 bg-white border rounded mt-2">
                      <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="assets/imgs/p4.jpg"></div>
                      <div class="col-md-6 mt-1">
                        <h5>Maya Davis</h5>
                        <div class="d-flex flex-row">
                          <div class="ratings mr-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div><span>110</span>
                        </div>
                        <div class="mt-1 mb-1 spec-1"><span>Repair and Services</span><span class="dot"></span><span> Dummy</span><span class="dot"></span><span> ✓<br></span></div>
                        <div class="mt-1 mb-1 spec-1"><span>Unique design</span><span class="dot"></span><span>For
                            men</span><span class="dot"></span><span>Casual<br></span></div>
                        <p class="text-justify text-truncate para mb-0">There are many variations of passages of Lorem Ipsum
                          available, but the majority have suffeOrganisation alteration in some form, by injected humour, or
                          randomised words which don't look even slightly believable.<br><br></p>
                      </div>
                      <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                        <div class="d-flex flex-row align-items-center">
                          <h4 class="mr-1">$15.99</h4><span class="strike-text">$21.99</span>
                        </div>
                        <h6 class="text-success">Blank</h6>
                        <div class="d-flex flex-column mt-4"><button class="btn btn-primary btn-sm" type="button">Details</button><button class="btn btn-outline-primary btn-sm mt-2" type="button">Book Now</button></div>
                      </div>
                    </div>
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