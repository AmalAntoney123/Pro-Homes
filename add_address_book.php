<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ProHomes - House services</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="assets/imgs/Logo.png" type="image/icon type">

    <!-- font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">


    <!-- Bootstrap + Ollie main styles -->
    <link rel="stylesheet" href="assets/css/ollie.css">
    <link rel="stylesheet" href="assets/css/siginin.css">
    <link rel="stylesheet" href="assets/css/scrollbar.css" />

    <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/validationaddress.js"></script>


    <script>
        $(document).ready(function() {
            $("#address-form").validate({
                rules: {
                    pincode: {
                        required: true,
                        digits: true,
                        minlength: 6,
                        maxlength: 6,
                        pattern: /^[1-9][0-9]{5}$/
                    }
                },
                messages: {
                    pincode: {
                        required: "Please enter a valid Pin Code",
                        digits: "Please enter only numbers",
                        minlength: "Pin Code must be 6 digits",
                        maxlength: "Pin Code must be 6 digits",
                        pattern: "Please enter a valid Pin Code"
                    }
                }
            });
        });
    </script>

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
            $role = $row["User_Type"];
        } else {
            $target = "default.webp";
        }
    }
    ?>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home" class="bg-light">

    <nav id="scrollspy" class="navbar navbar-black bg-light navbar-expand-lg ">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="assets/imgs/logo.png" alt="" class="brand-img"></a>
            <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon navbar-light"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link mt-2" href="services.php">Find Service</a>
                    </li>
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
                                <img class="rounded-circle ml-2 me-lg-2" src="uploaded files/Profile Pictures/<?php echo $target; ?>" alt="" style="width: 40px; height: 40px; object-fit:cover;">

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
                    <div class="col-lg-12 col-12 ">
                        <div class="ps-md-4 shadow-sm mx-2 p-5 my-2 bg-white" style="border-radius:20px;">
                            <div class="">
                                <div class=" pt-3">
                                    <div class="mb-3 mt-2">
                                        <h2 class="pb-5">Add Address</h2>
                                        <form id="address-form" action="add_address.php" method="POST">
                                            <div class="row mb-3">
                                                <label for="house" class="col-md-4 col-lg-3 col-form-label">House/Flat
                                                    No:</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="house" type="text" class="form-control" id="house" required>
                                                    <div id="house-error" class="invalid-feedback"></div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="street" class="col-md-4 col-lg-3 col-form-label">Street</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="street" type="text" class="form-control" id="street" required>
                                                    <div id="street-error" class="invalid-feedback"></div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="city" class="col-md-4 col-lg-3 col-form-label">City</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <select name="city" class="form-control" id="city" required>
                                                        <option value="kottayam">Kottayam</option>
                                                        <option value="kochi">Kochi</option>
                                                        <option value="trivandrum">Trivandrum</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="state" class="col-md-4 col-lg-3 col-form-label">State</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="state" type="text" class="form-control" id="state" required>
                                                    <div id="state-error" class="invalid-feedback"></div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="locality" class="col-md-4 col-lg-3 col-form-label">Locality</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="locality" type="text" class="form-control" id="locality" required>
                                                    <div id="locality-error" class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="landmark" class="col-md-4 col-lg-3 col-form-label">Landmark</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="landmark" type="text" class="form-control" id="landmark" required>
                                                    <div id="landmark-error" class="invalid-feedback"></div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="pincode" class="col-md-4 col-lg-3 col-form-label">Pin
                                                    Code</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="pincode" type="number" class="form-control" id="pincode" required>
                                                    <div id="pincode-error" class="invalid-feedback"></div>
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <button id="sub_address" type="submit" class="btn btn-primary">Add New Address</button>
                                            </div>
                                        </form>
                                    </div><!-- End Add New Address Form -->


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