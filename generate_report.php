<?php
session_start();
require('fpdf.php');
include("connection.php");
$lid = $_SESSION["l_id"];



if(isset($_POST['service_pro']))
    $provider_id=$_POST['service_pro'];
else{
    $sql1 = "SELECT * FROM `tbl_service_provider` WHERE `User_ID`=$lid";
    $result = mysqli_query($con, $sql1);
    $row = mysqli_fetch_array($result);
    $provider_id = $row['Provider_ID'];
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve form data
    $report_type = $_POST['report_type'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Retrieve the provider details
    $provider_sql = "SELECT `p`.`Provider_ID`, `p`.`User_ID`, `p`.`Service_ID`, `p`.`Address`, `p`.`Service_Desc`, `p`.`Qualification_File`, `p`.`Insurance_File`, `p`.`Certificate_File`, `p`.`Price`, `p`.`Verification_status`,
    `u`.`First_Name`, `u`.`Last_Name`, `u`.`Username`, `u`.`Email`, `u`.`Password`, `u`.`Phone_Number`, `u`.`Profile_Picture`, `u`.`City`, `u`.`User_Type`, `u`.`Last_Log_Date`, `u`.`Register_Date`, `u`.`Verification_status` AS `User_Verification_status`, `u`.`User_Status`
    FROM `tbl_service_provider` AS `p`
    JOIN `tbl_user` AS `u`
    ON `p`.`User_ID` = `u`.`User_ID`
    WHERE `Provider_ID` = $provider_id";
    $provider_result = mysqli_query($con, $provider_sql);
    $provider_row = mysqli_fetch_assoc($provider_result);


    // Create PDF object
    $pdf = new FPDF();


    // Set font and text color
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(0, 0, 0);

    // Generate report based on report type
    switch ($report_type) {
        case 'provider_ratings_report':
            $pdf->AddPage();
            // Set report title
            $sql = "SELECT `Rating_ID`, `Provider_ID`, `User_ID`, `Rating`, `Review`, `Review_Date`
                        FROM `tbl_service_provider_ratings`
                        WHERE `Provider_ID` = $provider_id AND `Review_Date` BETWEEN '$start_date' AND '$end_date'";
            $result = mysqli_query($con, $sql);



            // Calculate the average rating for the provider
            $average_rating_sql = "SELECT AVG(`Rating`) AS `Avg_Rating`
                       FROM `tbl_service_provider_ratings`
                       WHERE `Provider_ID` = $provider_id AND `Review_Date` BETWEEN '$start_date' AND '$end_date'";
            $average_rating_result = mysqli_query($con, $average_rating_sql);
            $average_rating_row = mysqli_fetch_assoc($average_rating_result);
            $average_rating = round($average_rating_row['Avg_Rating'], 2);
            $pdf->Cell(0, 10, $provider_row['First_Name'] . ' ' . $provider_row['Last_Name'], 0, 1, 'C');
            $pdf->Cell(0, 10, 'User Rating Report' . ' (' . $start_date . ' to ' . $end_date . ')', 0, 1, 'C');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, $provider_row['City'], 0, 1, 'C');
            $pdf->Cell(0, 10, 'Average Rating: ' . $average_rating, 0, 2, 'C');
            $pdf->Ln();

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(40, 10, 'User', 1, 0, 'C');
            $pdf->Cell(40, 10, 'Rating', 1, 0, 'C');
            $pdf->Cell(30, 10, 'Date', 1, 0, 'C');
            $pdf->Cell(80, 10, 'Review', 1, 1, 'C');

            // Step 3 and 5: Loop through the retrieved data and add rows to the fpdf table
            while ($row = mysqli_fetch_assoc($result)) {
                // Retrieve the user details
                $user_sql = "SELECT `First_Name`, `Last_Name`, `Email`
                             FROM `tbl_user`
                             WHERE `User_ID` = " . $row['User_ID'];
                $user_result = mysqli_query($con, $user_sql);
                $user_row = mysqli_fetch_assoc($user_result);

                // Add the user details, rating, review, and review date to the fpdf table
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(40, 10, $user_row['First_Name'] . ' ' . $user_row['Last_Name'], 1, 0, 'L');
                $pdf->Cell(40, 10, $row['Rating'], 1, 0, 'L');
                $pdf->Cell(30, 10, date('m/d/Y', strtotime($row['Review_Date'])), 1, 0, 'L');
                $pdf->MultiCell(80, 10, $row['Review'], 1, 'L');
            }
            break;
        case 'service_requests_report':
            $pdf->AddPage('P', 'A4');
            $pdf->Cell(0, 10, $provider_row['First_Name'] . ' ' . $provider_row['Last_Name'], 0, 1, 'C');
            $pdf->Cell(0, 10, ' Services Request Report' . ' (' . $start_date . ' to ' . $end_date . ')', 0, 1, 'C');
            $pdf->Ln(10);
            $pdf->SetFont('Arial', '', 12);

            $pdf->Cell(20, 10, '#', 1, 0, 'C');
            $pdf->Cell(40, 10, 'Name', 1, 0, 'C');
            $pdf->Cell(45, 10, 'Appointment Date', 1, 0, 'C');
            $pdf->Cell(45, 10, 'Appointment Time', 1, 0, 'C');
            $pdf->Cell(35, 10, 'Service Status', 1, 1, 'C');

            // Fetch data from the database
            $sql = "SELECT sr.Request_ID, sr.User_ID, sr.Provider_ID, sr.Serivce_ID, 
                        a.Address_ID, sr.Service_Description, sr.Appointment_Date, 
                        sr.Appoinment_Start_Time, sr.Appoinment_End_Time, sr.Status,
                        u.First_Name, u.Last_Name, u.Username, u.Email, u.Password,
                        u.Phone_Number, u.Profile_Picture, u.City, u.User_Type, 
                        u.Register_Date, u.Verification_status, u.User_Status,
                        a.House, a.Street, a.State, a.Locality, a.Landmark, a.Pincode
                            FROM tbl_service_request sr
                            JOIN tbl_user u ON sr.User_ID = u.User_ID
                            JOIN tbl_address a ON sr.Address_ID = a.Address_ID AND a.User_ID = u.User_ID
                                WHERE sr.Provider_ID=$provider_id AND
                                `Appointment_Date` BETWEEN '$start_date' AND '$end_date'";
            $result = mysqli_query($con, $sql);

            // Generate table rows from data
            $count = 1;
            $total = 0;
            $total_to_recieve = 0;
            $total_recieved = 0;
            $total = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $pdf->Cell(20, 10, $count, 1, 0, 'C');
                $pdf->Cell(40, 10, $row['First_Name'] . ' ' . $row['Last_Name'], 1, 0, 'L');
                $pdf->Cell(45, 10, $row['Appointment_Date'], 1, 0, 'C');
                $pdf->Cell(45, 10, $row['Appoinment_Start_Time'], 1, 0, 'C');
                $pdf->Cell(35, 10, $row['Status'], 1, 1, 'C');
                $count++;
            }
            $pdf->Ln(20);
            break;
        case 'payment_report':
            $pdf->AddPage('L', 'A4');
            $pdf->Cell(0, 10, $provider_row['First_Name'] . ' ' . $provider_row['Last_Name'], 0, 1, 'C');
            $pdf->Cell(0, 10, ' Services Payment Report' . ' (' . $start_date . ' to ' . $end_date . ')', 0, 1, 'C');
            $pdf->Ln(10);
            $pdf->SetFont('Arial', '', 12);

            $pdf->Cell(20, 10, '#', 1, 0, 'C');
            $pdf->Cell(40, 10, 'Name', 1, 0, 'C');
            $pdf->Cell(50, 10, 'Appointment Date', 1, 0, 'C');
            $pdf->Cell(50, 10, 'Appointment Time', 1, 0, 'C');
            $pdf->Cell(40, 10, 'Completed Time', 1, 0, 'C');
            $pdf->Cell(30, 10, 'Amount', 1, 0, 'C');
            $pdf->Cell(50, 10, 'Payment Status', 1, 1, 'C');

            // Fetch data from the database
            $sql = "SELECT sr.Request_ID, sr.User_ID, sr.Provider_ID, sr.Serivce_ID, 
                        a.Address_ID, sr.Service_Description, sr.Appointment_Date, 
                        sr.Appoinment_Start_Time, sr.Appoinment_End_Time, sr.Status,
                        u.First_Name, u.Last_Name, u.Username, u.Email, u.Password,
                        u.Phone_Number, u.Profile_Picture, u.City, u.User_Type, 
                        u.Register_Date, u.Verification_status, u.User_Status,
                        a.House, a.Street, a.State, a.Locality, a.Landmark, a.Pincode,
                        p.Amount,P.Payment_Status
                            FROM tbl_service_request sr
                                JOIN tbl_user u ON sr.User_ID = u.User_ID
                                JOIN tbl_payment p ON sr.Provider_ID = P.Provider_ID AND u.User_ID = P.User_ID AND sr.Request_ID = P.Request_ID
                                JOIN tbl_address a ON sr.Address_ID = a.Address_ID AND a.User_ID = u.User_ID
                                    WHERE sr.Provider_ID=$provider_id AND sr.Status like 'completed' AND
                                        `Appointment_Date` BETWEEN '$start_date' AND '$end_date'";
            $result = mysqli_query($con, $sql);

            // Generate table rows from data
            $count = 1;
            $total = 0;
            $total_to_recieve = 0;
            $total_recieved = 0;
            $total = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $pdf->Cell(20, 10, $count, 1, 0, 'C');
                $pdf->Cell(40, 10, $row['First_Name'] . ' ' . $row['Last_Name'], 1, 0, 'L');
                $pdf->Cell(50, 10, $row['Appointment_Date'], 1, 0, 'C');
                $pdf->Cell(50, 10, $row['Appoinment_Start_Time'], 1, 0, 'C');
                $pdf->Cell(40, 10, $row['Appoinment_End_Time'], 1, 0, 'C');
                $pdf->Cell(30, 10, 'Rs. ' . $row['Amount'], 1, 0, 'R');
                $pdf->Cell(50, 10, $row['Payment_Status'], 1, 1, 'C');
                $count++;
                $total += $row['Amount'];
                if ($row['Payment_Status'] == 'paid')
                    $total_recieved += $row['Amount'];
                if ($row['Payment_Status'] == 'pending')
                    $total_to_recieve += $row['Amount'];
            }
            $pdf->SetFont('Arial', 'B', 12);

            $pdf->Cell(230, 10, 'Total to recieve:', 1, 0);
            $pdf->Cell(50, 10, 'Rs.' . $total_to_recieve . '/-', 1, 1);
            $pdf->Cell(230, 10, 'Total Recieved:', 1, 0);
            $pdf->Cell(50, 10, 'Rs.' . $total_recieved . '/-', 1, 1);
            $pdf->Cell(230, 10, 'Sub Total', 1, 0);
            $pdf->Cell(50, 10, 'Rs.' . $total . '/-', 1, 1);
            $pdf->Ln(20);
            break;
        case 'service_provider_profile_report':
            // Step 1: Retrieve the service provider details and reviews from the database
            $sql = "SELECT u.User_ID, u.First_Name, u.Last_Name, u.Username, u.Email, u.Password, u.Phone_Number, u.Profile_Picture, u.City, u.User_Type, u.Last_Log_Date, u.Register_Date, u.Verification_status, u.User_Status, 
                        p.Provider_ID, p.Service_ID, p.Address, p.Service_Desc, p.Qualification_File, p.Insurance_File, p.Certificate_File, p.Price, p.Verification_status,
                        s.Service_Name, s.Description,
                        r.Rating_ID, r.Rating, r.Review, r.Review_Date,
                        SUM(pm.Amount) as Total_Amount
                            FROM tbl_user u
                                JOIN tbl_service_provider p ON u.User_ID = p.User_ID
                                JOIN tbl_services s ON p.Service_ID = s.Service_ID
                                INNER JOIN tbl_service_provider_ratings r ON p.Provider_ID = r.Provider_ID
                                LEFT JOIN tbl_payment pm ON p.Provider_ID = pm.Provider_ID
                                    WHERE p.Provider_ID = $provider_id
                                    GROUP BY p.Provider_ID, r.Rating_ID";

            $result = mysqli_query($con, $sql);
            $provider_row = mysqli_fetch_assoc($result);

            // Step 2: Create an FPDF instance and set the font
            $pdf->AddPage('L', 'A4');
            $pdf->SetFont('Arial', '', 12);

            // Step 3: Add the service provider name and details to the fpdf table
            $average_rating_sql = "SELECT AVG(`Rating`) AS `Avg_Rating`
            FROM `tbl_service_provider_ratings`
            WHERE `Provider_ID` = $provider_id AND `Review_Date`";
            $average_rating_result = mysqli_query($con, $average_rating_sql);
            $average_rating_row = mysqli_fetch_assoc($average_rating_result);
            $average_rating = round($average_rating_row['Avg_Rating'], 2);

            $pdf->Cell(0, 10, $provider_row['First_Name'] . ' ' . $provider_row['Last_Name'] . ' (' . $start_date . ' to ' . $end_date . ')', 0, 1, 'C');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, 'City: ' . $provider_row['City'], 0, 1, 'C');
            $pdf->Cell(0, 10, 'Total Amount earned: Rs.' . $provider_row['Total_Amount'], 0, 1, 'C');
            $pdf->Cell(0, 10, 'Average Rating: ' . $average_rating, 0, 2, 'C');

            $pdf->Ln();

            // Step 4: Add the table with all the reviews to the fpdf document
            $pdf->SetFont('Arial', 'B', 20);
            $pdf->Cell(0, 10, 'Reviews', 0, 1, 'L');
            $pdf->Ln();
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(40, 10, 'User', 1, 0, 'C');
            $pdf->Cell(40, 10, 'Rating', 1, 0, 'C');
            $pdf->Cell(50, 10, 'Date', 1, 0, 'C');
            $pdf->Cell(150, 10, 'Review', 1, 1, 'C');

            // Loop through the retrieved data and add rows to the fpdf table
            while ($row = mysqli_fetch_assoc($result)) {
                // Retrieve the user details
                $user_sql = "SELECT `First_Name`, `Last_Name`, `Email`
    FROM `tbl_user`
    WHERE `User_ID` = " . $row['User_ID'];
                $user_result = mysqli_query($con, $user_sql);
                $user_row = mysqli_fetch_assoc($user_result);

                // Add the user details, rating, review, and review date to the fpdf table
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(40, 10, $user_row['First_Name'] . ' ' . $user_row['Last_Name'], 1, 0, 'L');
                $pdf->Cell(40, 10, $row['Rating'], 1, 0, 'C');
                $pdf->Cell(50, 10, $row['Review_Date'], 1, 0, 'C');
                $pdf->SetFont('Arial', '', 10);
                $pdf->MultiCell(150, 10, $row['Review'], 1, 'L');
            }

            $pdf->Ln();

            // Step 4: Add the table with all the reviews to the fpdf document
            $pdf->SetFont('Arial', 'B', 20);
            $pdf->Cell(0, 10, 'Services', 0, 1, 'L');
            $pdf->Ln();
            $pdf->SetFont('Arial', 'B', 12);

            $pdf->Cell(20, 10, '#', 1, 0, 'C');
            $pdf->Cell(40, 10, 'Name', 1, 0, 'C');
            $pdf->Cell(50, 10, 'Appointment Date', 1, 0, 'C');
            $pdf->Cell(50, 10, 'Appointment Time', 1, 0, 'C');
            $pdf->Cell(40, 10, 'Completed Time', 1, 0, 'C');
            $pdf->Cell(30, 10, 'Amount', 1, 0, 'C');
            $pdf->Cell(50, 10, 'Payment Status', 1, 1, 'C');

            // Fetch data from the database
            $sql = "SELECT sr.Request_ID, sr.User_ID, sr.Provider_ID, sr.Serivce_ID, 
                        a.Address_ID, sr.Service_Description, sr.Appointment_Date, 
                        sr.Appoinment_Start_Time, sr.Appoinment_End_Time, sr.Status,
                        u.First_Name, u.Last_Name, u.Username, u.Email, u.Password,
                        u.Phone_Number, u.Profile_Picture, u.City, u.User_Type, 
                        u.Register_Date, u.Verification_status, u.User_Status,
                        a.House, a.Street, a.State, a.Locality, a.Landmark, a.Pincode,
                        p.Amount,P.Payment_Status
                            FROM tbl_service_request sr
                                JOIN tbl_user u ON sr.User_ID = u.User_ID
                                JOIN tbl_payment p ON sr.Provider_ID = P.Provider_ID AND u.User_ID = P.User_ID AND sr.Request_ID = P.Request_ID
                                JOIN tbl_address a ON sr.Address_ID = a.Address_ID AND a.User_ID = u.User_ID
                                    WHERE sr.Provider_ID=$provider_id AND sr.Status like 'completed'";
            $result = mysqli_query($con, $sql);

            // Generate table rows from data
            $count = 1;
            $total = 0;
            $total_to_recieve = 0;
            $total_recieved = 0;
            $total = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $pdf->SetFont('Arial', '', 12); 
                $pdf->Cell(20, 10, $count, 1, 0, 'C');
                $pdf->Cell(40, 10, $row['First_Name'] . ' ' . $row['Last_Name'], 1, 0, 'L');
                $pdf->Cell(50, 10, $row['Appointment_Date'], 1, 0, 'C');
                $pdf->Cell(50, 10, $row['Appoinment_Start_Time'], 1, 0, 'C');
                $pdf->Cell(40, 10, $row['Appoinment_End_Time'], 1, 0, 'C');
                $pdf->Cell(30, 10, 'Rs. ' . $row['Amount'], 1, 0, 'R');
                $pdf->Cell(50, 10, $row['Payment_Status'], 1, 1, 'C');
                $count++;
                $total += $row['Amount'];
                if ($row['Payment_Status'] == 'paid')
                    $total_recieved += $row['Amount'];
                if ($row['Payment_Status'] == 'pending')
                    $total_to_recieve += $row['Amount'];
            }
            $pdf->SetFont('Arial', 'B', 12);

            $pdf->Cell(230, 10, 'Total to recieve:', 1, 0);
            $pdf->Cell(50, 10, 'Rs.' . $total_to_recieve . '/-', 1, 1);
            $pdf->Cell(230, 10, 'Total Recieved:', 1, 0);
            $pdf->Cell(50, 10, 'Rs.' . $total_recieved . '/-', 1, 1);
            $pdf->Cell(230, 10, 'Sub Total', 1, 0);
            $pdf->Cell(50, 10, 'Rs.' . $total . '/-', 1, 1);
            $pdf->Ln(20);
            break;
    }

    $pdf->Output();
}
