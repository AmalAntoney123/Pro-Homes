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
    if ($row["User_Type"] != "Admin")
        header("location:signin.php");
?>

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

        <style>
            .dropdown-item:hover,
            .dropdown-item:focus {
                background-color: white !important;
            }
        </style>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <link href="https://cdn.datatables.net/v/bs4/dt-1.13.2/b-2.3.4/cr-1.6.1/date-1.3.0/fh-3.3.1/r-2.4.0/sc-2.1.0/sb-1.4.0/sp-2.1.1/sl-1.6.0/sr-1.2.1/datatables.min.css" />

        <script src="https://cdn.datatables.net/v/bs4/dt-1.13.2/b-2.3.4/cr-1.6.1/date-1.3.0/fh-3.3.1/r-2.4.0/sc-2.1.0/sb-1.4.0/sp-2.1.1/sl-1.6.0/sr-1.2.1/datatables.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#tbl_servie_prov').DataTable();
            });
        </script>
        <script>
            //Load table
            $(document).ready(function() {
                // load the initial table data
                load_data();

                function load_data() {
                    $.ajax({
                        url: "fetch_verification_table.php",
                        method: "POST",
                        success: function(data) {
                            $('#tbl_servie_prov').html(data);
                        }
                    });
                }
            });
        </script>
        <script>
            function disableSubmit() {
                document.getElementById("sub").disabled = true;
                $('#signup_loader').show()
                $('.signup_text').hide()
            }
        </script>

    </head>

    <body>
        <div class="container-xxl position-relative bg-white d-flex p-0">
            <!-- Spinner Start -->
            <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
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
                            <img class="rounded-circle" src="uploaded files/Profile Pictures/<?php echo $target; ?>" alt="" style="width: 40px; height: 40px; object-fit:cover;">
                            <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                            </div>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">
                                <?php echo "$fname $lname"; ?>
                            </h6>
                            <span>Admin</span>
                        </div>
                    </div>
                    <div class="navbar-nav w-100">
                        <a href="admin_index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown"><i class="fa fa-briefcase me-2"></i>Services</a>
                            <div class="dropdown-menu bg-transparent border-0 ">
                                <a href="admin_verify_request.php" class="dropdown-item ">Verify Providers</a>
                                <a href="admin_recent_appointment.php" class="dropdown-item">Recent Appoinments</a>
                                <a href="admin_list_provider.php" class="dropdown-item">List Providers</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-user me-2"></i>Users</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="admin_manage_user.php" class="dropdown-item">Manage Users</a>
                                <a href="signup.html" class="dropdown-item">Feedbacks</a>
                                <a href="404.html" class="dropdown-item">Complaints</a>
                            </div>
                        </div>
                        <a href="admin_report.php" class="nav-item nav-link active"><i class="fa fa-folder me-2"></i>Reports</a>

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-file me-2"></i>Pages</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="index.php" class="dropdown-item">Home</a>
                                <a href="signin.php" class="dropdown-item">Signin</a>
                                <a href="signup.html" class="dropdown-item">Signup</a>
                                <a href="services.php" class="dropdown-item">Services</a>
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
                                <img class="rounded-circle me-lg-2" src="uploaded files/Profile Pictures/<?php echo $target; ?>" alt="" style="width: 40px; height: 40px; object-fit:cover;">
                                <span class="d-none d-lg-inline-flex">
                                    <?php echo "$fname $lname"; ?>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                                <a href="user_profile.php" class="dropdown-item">My Profile</a>
                                <a href="user_profile.php#profile-edit" class="dropdown-item">Settings</a>
                                <a href="logout.php" class="dropdown-item">Log Out</a>
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- Navbar End -->


                <!-- Blank Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded  align-items-center justify-content-between p-4">
                        <form action="generate_report.php" method="post">
                            <div class="form-group">
                                <label for="report_type">Select Report Type:</label>
                                <select class="form-control" name="report_type" id="report_type">
                                    <option value="provider_ratings_report">Provider Ratings Report</option>
                                    <option value="service_requests_report">Service Requests Report</option>
                                    <option value="payment_report">Payment Report</option>
                                    <option value="service_provider_profile_report">Service Provider Profile Report</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="service_pro">Select Service Provider</label>
                                <select class="form-control" name="service_pro" id="service_pro">
                                    <?php
                                    $sql = "SELECT u.First_Name, u.Last_Name, u.Username, u.Email, u.Phone_Number, p.Provider_ID
                                                FROM tbl_service_provider p
                                                    JOIN tbl_user u ON p.User_ID = u.User_ID";
                                    $result = mysqli_query($con, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['Provider_ID'] . '">' . $row['First_Name'] . ' ' . $row['Last_Name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="date_range">Select Date Range:</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input required type="date" class="form-control" id="start_date" name="start_date" placeholder="Start Date">
                                    </div>
                                    <div class="col-md-6">
                                        <input required type="date" class="form-control" id="end_date" name="end_date" placeholder="End Date">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Generate Report</button>
                        </form>
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