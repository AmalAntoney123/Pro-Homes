<?php
// connect to database
include("connection.php");

// number of records per page
$recordsPerPage = 1;

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
    WHERE sp.Verification_status = 'verfied'
    ORDER BY sp.Provider_ID
    LIMIT $startingRecord, $recordsPerPage";
$result = mysqli_query($con, $sql);

// count total number of records
$totalRecords = mysqli_num_rows(mysqli_query($con, "SELECT * FROM tbl_service_provider WHERE Verification_status = 'verfied'"));

// calculate total number of pages
$totalPages = ceil($totalRecords / $recordsPerPage);

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
    $output .= '<div class="d-flex flex-row align-items-center"><h4 class="mr-1">' . $row['Price'] . '</h4><span class="strike-text">/ hr</span></div><h6 class="text-success">Blank</h6>';
    $output .= '<div class="d-flex flex-column mt-4"><button class="btn btn-primary btn-sm" type="button">Details</button><button class="btn btn-outline-primary btn-sm mt-2" type="button">Book Now</button></div>';
    $output .= '</div></div>';

    // Add a container div to wrap the above code
  }
} else {
  $output .= '<div class="col-md-12">';
  $output .= '<p>No data found.</p>';
  $output .= '</div>';
}
$output .= '</div><div class="row pt-3 mt-3 border rounded d-flex bg-light justify-content-center">';

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

// close