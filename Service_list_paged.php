<?php
$lid=9999;
if(isset($_SESSION['l_id']))
    $lid=$_SESSION['l_id'];
// connect to database
include("connection.php");

// number of records per page
$recordsPerPage = 10;

// get current page number from URL parameter
if (isset($_GET["page"])) {
    $currentPage = $_GET["page"];
} else {
    $currentPage = 1;
}

// calculate starting record for current page
$startingRecord = ($currentPage - 1) * $recordsPerPage;

// fetch data from database
$sql = "SELECT 
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
    WHERE sp.Verification_status = 'verfied' AND u.User_ID not like $lid";


//City Filter
if (isset($_REQUEST['city'])) {
    // store filter value in session
    $_SESSION['city_filter'] = $_REQUEST['city'];
    echo '<script>location.href="services.php";</script>';
}
if (isset($_SESSION['city_filter'])) {
    // retrieve filter value from session
    $city_filter = implode('","', $_SESSION['city_filter']);
    $sql .= ' AND (u.City IN ("' . $city_filter . '"))';
}

//Price Filter
if (isset($_REQUEST['pricefilter'])) {
    // store filter value in session
    $_SESSION['price_filter'] = $_REQUEST['pricefilter'];
    echo '<script>location.href="services.php";</script>';
}
if (isset($_SESSION['price_filter'])) {
    // retrieve filter value from session
    $price_filter = $_SESSION['price_filter'];
    $sql .= ' AND sp.Price > ' . $price_filter ;
}

//Service Filter
if (isset($_REQUEST['service_filter'])) {
    // store filter value in session
    $_SESSION['service_filter'] = $_REQUEST['service_filter'];
    echo '<script>location.href="services.php";</script>';
}
if (isset($_SESSION['service_filter'])) {
    // retrieve filter value from session
    $service_filter = implode('","', $_SESSION['service_filter']);
    $sql .= ' AND (s.Service_Name IN ("' . $service_filter . '"))';
}

//unset filter
if (isset($_REQUEST['sub_unset'])) {
    unset($_SESSION['city_filter']);
    unset($_SESSION['service_filter']);
    unset($_SESSION['price_filter']);
    unset($_REQUEST['city']);
    unset($_REQUEST['service_filter']);
    unset($_REQUEST['price_filter']);  

    echo '<script>location.href="services.php";</script>';
}

// count total number of records
$totalRecords = mysqli_num_rows(mysqli_query($con, $sql));
// calculate total number of pages
$totalPages = ceil($totalRecords / $recordsPerPage);

$sql .= " ORDER BY sp.Provider_ID
LIMIT $startingRecord, $recordsPerPage";

$result = mysqli_query($con, $sql);

// generate HTML output
$output = '<div>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '<div class="row p-2 mt-3 bg-white border rounded">';
        $output .= '<div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" style="width: 100%; height: 200px;object-fit: cover;" src="uploaded files/Profile Pictures/' . $row['Profile_Picture'] . '"></div>';
        $output .= '<div class="col-md-6 mt-1">';
        $output .= '<h5>' . $row['First_Name'] . ' ' . $row['Last_Name'] . '</h5>';
        $output .= '<div class="d-flex flex-row"><div class="ratings mr-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div><span>310</span></div>';
        $output .= '<div class="mt-1 mb-1 spec-1"><span>' . $row['Service_Name'] . '</span><span class="dot"></span><span></span><span class="dot"></span><span> ✓<br></span></div>';
        $output .= '<div class="mt-1 mb-1 spec-1"><span class="text-info"><h5>City: ' . $row['City'] . '</h5></span></div>';
        $output .= '<p class="text-justify text-truncate para mb-0">' . $row['Service_Desc'] . '<br><br></p>';
        $output .= '</div>';
        $output .= '<div class="align-items-center align-content-center col-md-3 border-left mt-1">';
        $output .= '<div class="d-flex flex-row align-items-center"><h4 class="mr-1">' . $row['Price'] . '</h4><span class="">/ hr</span></div><h6 class="text-success">Blank</h6>';
        $output .= '<div class="d-flex flex-column mt-4"><button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#providerModal' . $row['User_ID'] . '">Details</button>
                        <button class="btn btn-outline-primary btn-sm mt-2" type="button" onclick="location.href=`book_now.php?id='.$row['Provider_ID'].'`">Book Now</button></div>';
        $output .= '</div></div>';
        $output .= '<div class="modal fade" id="providerModal' . $row['User_ID'] . '" tabindex="-1" role="dialog" aria-labelledby="providerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width:800px;margin: 0.75rem auto;">
        <div class="modal-content bg-light text-dark">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="providerModalLabel">' . $row['First_Name'] . ' ' . $row['Last_Name'] . '</h5>
                <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <!-- Profile picture -->
                        <img src="uploaded files/Profile Pictures/' . $row['Profile_Picture'] . '" class="img-fluid rounded mb-2" style="width: 100%; height: 200px;object-fit: cover;"
                            alt=" ">
                        <!-- Book Now button -->
                        <button type="button" class="btn btn-primary btn-block mt-3" onclick="location.href=`book_now.php?id='.$row['Provider_ID'].'`">Book Now</button>
                    </div>
                    <div class="col-8">
                        <!-- Name and description -->
                        <h4 class="mb-0">' . $row['First_Name'] . ' ' . $row['Last_Name'] . '</h4>
                        <p class="text-muted mb-0">' . $row['Service_Name'] . '</p>
                        <p class="mt-2">' . $row['Service_Desc'] . '</p>
                        <p class="mt-2"><strong>City:</strong>' . $row['City'] . '</p>
                    </div>
                </div>
                <hr class="bg-light">
                <div class="row">
                    <div class="col-12">
                        <!-- Reviews -->
                        <h5><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                class="fas fa-star"></i><i class="fas fa-star"></i><i
                                class="far fa-star"></i> 4.0</h5>
                        <div class="reviews-wrapper" style="height: 200px; overflow-y: scroll;">
                            <div class="card mb-2">
                                <div class="card-body">
                                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis
                                        sodales
                                        libero a arcu faucibus, vel consectetur sapien blandit.</p>
                                    <small class="text-muted">Reviewer Name</small>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="card-body">
                                    <p class="mb-0">Sed ut euismod mi. Donec ut pharetra quam. Fusce eu felis est.
                                        Nullam
                                        non malesuada ipsum.</p>
                                    <small class="text-muted">Reviewer Name</small>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="card-body">
                                    <p class="mb-0">Sed ut euismod mi. Donec ut pharetra quam. Fusce eu felis est.
                                        Nullam
                                        non malesuada ipsum.</p>
                                    <small class="text-muted">Reviewer Name</small>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="card-body">
                                    <p class="mb-0">Sed ut euismod mi. Donec ut pharetra quam. Fusce eu felis est.
                                        Nullam
                                        non malesuada ipsum.</p>
                                    <small class="text-muted">Reviewer Name</small>
                                </div>
                            </div>
                            <!-- add more reviews here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';

        // Add a container div to wrap the above code
    }
} else {
    $output .= '<div class="col-md-12 my-5  d-flex justify-content-center">';
    $output .= '<h3>No data found.</h3>';
    $output .= '</div>';
}
$output .= '</div><div class="row pt-3 my-3 border rounded d-flex bg-light justify-content-center">';

// generate pagination links

// calculate range of pages to show
$range = 4;
$start = max(1, $currentPage - floor($range / 2));
$end = min($totalPages, $start + $range - 1);

// generate pagination links
if ($totalPages > 1) {
    $output .= '<ul class="pagination">';
    if ($start > 1) {
        // add "first" link
        $output .= '<li class="page-item"><a class="page-link" href="?page=1">First</a></li>';
    }
    for ($i = $start; $i <= $end; $i++) {
        if ($i == $currentPage) {
            $output .= '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
        } else {
            $output .= '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        }
    }
    if ($end < $totalPages) {
        // add "last" link
        $output .= '<li class="page-item"><a class="page-link" href="?page=' . $totalPages . '">Last</a></li>';
    }
    $output .= '</ul>';
}

$output .= '</div>';


$output .= '</div>';

// output HTML
echo $output;

mysqli_close($con);
?>