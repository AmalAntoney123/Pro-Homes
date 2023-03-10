<?php session_start(); 
if (isset($_SESSION["l_id"])) {
?>
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
    <link rel="stylesheet" href="assets/css/scrollbar.css" />

    <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>

    <script src="assets/js/validationprofile.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <style>
        .datepicker-dropdown {
            top: 38px;
            border: none;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.175);
        }

        .datepicker td,
        .datepicker th {
            width: 3rem;
            height: 3rem;
            font-size: 1.2rem;
            text-align: center;
        }

        .datepicker td span {
            width: 2.5rem;
            height: 2.5rem;
            line-height: 2.5rem;
            display: inline-block;
            border-radius: 50%;
        }

        .datepicker td.active,
        .datepicker td.active:hover,
        .datepicker td.active.disabled,
        .datepicker td.active.disabled:hover {
            background-color: #007bff;
        }

        .datepicker td.disabled,
        .datepicker td.disabled:hover {
            color: #999999;
            background-color: #f5f5f5;
            cursor: not-allowed;
        }

        .datepicker td.weekend {
            color: #999999;
        }

        /* Change color of active date */
        .datepicker td.active>a,
        .datepicker td.active>a:hover,
        .datepicker td.active>a:focus {
            background-color: #f06161;
            border-radius: 50%;
        }

        /* Change color of disabled date */
        .datepicker td.disabled,
        .datepicker td.disabled>span,
        .datepicker td.disabled>a {
            color: #ccc;
            background-color: #fff;
            cursor: not-allowed;
        }
    </style>

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
            
        } else {
            $target = "default.webp";
        }
    }
    $id=$_GET['id'];
    $sql = 'SELECT 
    sp.Provider_ID,
    u.User_ID, 
    u.First_Name, 
    u.Last_Name, 
    u.City, 
    u.Profile_Picture,
    s.Service_Name, 
    sp.Service_Desc, 
    sp.Qualification_File, 
    sp.Insurance_File, 
    sp.Certificate_File, 
    sp.Price, 
    sp.Verification_status 
    FROM 
    tbl_service_provider sp 
    INNER JOIN tbl_services s ON sp.Service_ID = s.Service_ID 
    INNER JOIN tbl_user u ON sp.User_ID = u.User_ID 
    WHERE sp.Provider_ID = "'.$id.'" ';
    $result = mysqli_query($con, $sql);
    $service_p = mysqli_fetch_assoc($result)
    ?>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home" class="bg-light">

    <nav id="scrollspy" class="navbar navbar-black bg-light navbar-expand-lg ">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="assets/imgs/logo.png" alt="" class="brand-img"></a>
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
                                <img class="rounded-circle ml-2 me-lg-2"
                                    src="uploaded files/Profile Pictures/<?php echo $target; ?>" alt=""
                                    style="width: 40px; height: 40px; object-fit:cover;">

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
                    <div class="col-lg-12 col-12">
                        <div class="ps-md-12 shadow-sm pt-5 pb-5 mb-5 my-2 bg-white" style="border-radius:20px;">
                            <div class="d-flex flex-column ">
                                <div class="row px-5">
                                    <div class="col-lg-4">
                                        <img class="photo" src="uploaded files/Profile Pictures/<?php echo $service_p['Profile_Picture']; ?>"
                                            alt="" style="width: 100%; height: 200px;object-fit: cover;border-radius:10px;"
                                            class="img-fluid ">
                                        <p class="fw-bold h4 mt-3 text-center">
                                            <?php echo ucfirst($service_p['First_Name']).' '; echo ucfirst($service_p['Last_Name']); ?>
                                        </p>
                                    </div>
                                    <div class="col-lg-8  border-left">
                                        <div class="container ml-3">
                                            <h1 class="text-primary"><?php echo $service_p['Service_Name']?></h1>
                                            <span>
                                            <?php echo $service_p['Service_Desc']; ?>
                                            </span>
                                            <h3 class="text-info">Price: ₹<?php echo $service_p['Price']; ?> /hr</h3>
                                            <h4 class="">City: <?php echo $service_p['City']; ?></h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="d-flex flex-column ">
                                <div clas="row px-5">
                                    <div class="container-fluid px-5 my-5">
                                        <form class="mx-auto" action="#" method="POST">
                                            <div class="form-group">
                                                <label for="date">Select your Address:</label>
                                                <select class="form-control">
                                                    <?php
                                                    $lid = $_SESSION["l_id"];
                                                    $_SESSION["provider_id"] = $_GET["id"];
                                                    $query = "SELECT * FROM `tbl_address` WHERE `User_ID`='$lid'";
                                                    $result4 = mysqli_query($con, $query);
                                                    $count = 1;
                                                    if (mysqli_num_rows($result4) == 0) {
                                                        echo "<span>No Saved Address</span>";
                                                    }
                                                    while ($address = mysqli_fetch_array($result4)) {

                                                        ?>
                                                        <option value="<?php echo $address['Address_ID'] ?>">
                                                            <?php echo $address['House'] ?>,
                                                            <?php echo $address['Street'] ?>,
                                                            <?php echo $address['City'] ?>,
                                                            <?php echo $address['Locality'] ?>,
                                                            <?php echo $address['State'] ?>, Near:
                                                            <?php echo $address['Landmark'] ?>,
                                                            <?php echo $address['Pincode'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <button type="button" onclick="location.href='add_address_book.php'"
                                                class="btn btn-secondary">Add New Address</button>
                                            <div class="form-group mt-2">
                                                <label for="date">Select a date:</label>
                                                <input type="text" class="form-control" id="date" name="date" required>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="time">Select a time:</label>
                                                <select class="form-control" name="appointment_time" id="time">
                                                    <?php
                                                    $start_time = strtotime('9:00 AM');
                                                    $end_time = strtotime('5:00 PM');
                                                    $interval = 120; // in minutes
                                                
                                                    for ($time = $start_time; $time <= $end_time; $time += $interval * 60) {
                                                        echo '<option value="' . date('H:i', $time) . '">' . date('h:i A', $time) . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="description">Description of Work:</label>
                                                <textarea class="form-control" name="description" id="description" style="resize:none;"></textarea>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
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
                            <h5>Your request has been submitted.</h5><br> You will receive an email notification once you
                            have been
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
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <!-- Datepicker JS -->
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript">
            $(function () {
                $('#date').datepicker({
                    format: 'yyyy-mm-dd',
                    startDate: new Date(),
                    daysOfWeekDisabled: [0, 7], // disable Sundays and Saturdays
                    datesDisabled: [<?php
                    // Disable specific dates
                    $unavailableDates = ['2023-03-16', '2023-03-17', '2023-03-19'];
                    foreach ($unavailableDates as $date) {
                        echo "'$date',";
                    }
                    ?>]
                });
            });
        </script>
        <!-- Template Javascript -->
        <script src="js/main.js"></script>



    </body>
    <?php
    } else {
        header("location:signin.php");
    }
    } else {
        $_SESSION['Check_login'] = "BOOK";
        header("location:signin.php");
    }
    ?>

</html>