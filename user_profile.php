<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>ProHomes - House services</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="icon" href="assets/imgs/Logo.png" type="image/icon type">

  <!-- font icons -->
  <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">


  <!-- Bootstrap + Ollie main styles -->
  <link rel="stylesheet" href="assets/css/ollie.css">
  <link rel="stylesheet" href="assets/css/siginin.css">

  <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
  <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>

  <script src="assets/js/validationprofile.js"></script>

  <style>
    .nav-link {
      color: #f06161;
      transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out;
    }

    .nav-link:focus,
    .nav-link:hover {
      color: #ee2424;
    }

    .form-floating {
      height: calc(4.5rem + 15px);
      position: relative;
    }
  </style>
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
      $uname = ucfirst($row["Username"]);
      $mail = ucfirst($row["Email"]);
      $phone = ucfirst($row["Phone_Number"]);
      $city = ucfirst($row["City"]);
    } else {
      $target = "default.webp";
    }
  }
  ?>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home" class="bg-light">

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
                <img class="rounded-circle ml-2 me-lg-2" src="uploaded files/Profile Pictures/<?php echo $target; ?>" alt=""
                  style="width: 40px; height: 40px;">

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

  <?php
  if (isset($_SESSION["l_id"])) {
    ?>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-lg-5 col-12">
            <div class="ps-md-4 shadow-sm pt-5 pb-5 mb-5 my-2 bg-white" style="border-radius:20px;">
              <div class="d-flex flex-column align-items-center">
                <div class="row px-5">
                  <img class="photo" src="uploaded files/Profile Pictures/<?php echo $target; ?>" alt="" class="img-fluid ">
                </div>
                <p class="fw-bold h4 mt-3">
                  <?php echo "$fname $lname"; ?>
                </p>
                <div class="d-flex ">
                  <div class="btn btn-primary follow me-2">Follow</div>
                  <div class="btn btn-outline-primary message">Message</div>
                </div>
              </div>
              <ul class="nav flex-column my-5">

                <li class="nav-item border-top ">
                  <a href="" class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</a>
                </li>

                <li class="nav-item border-top">
                  <a href="" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                    Profile</a>
                </li>

                <li class="nav-item border-top">
                  <a href="" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change
                    Password</a>
                </li>
                <li class="nav-item border-top border-bottom">
                  <a href="service_signin.php" class="nav-link">Become A Service Provider</a>
                </li>

              </ul>
            </div>
          </div>
          <div class="col-lg-7 col-12 ">
            <div class="ps-md-4 shadow-sm mx-2 p-5 my-2 bg-white" style="border-radius:20px;">
              <div class="">
                <div class=" pt-3">

                  <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                      <h1 class="mb-5">Overview</h1>
                      <div class="d-flex align-items-center justify-content-between border-bottom">
                        <p class="py-2">First Name</p>
                        <p class="py-2 text-muted">
                          <?php echo "$fname"; ?>
                        </p>
                      </div>
                      <div class="d-flex align-items-center justify-content-between border-bottom">
                        <p class="py-2">Last Name</p>
                        <p class="py-2 text-muted">
                          <?php echo "$lname"; ?>
                        </p>
                      </div>
                      <div class="d-flex align-items-center justify-content-between border-bottom">
                        <p class="py-2">Username</p>
                        <p class="py-2 text-muted">
                          <?php echo "$uname"; ?>
                        </p>
                      </div>
                      <div class="d-flex align-items-center justify-content-between border-bottom">
                        <p class="py-2">Email</p>
                        <p class="py-2 text-muted">
                          <?php echo "$mail"; ?>
                        </p>
                      </div>
                      <div class="d-flex align-items-center justify-content-between border-bottom">
                        <p class="py-2">Phone</p>
                        <p class="py-2 text-muted">
                          <?php echo "$phone"; ?>
                        </p>
                      </div>
                      <div class="d-flex align-items-center justify-content-between border-bottom">
                        <p class="py-2">City</p>
                        <p class="py-2 text-muted">
                          <?php echo "$city"; ?>
                        </p>
                      </div>

                    </div>

                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                      <h1 class="mb-5">Edit Profile</h1>
                      <form action="update_profile.php" method="POST" enctype="multipart/form-data">
                        <!-- 2 column grid layout with text inputs for the first and last names -->

                        <div class="form-floating form-outline ">
                          <input type="text" required name="fname" autofocus id="fname" value="<?php echo "$fname"; ?>"
                            class="form-control" placeholder=" " />
                          <label class="form-label" for="fname">First name</label>
                          <span class="error text-left" id="error1"> * Name should contain letters
                            only</span>
                        </div>
                        <div class="form-floating form-outline">
                          <input type="text" required name="lname" id="lname" class="form-control" placeholder=" "
                            value="<?php echo "$lname"; ?>" />
                          <label class="form-label" for="lname">Last name</label>
                          <span class="error text-left" id="error2"> * Name should contain letters
                            only</span>
                        </div>


                        <div class="form-floating form-floating mb-3">
                          <input type="text" required name="uname" class="form-control" id="uname" placeholder=" "
                            value="<?php echo "$uname"; ?>">
                          <span class="erroruname" id="erroruname"></span>
                          <label for="uname">User Name</label>
                          <span class="error" id="error3"> * Username can contain only letters,
                            digits and
                            underscore</span>

                        </div>

                        <div class="form-floating form-floating mb-3">
                          <input type="number" required name="phone" class="form-control" id="phone" placeholder=" "
                            value="<?php echo "$phone"; ?>" />
                          <label for="phone">Phone Number</label>
                          <span class="error" id="error10"> * Invalid phone number</span>
                        </div>





                        <div class="row">
                          <div class="col-md-6 mb-4">
                            <div class="form-floating form-outline">
                              <input accept="image/jpeg,image/png" onchange="validateFileType()" type="file" id="file"
                                name="p_pic" value="Profile Picture" class="form-control" placeholder=" " />
                              <label class="form-label" for="file">Profile Picture</label>
                              <span id="error8">&nbsp; </span>
                            </div>
                          </div>

                          <div class="col-md-6 mb-4">
                            <div class="form-floating form-outline">
                              <select type="text" name="city" id="city" required class="form-control" placeholder=" ">
                                <option selected>
                                  <?php echo "$city"; ?>
                                </option>
                                <option>Kochi</option>
                                <option>Kottayam</option>
                                <option>Trivandrum</option>
                              </select>
                              <label class="form-label" for="city">City</label>
                              <span id="error9">&nbsp; </span>
                            </div>
                          </div>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" id="sub" class="btn btn-primary btn-block mb-4" width="">
                          Save Changes
                        </button>

                        </ul>


                      </form>
                    </div>

                    <div class="tab-pane fade pt-3 mb-4" id="profile-change-password">
                      <h1 class="mb-5">Change Password</h1>
                      <!-- Change Password Form -->
                      <form action="change_password.php" method="POST">

                        <div class="row mb-3">
                          <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="password" type="password" class="form-control" id="currentPassword">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                            Password</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="newpassword" type="password" class="form-control" id="newPassword">
                            <span id="error6" class="error"> * Password needs uppercase, special &
                              numbers.</span>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New
                            Password</label>

                          <div class="col-md-8 col-lg-9">
                            <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                            <span id="error7" class="error"> * Password doesnot match</span>
                          </div>
                        </div>

                        <div class="text-center">
                          <button type="submit" id="sub1" class="btn btn-primary">Change Password</button>
                        </div>
                      </form><!-- End Change Password Form -->

                    </div>

                  </div><!-- End Bordered Tabs -->

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
    <section class="section bg-overlay mt-5">

      <div class="container">
        <div class="infos mb-4 mb-md-2">
          <div class="title">
            <img src="assets/imgs/Logo-white.png" height="60" width="60">
            <p class="font-small">Copyright 2023 © Prohomes</p>
          </div>
          <div class="socials">
            <div class="row justify-content-between">
              <div class="col">
                <a class="d-block subtitle"><i class="ti-microphone"></i> (+91) 6238 54 3016</a>
                <a class="d-block subtitle"><i class="ti-email"></i> info@prohomes.in</a>
              </div>
              <div class="col">
                <h6 class="subtitle font-weight-normal mb-1">Social Media</h6>
                <div class="social-links">
                  <a href="javascript:void(0)" class="link pr-1"><i class="ti-facebook"></i></a>
                  <a href="javascript:void(0)" class="link pr-1"><i class="ti-twitter-alt"></i></a>
                  <a href="javascript:void(0)" class="link pr-1"><i class="ti-google"></i></a>
                  <a href="javascript:void(0)" class="link pr-1"><i class="ti-pinterest-alt"></i></a>
                  <a href="javascript:void(0)" class="link pr-1"><i class="ti-instagram"></i></a>
                  <a href="javascript:void(0)" class="link pr-1"><i class="ti-rss"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Modals -->
    <section>
      <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pro Homes</h4>
              <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
              <p>Password Changed</p>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal" id="myModal1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pro Homes</h4>
              <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
              <p>Check Current Password</p>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal" id="Service_Pending">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pro Homes</h4>
              <button type="button" class="close close-modal" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
              <p>
              <h5>Your request has been submitted.</h5><br> You will receive an email notification once you have been
              accepted.</p>

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <?php
      if (isset($_SESSION["pass_status"])) {

        $MSG = $_SESSION["pass_status"];

        if ($MSG) {
          echo '<script>
            $(document).ready(function(){
              $("#myModal").modal("show");
            });
          </script>';
        } else {
          echo '<script>
            $(document).ready(function(){
              $("#myModal1").modal("show");
            });
          </script>';
        }
        unset($_SESSION["pass_status"]);
      }
      if (isset($_SESSION["Requested"])) {
        $MSG = $_SESSION["Requested"];
        if ($MSG == "VALID") {
          echo '<script>
            $(document).ready(function(){
              $("#Service_Pending").modal("show");
            });
          </script>';
        }
        unset($_SESSION["Requested"]);

      }

      ?>

    </section>
    <!-- JavaScript Libraries -->
    <script>
      $(document).ready(function () {
        $('.close-modal').click(function () {
          $('#Service_Pending,#myModal,#myModal1').modal('hide');
        });
      });</script>
    <!-- bootstrap 3 affix -->
    <script src="assets/vendors/bootstrap/bootstrap.affix.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>



  </body>
  <?php
  } else {
    header("location:signin.php");
  }
  ?>

</html>