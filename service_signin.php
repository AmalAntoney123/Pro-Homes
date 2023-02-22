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
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
        function validateFileType() {
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            var fileInput = document.getElementById('file');
            var filePath = fileInput.value;
            if (!allowedExtensions.exec(filePath)) {
                alert('Invalid file type. Only JPG, JPEG, PNG and GIF files are allowed.');
                fileInput.value = '';
                return false;
            }
        }
    </script>

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home" style="background-color: #f1fafb;">

    <nav id="scrollspy" class="navbar navbar-light bg-light navbar-expand-lg fixed-top" data-spy="affix"
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
    <section class=" gradient-custom">
        <div class="container py-5 mt-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Service Provider Details</h3>
                            <form>



                                <div class="form-floating form-floating">
                                    <textarea type="text" required name="address" class="form-control" id="address"
                                        placeholder=" "></textarea>
                                    <span class="erroraddress" id="erroraddress"></span>
                                    <label for="address">Address</label>
                                </div>
                                <div class="form-floating form-outline">
                                    <select type="text" required name="city" id="city" class="form-control"
                                        placeholder=" ">
                                        <option>Electrician</option>
                                        <option>PLumber</option>
                                        <option>House Cleaning</option>
                                    </select>
                                    <label class="form-label" for="city">Type of Service</label>
                                    <span id="error9"></span>
                                </div>
                                <div class="form-floating form-floating">
                                    <textarea type="text" required name="address" class="form-control" id="address"
                                        placeholder=" "></textarea>
                                    <span class="erroraddress" id="erroraddress"></span>
                                    <label for="address">Service Description</label>
                                    <span class="error" id="error3"></span>
                                </div>
                                <div class="form-floating form-outline">
                                    <div class="custom-file mb-3">
                                        <input type="file" required class="custom-file-input" id="customFile"
                                            name="filename">
                                        <label class="custom-file-label" for="customFile">Upload Qualification
                                            Documents</label>
                                    </div>
                                    <span id="error8"> </span>
                                </div>
                                <div class="form-floating form-outline">
                                    <div class="custom-file mb-3">
                                        <input type="file" required class="custom-file-input" id="customFile"
                                            name="filename">
                                        <label class="custom-file-label" for="customFile">Upload Certificate
                                            Documents</label>
                                    </div>
                                    <span id="error8"></span>
                                </div>
                                <div class="form-floating form-outline">
                                    <div class="custom-file mb-3">
                                        <input type="file" required class="custom-file-input" id="customFile"
                                            name="filename">
                                        <label class="custom-file-label" for="customFile">Upload Insurance
                                            Documents</label>
                                    </div>
                                    <span id="error8"></span>
                                </div>
                                <button type="submit" id="sub" class="btn btn-primary btn-block mb-4" width="">
                                    Sign up
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