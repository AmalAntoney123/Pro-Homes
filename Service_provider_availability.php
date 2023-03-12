<?php session_start(); ?>
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
    if ($row["User_Type"] != "provider")
        header("location:signin.php");
    ?>
    <style>
        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: white !important;
        }
    </style>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>PRO HOMES House Services</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/scrollbar.css" />
        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/ollie.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" href="assets/css/flatpicker.css" />

    </head>

    <body>
        <div class="container-xxl position-relative bg-white d-flex p-0">
            <!-- Spinner Start -->
            <div id="spinner"
                class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <!-- Spinner End -->


            <!-- Sidebar Start -->
            <div class="sidebar pe-4 pb-3">
                <nav class="navbar bg-light navbar-light">
                    <a href="index.php" class="navbar-brand mx-4 mb-3">
                        <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>PRO HOMES</h3>
                    </a>
                    <div class="d-flex align-items-center ms-4 mb-4">
                        <div class="position-relative">
                            <img class="rounded-circle" src="uploaded files/Profile Pictures/<?php echo $target; ?>" alt=""
                                style="width: 40px; height: 40px; object-fit:cover;">
                            <div
                                class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                            </div>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">
                                <?php echo "$fname $lname"; ?>
                            </h6>
                            <span>Service Provider</span>
                        </div>
                    </div>
                    <div class="navbar-nav w-100">
                        <a href="service_provider_index.php" class="nav-item nav-link"><i
                                class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle  active" data-bs-toggle="dropdown"><i
                                    class="fa fa-briefcase me-2"></i>Services</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="sp_manage_appoinmnt.php" class="dropdown-item">Manage Appoinments</a>
                                <a href="typography.html" class="dropdown-item">Recent Appoinments</a>
                                <a href="Service_provider_availability.php" class="dropdown-item active">Set
                                    Availability</a>
                            </div>
                        </div>

                    </div>
                </nav>
            </div>
            <!-- Sidebar End -->


            <!-- Content Start -->
            <div class="content">
                <!-- Navbar Start -->
                <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                        <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                    </a>
                    <a href="#" class="sidebar-toggler flex-shrink-0">
                        <i class="fa fa-bars"></i>
                    </a>

                    <div class="navbar-nav align-items-center ms-auto">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fa fa-envelope me-lg-2"></i>
                                <span class="d-none d-lg-inline-flex">Message</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                                <a href="#" class="dropdown-item">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle" src="img/user.jpg" alt=""
                                            style="width: 40px; height: 40px;">
                                        <div class="ms-2">
                                            <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                            <small>15 minutes ago</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle" src="img/user.jpg" alt=""
                                            style="width: 40px; height: 40px;">
                                        <div class="ms-2">
                                            <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                            <small>15 minutes ago</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle" src="img/user.jpg" alt=""
                                            style="width: 40px; height: 40px;">
                                        <div class="ms-2">
                                            <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                            <small>15 minutes ago</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item text-center">See all message</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fa fa-bell me-lg-2"></i>
                                <span class="d-none d-lg-inline-flex">Notification</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                                <a href="#" class="dropdown-item">
                                    <h6 class="fw-normal mb-0">Profile updated</h6>
                                    <small>15 minutes ago</small>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <h6 class="fw-normal mb-0">New user added</h6>
                                    <small>15 minutes ago</small>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <h6 class="fw-normal mb-0">Password changed</h6>
                                    <small>15 minutes ago</small>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item text-center">See all notifications</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <img class="rounded-circle me-lg-2"
                                    src="uploaded files/Profile Pictures/<?php echo $target; ?>" alt=""
                                    style="width: 40px; height: 40px; object-fit:cover;">
                                <span class="d-none d-lg-inline-flex">
                                    <?php echo "$fname $lname"; ?>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                                <a href="user_profile.php" class="dropdown-item">My Profile</a>
                                <a href="user_profile.php" class="dropdown-item">Settings</a>
                                <a href="logout.php" class="dropdown-item">Log Out</a>
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- Navbar End -->

                <?php
                $query = "SELECT Provider_ID FROM `tbl_service_provider` WHERE `User_ID`=$lid";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_array($result);
                $provider_id = $row["Provider_ID"];


                $unavailable_dates = array();
                $query = "SELECT * FROM `tbl_service_provider_availability` WHERE `Provider_ID`='$provider_id'";
                $result3 = mysqli_query($con, $query);
                $availability = mysqli_fetch_array($result3);

                if (isset($availability['Unavailable Dates'])) {
                    $dates_string = $availability['Unavailable Dates'];
                    $dates_array = explode(',', $dates_string);
                    foreach ($dates_array as $date) {
                        $unix_timestamp = strtotime($date);
                        $formatted_date = date('Y-m-d', $unix_timestamp);
                        array_push($unavailable_dates, $formatted_date);
                    }
                }
                ?>
                <!-- Blank Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <h1>Availability</h1>
                        <div class="container p-4">
                            <form action="sp_availability_change.php" method="POST">
                                <div class="form-group">
                                    <label for="date-picker">Pick Unavailable Dates</label>
                                    <input type="text" class="form-control" id="date-picker" placeholder="Select dates"
                                        name="unavailabledates" multiple>
                                </div>
                                <div class="form-group form-check ml-1">
                                    <input type="checkbox" class="form-check-input" id="sundays" name="sunday" <?php if ($availability['Sunday_Unvailable'] == 'Yes')
                                        echo 'checked'; ?> />
                                    <label class="form-check-label" for="sundays">
                                        Unavailable on Sundays
                                    </label>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label for="start-time">Work day start:</label>
                                            <input type="text" id="start-time" class="flatpickr form-control" required
                                                placeholder="Select start time" name="startday">
                                        </div>
                                        <div class="col-12 col-md-6">

                                            <label for="end-time">Work day end:</label>
                                            <input type="text" id="end-time" class="flatpickr form-control" required
                                                placeholder="Select end time" name="endday">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" name="submit_available">Apply</button>
                            </form>

                            <!-- Include Flatpickr JS -->
                            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

                            <script>
                                // Initialize Flatpickr
                                var unavailableDates = <?php echo json_encode($unavailable_dates); ?>;
                                var sundayAvailable = "<?php echo $availability['Sunday_Unvailable'] ?>";
                                flatpickr("#date-picker", {
                                    mode: "multiple",
                                    dateFormat: "Y-m-d",
                                    minDate: "today",
                                    defaultDate: unavailableDates,
                                    disable: [
                                        function (date) {
                                            // Check if it's a Sunday
                                            if (date.getDay() === 0) {
                                                // Check if Sunday is unavailable
                                                if (sundayAvailable === 'Yes') {
                                                    return true; // Disable Sunday
                                                }
                                            }
                                        }
                                    ]
                                });

                                flatpickr("#start-time", {
                                    enableTime: true,
                                    noCalendar: true,
                                    dateFormat: "H:i",
                                    time_24hr: true,
                                    minuteIncrement: 30,
                                    defaultDate: "<?php echo $availability['Workday_Start'] ?>",
                                    onClose: function (selectedDates, dateStr, instance) {
                                        // Set the minimum time for the end time input to the selected start time
                                        if (selectedDates.length > 0) {
                                            var minTime = new Date(selectedDates[0].getTime() + 30 * 60000);
                                            // Create a new instance of the end-time picker with updated options
                                            flatpickr("#end-time", {
                                                enableTime: true,
                                                noCalendar: true,
                                                dateFormat: "H:i",
                                                time_24hr: true,
                                                minuteIncrement: 30,
                                                defaultDate: "<?php echo $availability['Workday_End'] ?>",
                                                minTime: minTime,
                                            });
                                        }
                                    }
                                });

                                flatpickr("#end-time", {
                                    minTime: "<?php echo $availability['Workday_Start'] ?>",
                                    enableTime: true,
                                    noCalendar: true,
                                    dateFormat: "H:i",
                                    time_24hr: true,
                                    minuteIncrement: 30,
                                    defaultDate: "<?php echo $availability['Workday_End'] ?>"
                                });
                            </script>

                        </div>
                    </div>

                </div>
                <!-- Blank End -->


                <!-- Footer Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <div class="row">
                            <div class="col-12 col-sm-6 text-center text-sm-start">
                                &copy; <a href="#">Pro Homes House Services</a>
                            </div>
                            <div class="col-12 col-sm-6 text-center text-sm-end">
                                <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                                All Right Reserved. </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer End -->
            </div>
            <!-- Content End -->


            <!-- Back to Top -->
            <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
        </div>

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
    </body>

    </html>

    <?php
} else {
    header("location:signin.php");
}

?>