    <?php
    $lid = 9999;
    if (isset($_SESSION['l_id']))
        $lid = $_SESSION['l_id'];
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

    // initialize search query and search flag
    $search_query = "";
    $search_flag = false;

    // check if search button was pressed
    if (isset($_REQUEST['sub_search'])) {
        // extract search query from form input
        $search_query = $_REQUEST['search'];
        // modify SQL query to search relevant columns for the search query
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
            WHERE sp.Verification_status = 'verfied' AND u.User_ID NOT LIKE $lid 
            AND (u.First_Name LIKE '%$search_query%' 
                OR u.Last_Name LIKE '%$search_query%' 
                OR u.City LIKE '%$search_query%' 
                OR s.Service_Name LIKE '%$search_query%')";
        // set search flag to true
        $search_flag = true;
    } else {
        // execute original SQL query that fetches all verified service providers
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
            WHERE sp.Verification_status = 'verfied' AND u.User_ID NOT LIKE $lid";
    
    //City Filter
    
    if (isset($_REQUEST['city'])) {
        $city_filter = implode('","', $_REQUEST['city']);
        $sql .= ' AND (u.City IN ("' . $city_filter . '"))';
    }

    if (isset($_REQUEST['pricefilter'])) {
        $price_filter = $_REQUEST['pricefilter'];
        $sql .= ' AND sp.Price > ' . $price_filter;
    }

    if (isset($_REQUEST['service_filter'])) {
        $service_filter = implode('","', $_REQUEST['service_filter']);
        $sql .= ' AND (s.Service_Name IN ("' . $service_filter . '"))';
    }
}

if(isset($_REQUEST['sub_unset']))
    echo"<script>location.href='services.php'</script>";
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

            $crnt_pid = $row['Provider_ID'];
            // Retrieve the rating data from the database
            $query3 = "SELECT AVG(Rating) AS AvgRating, COUNT(Rating) AS TotalRatings FROM tbl_service_provider_ratings WHERE Provider_ID = $crnt_pid";
            $result3 = mysqli_query($con, $query3);
            $rating = mysqli_fetch_array($result3);
            $avg_rating = $rating['AvgRating'];
            $total_ratings = $rating['TotalRatings'];

            // Convert the average rating to stars
            $star_rating = '';
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= round($avg_rating)) {
                    $star_rating .= '<i class="fa fa-star" style="color:gold;border:5;"></i>';
                } else {
                    $star_rating .= '<i class="far fa-star"></i>';
                }
            }
            $avg_rating = round($avg_rating, 2);
            // Display the rating and total number of ratings
            $output .= '<div class="d-flex flex-row"><div class="ratings mr-2">' . $star_rating . '</div><span>' . $total_ratings . '</span></div>';



            $output .= '<div class="mt-1 mb-1 spec-1"><span>' . $row['Service_Name'] . '</span><span> ✓<br></span></div>';
            $output .= '<div class="mt-1 mb-1 spec-1"><span class="text-info"><h5>City: ' . $row['City'] . '</h5></span></div>';
            $output .= '<p class="text-justify text-truncate para mb-0">' . $row['Service_Desc'] . '<br><br></p>';
            $output .= '</div>';
            $output .= '<div class="align-items-center align-content-center col-md-3 border-left mt-1">';
            $output .= '<div class="d-flex flex-row align-items-center"><h4 class="mr-1">' . $row['Price'] . '</h4><span class="">/ hr</span></div><h6 class="text-success">Blank</h6>';
            $output .= '<div class="d-flex flex-column mt-4"><button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#providerModal' . $row['User_ID'] . '">Details</button>
                            <button class="btn btn-outline-primary btn-sm mt-2" type="button" onclick="location.href=`book_now.php?id=' . $row['Provider_ID'] . '`">Book Now</button></div>';
            $output .= '</div></div>';
            $output .= '<div class="modal fade" id="providerModal' . $row['User_ID'] . '" tabindex="-1" role="dialog" aria-labelledby="providerModalLabel" aria-hidden="true">
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
                            <button type="button" class="btn btn-primary btn-block mt-3" onclick="location.href=`book_now.php?id=' . $row['Provider_ID'] . '`">Book Now</button>
                        </div>
                        <div class="col-8">
                            <!-- Name and description -->
                            <h4 class="mb-0">' . $row['First_Name'] . ' ' . $row['Last_Name'] . '</h4>
                            <p class="text-muted mb-0">' . $row['Service_Name'] . '</p>
                            <p class="mt-2">' . $row['Service_Desc'] . '</p>
                            <p class="mt-2"><strong>City:</strong>' . $row['City'] . '</p>
                        </div>
                    </div>
                    <hr class="bg-light"><div class="row">
                    <div class="col-12">
                    <!-- Reviews -->
                        <h5>' . $star_rating . ' ' . $avg_rating . '</h5>
                        <div class="reviews-wrapper" style="height: 200px; overflow-y: scroll;">';
                        // Fetch the reviews from the database
            $reviews_query = "SELECT r.Rating_ID, r.Provider_ID, r.User_ID, r.Rating, r.Review, r.Review_Date,
                                u.First_Name, u.Last_Name, u.Email, u.Phone_Number, u.Profile_Picture, u.City, u.User_Type
                                FROM tbl_service_provider_ratings r
                                JOIN tbl_user u
                                ON r.User_ID = u.User_ID
                                WHERE r.Provider_ID = $crnt_pid";
            $reviews_result = mysqli_query($con, $reviews_query);

            // Display the reviews
            while ($review_row = mysqli_fetch_assoc($reviews_result)) {
                $date = $review_row['Review_Date'];
                $formatted_date = date("Y-m-d", strtotime($date));
                $output .= '';

                $rating2 = $review_row['Rating'];
                $checked_stars = '';
                $unchecked_stars = '';
            
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $rating2) {
                        $checked_stars .= '<span class="fas fa-star checked"></span>';
                    } else {
                        $unchecked_stars .= '<span class="far fa-star"></span>';
                    }
                }

                $output .= '<div class="card mb-2">
                                <div class="card-body">
                                    <small class="text-muted">' . $review_row['First_Name'] . ' ' . $review_row['Last_Name'] . '</small>
                                    <div class="rating">' . $checked_stars . $unchecked_stars . '</div>
                                    <p class="mb-0">' . $review_row['Review'] . '</p>
                                    <small class="text-muted">' . $formatted_date . '</small>
                                </div>
                            </div>';
            }

            $output .= '    </div>  
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
        $searchParam = $search_flag ? "&search=$search_query&sub_search=" : "";
        $cityParam = isset($_REQUEST['city']) ? '&city[]=' . implode('&city[]=', $_REQUEST['city']) : '';
        $priceParam = isset($_REQUEST['pricefilter']) ? '&pricefilter=' . $_REQUEST['pricefilter'] : '';
        $serviceParam = isset($_REQUEST['service_filter']) ? '&service_filter[]=' . implode('&service_filter[]=', $_REQUEST['service_filter']) : '';
    
        $params = $searchParam . $cityParam . $priceParam . $serviceParam;
    
        if ($start > 1) {
            $output .= '<li class class="page-item"><a class="page-link" href="?page=1' . $params . '">First</a></li>';
        }
        for ($i = $start; $i <= $end; $i++) {
            if ($i == $currentPage) {
                $output .= '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
            } else {
                $output .= '<li class="page-item"><a class="page-link" href="?page=' . $i . $params . '">' . $i . '</a></li>';
            }
        }
        if ($end < $totalPages) {
            $output .= '<li class="page-item"><a class="page-link" href="?page=' . $totalPages . $params . '">Last</a></li>';
        }
        $output .= '</ul>';
    }

    $output .= '</div>';


    $output .= '</div>';

    // output HTML
    echo $output;

    mysqli_close($con);
