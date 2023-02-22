<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with Ollie landing page.">
  <meta name="author" content="Devcrud">
  <title>ProHomes - House services</title>
  <link rel="icon" href="assets/imgs/Logo.png" type="image/icon type">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- font icons -->
  <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">

  <!-- owl carousel -->
  <link rel="stylesheet" href="assets/vendors/owl-carousel/css/owl.carousel.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel/css/owl.theme.default.css">

  <!-- Bootstrap + Ollie main styles -->
  <link rel="stylesheet" href="assets/css/ollie.css">



</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

  <nav id="scrollspy" class="navbar navbar-light bg-light navbar-expand-lg fixed-top" data-spy="affix" data-offset-top="20">
    <div class="container">
      <a class="navbar-brand" href="#"><img src="assets/imgs/logo.png" alt="" class="brand-img"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="services.php">Find Service</a>
          </li>
          <li class="nav-item ml-0 ml-lg-4">
            <a class="nav-link btn btn-primary" href="signup.html">Register</a>
          </li>
      </div>
    </div>
  </nav>


  <!-- Section: Design Block -->
  <section class="background overflow-hidden">
    <style>
      .background {
        background-image: url('assets/imgs/login-wallpaper.jpg');
        background-size: cover;
      }

      .bg-glass {
        background-color: hsla(0, 0%, 100%, 0.737) !important;
        backdrop-filter: saturate(200%) blur(25px);
      }
    </style>

    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5 ">
      <div class="row gx-lg-5 align-items-center mb-5">
        <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">

          <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
            &nbsp;
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0 position-relative">


          <div class="card bg-glass py-5  shadow-lg" style="border-radius: 25px;">
            <div class="d-inline " style="height:80px">
              <h1 class="d-inline">Login </h1>
            </div>
            <div><span class="text-danger text-left">
                    <?php
                    session_start();
                    if (isset($_SESSION['Check_login'])) {
                      if ($_SESSION['Check_login'] == "REGISTERED")
                        echo "Successfully registered login here<br>";
                      if ($_SESSION['Check_login'] == "INVALID")
                        echo "Incorrect Username or Password, Try Again<br>";
                      if ($_SESSION['Check_login'] == "ADMIN_INVALID")
                        echo "You need to login<br>";
                      unset($_SESSION['Check_login']);
                    }
                    ?>

                  </span></div>
            <div class="card-body px-4 py-5 px-md-5 ">
              <form action="check.php" method="POST">

                
                <!-- Email input -->
                <div class="form-floating form-outline mb-4">
                  <input type="text" id="uname" name="uname" class="form-control" placeholder=" " />
                  <label class="form-label" for="uname">Username</label>
                </div>

                <!-- Password input -->
                <div class="form-floating form-outline mb-4">
                  <input type="password" id="pass" name="pass" class="form-control" placeholder=" " />
                  <label class="form-label" for="pass">Password</label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">
                  Sign in
                </button>
                <span>Don't have an account?<a href="signup.html"> Register here</a></span>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Design Block -->

  <section class="section bg-overlay">

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




  <!-- core  -->
  <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
  <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>

  <!-- bootstrap 3 affix -->
  <script src="assets/vendors/bootstrap/bootstrap.affix.js"></script>

  <!-- Owl carousel  -->
  <script src="assets/vendors/owl-carousel/js/owl.carousel.js"></script>


  <!-- Ollie js -->
  <script src="assets/js/Ollie.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>