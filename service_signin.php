<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
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
    <link rel="stylesheet" href="assets/css/siginin.css">
    <link rel="stylesheet" href="assets/css/scrollbar.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="assets/css/flatpicker.css" />

    <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>
    <script src="assets/js/validationservice.js">


    </script>

    <style>
        textarea {
            resize: none;
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

        $lid = $_SESSION["l_id"];
        $query = "SELECT * FROM `tbl_services`";
        $result = mysqli_query($con, $query);
    }

    ?>

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home" style="background-color: #f1fafb;">

    <nav id="scrollspy" class="navbar navbar-light bg-light navbar-expand-lg fixed-top" data-spy="affix" data-offset-top="20">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="assets/imgs/logo.png" alt="" class="brand-img"></a>
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

                </ul>
            </div>
        </div>
    </nav>


    <!-- Section: Design Block -->
    <section class=" gradient-custom">
        <div class="container py-5 mt-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Service Provider Details</h3>
                            <form action="service_register.php" method="POST" enctype="multipart/form-data">
                                <div class="form-floating form-floating">
                                    <textarea type="text" required name="address" class="form-control" id="address" placeholder=" "></textarea>
                                    <span class="erroraddress" id="erroraddress"></span>
                                    <label for="address">Address</label>
                                </div>
                                <div class="form-floating form-outline">
                                    <select type="text" required name="service" id="service" class="form-control" placeholder=" ">
                                        <?php while ($tbl_service = mysqli_fetch_array($result)) { ?>
                                            <option>
                                                <?php echo $tbl_service['Service_Name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <label class="form-label" for="service">Type of Service</label>
                                    <span id="error9"></span>
                                </div>
                                <div class="form-floating form-floating">
                                    <textarea type="text" required name="description" class="form-control" id="address" placeholder=" "></textarea>
                                    <span class="erroraddress" id="erroraddress"></span>
                                    <label for="address">Provide Description of service you offer</label>
                                    <span class="error" id="error3"></span>
                                </div>
                                <div class="form-floating form-floating">
                                    <input type="number" required name="price" class="form-control" id="price" placeholder=" ">
                                    <span class="errorrate" id="errorrate"></span>
                                    <label for="price">Hourly Rate in Rupees</label>
                                    <span class="error" id="error3"></span>
                                </div>
                                <div class="form-floating form-outline">
                                    <div class="custom-file mb-3">
                                        <input type="file" required accept="application/pdf" class="custom-file-input" id="qualification" name="qualification">
                                        <label class="custom-file-label" for="qualification">Upload Qualification
                                            Documents</label>
                                    </div>
                                    <span id="qualification-error" class="text-danger"></span>
                                </div>

                                <div class="form-floating form-outline">
                                    <div class="custom-file mb-3">
                                        <input type="file" required accept="application/pdf" class="custom-file-input" id="certificate" name="certificate">
                                        <label class="custom-file-label" for="certificate">Upload Certificate
                                            Documents</label>
                                    </div>
                                    <span id="certificate-error" class="text-danger"></span>
                                </div>

                                <div class="form-floating form-outline">
                                    <div class="custom-file">
                                        <input type="file" required accept="application/pdf" class="custom-file-input" id="insurance" name="insurance">
                                        <label class="custom-file-label" for="insurance">Upload Insurance
                                            Documents</label>
                                    </div>
                                    <span id="insurance-error" class="text-danger"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label for="start-time">Work day start:</label>
                                            <input type="text" id="start-time" class="flatpickr form-control" required placeholder="Select start time" name="startday">
                                        </div>
                                        <div class="col-12 col-md-6">

                                            <label for="end-time">Work day end:</label>
                                            <input type="text" id="end-time" class="flatpickr form-control" required placeholder="Select end time" name="endday">
                                        </div>
                                    </div>

                                    <script>
                                        flatpickr("#start-time", {
                                            enableTime: true,
                                            noCalendar: true,
                                            dateFormat: "H:i",
                                            time_24hr: true,
                                            minuteIncrement: 30,
                                            defaultDate: "8:00",
                                            onClose: function(selectedDates, dateStr, instance) {
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
                                                        defaultDate: "20:00",
                                                        minTime: minTime,
                                                    });
                                                }
                                            }
                                        });

                                        flatpickr("#end-time", {
                                            minTime: "8:30",
                                            enableTime: true,
                                            noCalendar: true,
                                            dateFormat: "H:i",
                                            time_24hr: true,
                                            minuteIncrement: 30,
                                            defaultDate: "20:00"
                                        });
                                    </script>
                                </div>
                                <button type="submit" id="sub" class="btn btn-primary btn-block mb-4 mt-3" width="">
                                    Apply
                                </button>
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