<?php session_start();
?>
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
    <style>
        textarea {
            resize: none;
        }

        .form-floating {
            height: calc(4.5rem + 15px);
            position: relative;
        }
    </style>

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home" style="background-color: #f1fafb;">


    <!-- Section: Design Block -->
    <section class=" gradient-custom">
        <div class="container py-5 mt-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Verify Email</h3>
                            <form action="verify_email_pass.php" method="POST">
                                <div class="form-floating form-outline mb-4">
                                    <input type="email" name="mail" id="mail" class="form-control" placeholder=" " />
                                    <span class="erroremail" id="erroremail"></span>
                                    <label class="form-label" for="mail">Enter your Email</label>
                                    <?php if (isset($_SESSION["Check_login"])) {
                                        if ($_SESSION["Check_login"] == "INVALID_EMAIL") {
                                            ?>

                                            <span class="text-danger">Account doesnt exist on this Email</span>
                                            <?php
                                        }
                                    }unset($_SESSION["Check_login"])
                                    ?>
                                </div>
                                <button type="submit" id="sub" class="btn btn-primary btn-block mb-4" width="">
                                    Send Verification Email
                                </button>
                                <a href="resendmail.php">Resend verification mail</a>
                            </form>
                        </div>
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
<?php
?>