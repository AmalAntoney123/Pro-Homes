<!DOCTYPE html>
<html lang="en">

<head>
  <title>ProHomes - House services</title>
  <link rel="icon" href="assets/imgs/Logo.png" type="image/icon type">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- font icons -->
  <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">

  <!-- owl carousel -->
  <link rel="stylesheet" href="assets/vendors/owl-carousel/css/owl.carousel.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel/css/owl.theme.default.css">

  <!-- Bootstrap + Ollie main styles -->
  <link rel="stylesheet" href="assets/css/ollie.css">
  <link rel="stylesheet" href="assets/css/siginin.css">

  <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
  <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>
  <script src="assets/js/validation.js"></script>


</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home" style="background-color: #f1fafb;">

  <nav id="scrollspy" class="navbar navbar-light bg-light navbar-expand-lg " data-spy="affix"
    data-offset-top="20">
    <div class="container">
      <a class="navbar-brand" href="#"><img src="assets/imgs/logo.png" alt="" class="brand-img"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
            <a class="nav-link btn btn-primary" href="signin.php">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <!-- Section: Design Block -->
  <section class="">
    <!-- Background image -->
    <div class="p-5 bg-image" style="
          background-image: url('assets/imgs/bolts-nuts.jpg');
          height: 300px; background-size: cover;
          "></div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 rounded-7  shadow-lg" style="
          margin-top: -100px;
          background: hsla(0, 0%, 100%, 0.658);
          backdrop-filter: blur(10px);border-radius: 20px;
          ">
      <div class="card-body py-5 px-md-5 rounded-7 text-left ">

        <div class="row d-flex justify-content-center">
          <div class="col-lg-8 col-md-8 col-12 ">
            <h2 class="fw-bold mb-5 text-center">SIGN UP NOW</h2>
            <form action="register.php" method="POST" enctype="multipart/form-data">
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row">
                <div class="col-lg-6 mb-4 col-12">
                  <div class="form-floating form-outline ">
                    <input type="text" name="fname" autofocus id="fname" class="form-control" placeholder=" " />
                    <label class="form-label" for="fname">First name</label>
                    <span class="error text-left" id="error1"> * Name should contain letters
                      only</span>
                  </div>
                </div>
                <div class="col-lg-6 mb-4 col-12">
                  <div class="form-floating form-outline">
                    <input type="text" name="lname" id="lname" class="form-control" placeholder=" " />
                    <label class="form-label" for="lname">Last name</label>
                    <span class="error text-left" id="error2"> * Name should contain letters
                      only</span>
                  </div>
                </div>
              </div>

              <div class="form-floating form-floating mb-3">
                <input type="text" name="uname" class="form-control" id="uname" placeholder=" ">
                <span class="erroruname" id="erroruname"></span>
                <label for="uname">User Name</label>
                <span class="error" id="error3"> * Username can contain only letters, digits and
                  underscore</span>

              </div>
              <div class="form-floating form-floating mb-3">
                <input type="number" name="phone" class="form-control" id="phone" placeholder=" ">
                <label for="phone">Phone Number</label>
                <span class="error" id="error10"> * Invalid phone number</span>
              </div>

              <!-- Email input -->
              <div class="form-floating form-outline mb-4">
                <input type="email" name="email" id="email" class="form-control" placeholder=" " />
                <span class="erroremail" id="erroremail"></span>
                <label class="form-label" for="mail">Email address</label>
                <span class="error" id="error4"> * Invalid email </span>
              </div>


              <!-- Password input -->
              <div class="row">
                <div class="col-lg-6 mb-4 col-12">
                  <div class="form-floating form-outline">
                    <input type="password" name="pass" id="pass" class="form-control" placeholder=" " />
                    <label class="form-label" for="pass">Password</label>
                    <span id="error6" class="error"> * Password needs uppercase, special &
                      numbers.</span>
                  </div>
                </div>
                <div class="col-lg-6 mb-4 col-12">
                  <div class="form-floating form-outline">
                    <input type="password" id="cpass" class="form-control" placeholder=" " />
                    <label class="form-label" for="cpass">Confirm Password</label>
                    <span id="error7" class="error"> * Password doesnot match</span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6 mb-4 col-12">
                  <div class="form-floating form-outline">
                    <input accept="image/jpeg,image/png" onchange="validateFileType()" type="file" id="file"
                      name="p_pic" value="Profile Picture" class="form-control" placeholder=" " />
                    <label class="form-label" for="pin">Profile Picture</label>
                    <span id="error8">&nbsp; </span>
                  </div>
                </div>

                <div class="col-lg-6 mb-4 col-12">
                  <div class="form-floating form-outline">
                    <select type="text" name="city" id="city" class="form-control" placeholder=" ">
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
                Sign up
              </button>

              </ul>
              <div class="text-center">
                <span class="text-center">Already have an account?<a href="signin.php"> Sign-in
                    here</a></span>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- Section: Design Block -->

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




  <!-- JavaScript Libraries -->

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

</html>