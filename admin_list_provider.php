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
        <link
            href="https://cdn.datatables.net/v/bs4/dt-1.13.2/b-2.3.4/cr-1.6.1/date-1.3.0/fh-3.3.1/r-2.4.0/sc-2.1.0/sb-1.4.0/sp-2.1.1/sl-1.6.0/sr-1.2.1/datatables.min.css" />

        <script
            src="https://cdn.datatables.net/v/bs4/dt-1.13.2/b-2.3.4/cr-1.6.1/date-1.3.0/fh-3.3.1/r-2.4.0/sc-2.1.0/sb-1.4.0/sp-2.1.1/sl-1.6.0/sr-1.2.1/datatables.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#tbl_user_mgt').DataTable();
            });
            $(document).ready(function () {
                $('.toggle-switch').on('change', function () {
                    var userId = $(this).data('userid');
                    var isEnabled = $(this).prop('checked');
                    $.ajax({
                        type: 'POST',
                        url: 'update-status.php',
                        data: {
                            id: userId,
                            enabled: isEnabled ? 1 : 0 // convert boolean to integer
                        },
                        success: function (response) {
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            // handle error response
                        }
                    });
                });
            });
        </script>
        <script>
                            //Load table
                            // $(document).ready(function () {
                            //     // load the initial table data
                            //     load_data();
                            //     function load_data() {
                            //         $.ajax({
                            //             url: "fetch_user_table.php",
                            //             method: "POST",
                            //             success: function (data) {
                            //                 $('#tbl_user_mgt').html(data);
                            //             }
                            //         });
                            //     }
                            // });

        </script>

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
                                style="width: 40px; height: 40px;">
                            <div
                                class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
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
                        <a href="admin_index.php" class="nav-item nav-link"><i
                                class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                    class="fa fa-briefcase me-2"></i>Services</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="admin_verify_request.php" class="dropdown-item">Verify Providers</a>
                                <a href="typography.html" class="dropdown-item">Recent Appoinments</a>
                                <a href="admin_list_provider.php" class="dropdown-item">List Providers</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i
                                    class="fa fa-user me-2"></i>Users</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="admin_manage_user.php" class="dropdown-item active">Manage Users</a>
                                <a href="signup.html" class="dropdown-item">Feedbacks</a>
                                <a href="404.html" class="dropdown-item">Complaints</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                                    class="fa fa-file me-2"></i>Pages</a>
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
                                    style="width: 40px; height: 40px;">
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
                    <div class="row  rounded align-items-center justify-content-center mx-0">
                        <div class="bg-light rounded h-100 p-4">

                            <h6 class="mb-4">Service Provider Management</h6>
                            <table class="table table-striped table-hover" id="tbl_user_mgt">
                                <?php
                                // connect to database
                                include("connection.php");


                                // fetch data from database
                                $sql = "SELECT * FROM `tbl_user` WHERE `User_Type` LIKE 'provider'";
                                $result = mysqli_query($con, $sql);


                                // generate table rows from data
                                $output = '';
                                if (mysqli_num_rows($result) > 0) {
                                    $output = '<thead>';
                                    $output .= '<tr>';
                                    $output .= '<th>#</th>';
                                    $output .= '<th>Name</th>';
                                    $output .= '<th>Username</th>';
                                    $output .= '<th>Email </th>';
                                    $output .= '<th>Phone_Number</th>';
                                    $output .= '<th>City</th>';
                                    $output .= '<th>User Type</th>';
                                    $output .= '<th>Disable</th>';
                                    $output .= '</tr>';
                                    $output .= '</thead>';
                                    $count = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $output .= '<tr>';
                                        $output .= '<td>' . $count . '</td>';
                                        $output .= '<td>' . $row['First_Name'] . ' ' . $row['Last_Name'] . '</td>';
                                        $output .= '<td>' . $row['Username'] . '</td>';
                                        $output .= '<td>' . $row['Email'] . '</td>';
                                        $output .= '<td>' . $row['Phone_Number'] . '</td>';
                                        $output .= '<td>' . $row['City'] . '</td>';
                                        $output .= '<td>' . $row['User_Type'] . '</td>';
                                        $output .= '<td align="center">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input btn-primary toggle-switch"';
                                        if($row['User_Status']=='disabled'){
                                            $output .='checked';
                                        }
                                        $output .= ' type="checkbox" role="switch" id="toggle-switch-1" data-userid="' . $row['User_ID'] . '">
                                                        </div>
                                                    </td>';
                                        $output .= '</tr>';
                                        $count++;
                                    }
                                } else {
                                    $output .= '<tr><td colspan="9">No Pending Request</td></tr>';
                                }

                                // send table rows back to Ajax
                                echo $output;
                                ?>
                            </table>
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