<?php session_start();
if (isset($_SESSION["l_id"]) and isset($_REQUEST["id"])) {
?>
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

        <link rel="stylesheet" href="assets/css/flatpicker.css" />

        <!-- Bootstrap + Ollie main styles -->
        <link rel="stylesheet" href="assets/css/ollie.css">
        <link rel="stylesheet" href="assets/css/siginin.css">
        <link rel="stylesheet" href="assets/css/scrollbar.css" />
        <link rel="stylesheet" href="assets/css/flatpicker.css" />

        <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
        <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>

        <script src="assets/js/validationprofile.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


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
        $id = $_GET['id'];
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
    sp.Service_ID,
    sp.Verification_status 
    FROM 
    tbl_service_provider sp 
    INNER JOIN tbl_services s ON sp.Service_ID = s.Service_ID 
    INNER JOIN tbl_user u ON sp.User_ID = u.User_ID 
    WHERE sp.Provider_ID = "' . $id . '" ';
        $result = mysqli_query($con, $sql);
        $service_p = mysqli_fetch_assoc($result)
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
                        <div class="col-lg-12 col-12">
                            <div class="ps-md-12 shadow-sm p-5 pb-5 mb-5 my-2 bg-white" style="border-radius:20px;">
                                <div class="container my-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="uploaded files/Profile Pictures/<?php echo $service_p['Profile_Picture']; ?>" alt="Service Provider Photo" class="img-fluid rounded shadow-md">

                                        </div>
                                        <div class="col-md-8">
                                            <h2 class="text-primary mb-2"><?php echo ucfirst($service_p['First_Name']) . ' ';
                                                                            echo ucfirst($service_p['Last_Name']); ?></h2>
                                            <h5 class="text-secondary mb-4"><?php echo $service_p['Service_Name'] ?></h5>
                                            <p><strong class="text-primary">Price per hour:</strong> ₹<?php echo $service_p['Price']; ?></p>
                                            <p><strong class="text-primary">City:</strong> <?php echo $service_p['City']; ?></p>
                                            <span>
                                                <?php echo $service_p['Service_Desc']; ?>
                                            </span>
                                            <hr>
                                            <?php
                                            $lid = $_SESSION["l_id"];
                                            $_SESSION["provider_id"] = $_GET["id"];
                                            $pid = $_GET["id"];

                                            //booked dates
                                            $bookeddates = array();

                                            // Prepare the SQL query to fetch the appointment dates
                                            $sql = "SELECT * FROM `tbl_service_request` where `Provider_ID` =$pid";

                                            // Execute the SQL query
                                            $result = mysqli_query($con, $sql);


                                            while ($dates = mysqli_fetch_array($result)) {
                                                // Split the appointment dates string into an array
                                                array_push($bookeddates, $dates['Appointment_Date']);
                                            }

                                            //address fetching
                                            $query1 = "SELECT * FROM `tbl_address` WHERE `User_ID`='$lid'";
                                            $result4 = mysqli_query($con, $query1);

                                            //unavailable dates fetching
                                            $unavailable_dates = array();
                                            $query = "SELECT * FROM `tbl_service_provider_availability` WHERE `Provider_ID`='$pid'";
                                            $result3 = mysqli_query($con, $query);
                                            $availability = mysqli_fetch_array($result3);

                                            if (isset($availability['Unavailable Dates'])) {
                                                $dates_string = $availability['Unavailable Dates'];
                                                $dates_array = explode(',', $dates_string);
                                                $dates_array = array_merge($dates_array, $bookeddates);
                                                foreach ($dates_array as $date) {
                                                    $unix_timestamp = strtotime($date);
                                                    $formatted_date = date('Y-m-d', $unix_timestamp);
                                                    array_push($unavailable_dates, $formatted_date);
                                                }
                                            }
                                            $min_time = $availability['Workday_Start']; // set the minimum time
                                            $max_time = $availability['Workday_End']; // set the maximum time
                                            ?>
                                            <form action="book_now_submit.php" method="POST">
                                                <div class="form-group">
                                                    <label for="address">Select Address</label>
                                                    <select class="form-control" id="address" name="address">
                                                        <?php

                                                        $count = 1;
                                                        if (mysqli_num_rows($result4) == 0) {
                                                            echo "<option disabled>No Saved Address</option>";
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
                                                    <button type="button" onclick="location.href='add_address_book.php'" class="btn btn-secondary mt-3">Add New Address</button>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Work Description</label>
                                                    <textarea class="form-control" id="description" style="resize:none;" name="description" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="date-picker">Appoinment Date</label>
                                                    <input type="text" class="form-control" id="date-picker" placeholder="Select dates" name="appoinmentdate" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="time-picker">Select a time:</label>
                                                    <input type="text" placeholder="Select start time" id="time-picker" class="flatpickr form-control" name="time_start" required>
                                                </div>
                                                <input type="hidden" name="service_id" id="service_id" value="<?php echo $service_p['Service_ID'] ?>">
                                                <button type="submit" class="btn btn-primary">Book Now</button>
                                            </form>
                                            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

                                            <script>
                                                let tomorrow = new Date();
                                                tomorrow.setDate(tomorrow.getDate() + 1);
                                                var unavailableDates = <?php echo json_encode($unavailable_dates); ?>.map(dateString => new Date(dateString));
                                                var sundayAvailable = "<?php echo $availability['Sunday_Unvailable'] ?>";
                                                console.log(unavailableDates);
                                                flatpickr("#date-picker", {
                                                    dateFormat: "Y-m-d",
                                                    minDate: tomorrow,
                                                    disable: [
                                                        // Disable unavailable dates
                                                        function(date) {
                                                            for (var i = 0; i < unavailableDates.length; i++) {
                                                                if (date.getFullYear() === unavailableDates[i].getFullYear() &&
                                                                    date.getMonth() === unavailableDates[i].getMonth() &&
                                                                    date.getDate() === unavailableDates[i].getDate()) {
                                                                    return true;
                                                                }
                                                            }
                                                        },
                                                        // Disable Sundays if Sunday availability is set to "No"
                                                        function(date) {
                                                            if (date.getDay() === 0 && sundayAvailable === 'Yes') {
                                                                return true;
                                                            }
                                                        }
                                                    ]
                                                });

                                                flatpickr("#time-picker", {
                                                    enableTime: true,
                                                    noCalendar: true,
                                                    dateFormat: "H:i",
                                                    time_24hr: true,
                                                    minuteIncrement: 30,
                                                    minTime: "<?php echo $min_time ?>",
                                                    maxTime: "<?php echo $max_time ?>"
                                                });
                                            </script>
                                        </div>
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
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
            <!-- Datepicker JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
            <script type="text/javascript">
                $(function() {
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
        if (!isset($_SESSION["l_id"])) {
            $_SESSION['Check_login'] = "BOOK";
            header("location:signin.php");
        }
        if (!isset($_REQUEST["id"])) {
            header("location:services.php");
        }
    }
?>

    </html>