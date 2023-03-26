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
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: start;
            font-size: 10px;
        }

        .rating>input {
            display: none;
        }

        .rating>label {
            position: relative;
            width: 1em;
            font-size: 3vw;
            color: #FFD600;
            cursor: pointer;
        }

        .rating>label::before {
            content: "\2605";
            position: absolute;
            opacity: 0;
        }

        .rating>label:hover:before,
        .rating>label:hover~label:before {
            opacity: 1 !important;
        }

        .rating>input:checked~label:before {
            opacity: 1;
        }

        .rating:hover>input:checked~label:before {
            opacity: 0.4;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#star-rating').rating();
        });
    </script>

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

    <?php
    if (isset($_SESSION["l_id"])) {
        if (!isset($_GET["token"])) {
            header('Location:signin.php');
        } else {
            $paymentid = base64_decode(urldecode($_GET['token']));
            $query3 = "SELECT p.Payment_ID, u.User_ID, p.Request_ID, p.Provider_ID, sp.Service_ID, p.Gateway_Order_ID, p.Amount, 
                            p.Payment_Status, p.Payment_Request_Date, p.Payment_Date, sp.Address, sp.Service_Desc, sp.Qualification_File, 
                            sp.Insurance_File, sp.Certificate_File, sp.Price, sp.Verification_status, u.First_Name, u.Last_Name, u.Username, 
                            u.Email, u.Password, u.Phone_Number, u.Profile_Picture, u.City, u.User_Type, u.Last_Log_Date, u.Register_Date, 
                            u.Verification_status, u.User_Status, sr.Service_Description, sr.Appointment_Date, sr.Appoinment_Start_Time, 
                            sr.Appoinment_End_Time, sr.Status
                        FROM tbl_payment p 
                        JOIN tbl_service_provider sp ON p.Provider_ID = sp.Provider_ID 
                        JOIN tbl_user u ON sp.User_ID = u.User_ID 
                        JOIN tbl_service_request sr ON p.Request_ID = sr.Request_ID 
                            WHERE p.Gateway_Order_ID ='$paymentid';";
            $result3 = mysqli_query($con, $query3);
            $service = mysqli_fetch_array($result3);
    ?>
            <section>
                <div class="container mb-5">
                    <h2 class="my-4">Leave a Review</h2>
                    <div class="card p-3 rounded bg-light   ">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Payment Successful!</h5>
                                <p>Your review will be helpful to other customers who are considering using this service. Please provide your honest feedback so that others can make informed decisions.</p>
                                <form method="POST" action="user_review.php">
                                    <div class="form-group">
                                        <label for="rating">Rating:</label>
                                        <div class="form-group">
                                            <div class="rating">

                                                <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                                                <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                                                <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                                                <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                                                <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="review">Review:</label>
                                            <textarea class="form-control" rows="5" id="review" name="review"></textarea>
                                        </div>
                                        <input type="hidden" name="provider_id" id="provider_id" value="<?=$service['Provider_ID']?>"/>
                                        <button type="submit" class="btn btn-primary">Submit Review</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <h4>Service Details</h4>
                                <img src="uploaded files/Profile Pictures/<?= $service['Profile_Picture'] ?>" style="width: 100%; height: 300px; object-fit: contain;" class="img-fluid mb-3" alt="Service Image">
                                <p><b>Provider Name:</b> <?= ucfirst($service['First_Name']) ?> <?= ucfirst($service['Last_Name']) ?></p>
                                <p><b>Service Description:</b> <?= $service['Service_Description'] ?></p>
                                <p><b>Price:</b> ₹<?= $service['Amount'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </section>

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
<?php
    } else {
        header("location:signin.php");
    }
?>

</html>