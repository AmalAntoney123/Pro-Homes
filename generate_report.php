<?php
session_start();
include("connection.php");

require_once 'vendor/autoload.php';

use Dompdf\Dompdf;

$lid = $_SESSION["l_id"];



if (isset($_POST['service_pro']))
    $provider_id = $_POST['service_pro'];
else {
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
    $dompdf = new Dompdf();


    // Generate report based on report type
    switch ($report_type) {
        case 'provider_ratings_report':

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

            // Set PDF content
            $html = '
                    <html>
                        <head>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                font-size: 12px;
                                line-height: 1.5;
                                margin: 0;
                                padding: 0;
                            }
                            table {
                                border-collapse: collapse;
                                width: 100%;
                            }

                            th, td {
                                text-align: left;
                                padding: 8px;
                            }

                            th {
                                background-color: #ccc;
                            }
                            </style>
                            </head>
                            <body>
                                <h1>' . $provider_row['First_Name'] . ' ' . $provider_row['Last_Name'] . '</h1>
                                <h2>User Rating Report (' . $start_date . ' to ' . $end_date . ')</h2>
                                <p>' . $provider_row['City'] . '</p>
                                <p>Average Rating: ' . $average_rating . '</p>
                                <table border="1">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Rating</th>
                                        <th>Date</th>
                                        <th>Review</th>
                                    </tr>
                                </thead>
                                <tbody>';

            while ($row = mysqli_fetch_assoc($result)) {
                // Retrieve the user details
                $user_sql = "SELECT `First_Name`, `Last_Name`, `Email`
                                FROM `tbl_user`
                                    WHERE `User_ID` = " . $row['User_ID'];
                $user_result = mysqli_query($con, $user_sql);
                $user_row = mysqli_fetch_assoc($user_result);

                // Add the user details, rating, review, and review date to the table
                $html .= '
                            <tr>
                                <td>' . $user_row['First_Name'] . ' ' . $user_row['Last_Name'] . '</td>
                                <td>' . $row['Rating'] . '</td>
                                <td>' . date('m/d/Y', strtotime($row['Review_Date'])) . '</td>
                                <td>' . $row['Review'] . '</td>
                            </tr>';
            }
            $html .= '    </tbody>
                        </table>
                    </body>
                    </html>';

            // Set PDF options
            $dompdf->set_paper('letter');
            $dompdf->load_html($html);
            $dompdf->render();

            // Output PDF to browser
            $dompdf->stream('provider_ratings_report.pdf', array('Attachment' => false));
            break;
        case 'service_requests_report':
            $html = '<style>
                        body {
                            font-family: Arial, sans-serif;
                            font-size: 12px;
                            line-height: 1.5;
                            margin: 0;
                            padding: 0;
                        }
                        table {
                            border-collapse: collapse;
                            width: 100%;
                        }
        
                        th, td {
                            text-align: left;
                            padding: 8px;
                        }
        
                        th {
                            background-color: #ccc;
                        }
                    </style>
                    <h2>' . $provider_row['First_Name'] . ' ' . $provider_row['Last_Name'] . '</h2>
                    <h3>Services Request Report (' . $start_date . ' to ' . $end_date . ')</h3>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Appointment Date</th>
                                <th>Appointment Time</th>
                                <th>Service Status</th>
                            </tr>
                        </thead>
                        <tbody>';

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
                $html .= '<tr>
                <td>' . $count . '</td>
                <td>' . $row['First_Name'] . ' ' . $row['Last_Name'] . '</td>
                <td>' . $row['Appointment_Date'] . '</td>
                <td>' . $row['Appoinment_Start_Time'] . '</td>
                <td>' . $row['Status'] . '</td>
            </tr>';
                $count++;
            }

            $html .= '</tbody></table>';
            $dompdf->set_paper('letter');
            $dompdf->load_html($html);
            $dompdf->render();

            // Output PDF to browser
            $dompdf->stream('provider_appointment_report.pdf', array('Attachment' => false));
            break;
        case 'payment_report':
            $html = '<html>
            <style>
            body {
                font-family: Arial, sans-serif;
                font-size: 12px;
                line-height: 1.5;
                margin: 0;
                padding: 0;
            }
            table {
                border-collapse: collapse;
                width: 100%;
            }
        
            th, td {
                text-align: left;
                padding: 8px;
            }
        
            th {
                background-color: #ccc;
            }
        </style><body>';
            $html .= '<h1>' . $provider_row['First_Name'] . ' ' . $provider_row['Last_Name'] . '</h1>';
            $html .= '<h2>Services Payment Report' . ' (' . $start_date . ' to ' . $end_date . ')</h2>';
            $html .= '<table border="1"><thead><tr>';
            $html .= '<th>#</th><th>Name</th><th>Appointment Date</th><th>Appointment Time</th>';
            $html .= '<th>Completed Time</th><th>Amount</th><th>Payment Status</th>';
            $html .= '</tr></thead><tbody>';

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
            $total_to_receive = 0;
            $total_received = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $html .= '<tr>';
                $html .= '<td>' . $count . '</td>';
                $html .= '<td>' . $row['First_Name'] . ' ' . $row['Last_Name'] . '</td>';
                $html .= '<td>' . $row['Appointment_Date'] . '</td>';
                $html .= '<td>' . $row['Appoinment_Start_Time'] . '</td>';
                $html .= '<td>' . $row['Appoinment_End_Time'] . '</td>';
                $html .= '<td>Rs. ' . $row['Amount'] . '</td>';
                $html .= '<td>' . $row['Payment_Status'] . '</td>';
                $html .= '</tr>';
                $count++;
                $total += $row['Amount'];
                if ($row['Payment_Status'] == 'paid') {
                    $total_received += $row['Amount'];
                }
                if ($row['Payment_Status'] == 'pending') {
                    $total_to_receive += $row['Amount'];
                }
            }
            $html .= '<tr><th colspan="6">Amount Recieved</th><th>Rs. ' . $total_received . '</th></tr>';
            $html .= '<tr><th colspan="6">Amount To Be Recieved</th><th>Rs. ' . $total_to_receive . '</th></tr>';
            $html .= '<tr><th colspan="6">Total Amount</th><th>Rs. ' . $total . '</th></tr>';
            $html .= '</tbody></table>';
            $dompdf->set_paper('letter');
            $dompdf->load_html($html);
            $dompdf->render();

            // Output PDF to browser
            $dompdf->stream('provider_ratings_report.pdf', array('Attachment' => false));
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


            // Step 2: Add the service provider name and details to the fpdf table
            $average_rating_sql = "SELECT AVG(`Rating`) AS `Avg_Rating`
            FROM `tbl_service_provider_ratings`
            WHERE `Provider_ID` = $provider_id AND `Review_Date`";
            $average_rating_result = mysqli_query($con, $average_rating_sql);
            $average_rating_row = mysqli_fetch_assoc($average_rating_result);
            $average_rating = round($average_rating_row['Avg_Rating'], 2);

            $html = '<!DOCTYPE html>
            <html>
            <head>
                <meta charset="UTF-8">
                <title>Profile Report</title>
                <style>
                        body {
                            font-family: Arial, sans-serif;
                            font-size: 12px;
                            line-height: 1.5;
                            margin: 0;
                            padding: 0;
                        }
                        table {
                            border-collapse: collapse;
                            width: 100%;
                        }
        
                        th, td {
                            text-align: left;
                            padding: 8px;
                        }
        
                        th {
                            background-color: #ccc;
                        }
                    </style>
            </head>
            <body>
            
                <h1>Service Provider Profile Report</h1>
            
                <h1>' . $provider_row['First_Name'] . ' ' . $provider_row['Last_Name'] . '</h1>
                                <h2>User Rating Report (' . $start_date . ' to ' . $end_date . ')</h2>
                                <p>' . $provider_row['City'] . '</p>
                                <p>Average Rating: ' . $average_rating . '</p>
            
                <h2>Reviews</h2>
                <table border="1">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Rating</th>
                            <th>Date</th>
                            <th>Review</th>
                        </tr>
                    </thead>
                    <tbody>
                        ';
            while ($row = mysqli_fetch_assoc($result)) {
                // Retrieve the user details
                $user_sql = "SELECT `First_Name`, `Last_Name`, `Email`
                FROM `tbl_user`
                WHERE `User_ID` = " . $row['User_ID'];
                $user_result = mysqli_query($con, $user_sql);
                $user_row = mysqli_fetch_assoc($user_result);
                $html .= '
                            <tr>
                                <td>' . $user_row['First_Name'] . ' ' . $user_row['Last_Name'] . '</td>
                                <td>' . $row['Rating'] . '</td>
                                <td>' . $row['Review_Date'] . '</td>
                                <td>' . $row['Review'] . '</td>
                            </tr>';
            }
            $html .= '</tbody>
                </table>';

            $html .= '<h2>Services</h2>
                <table border="1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Appointment Date</th>
                            <th>Appointment Start Time</th>
                            <th>Appointment End Time</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>';
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
                $count++;
                $total += $row['Amount'];
                if ($row['Payment_Status'] == 'paid')
                    $total_recieved += $row['Amount'];
                if ($row['Payment_Status'] == 'pending')
                    $total_to_recieve += $row['Amount'];

                $html .= '<tr>
                                <td>' . $count . '</td>
                                <td>' . $row['First_Name'] . ' ' . $row['Last_Name'] . '</td>
                                <td>' . $row['Appointment_Date'] . '</td>
                                <td>' . $row['Appoinment_Start_Time'] . '</td>
                                <td>' . $row['Appoinment_End_Time'] . '</td>
                                <td>' . $row['Amount'] . '</td>
                                <td>' . $row['Payment_Status'] . '</td>
                            </tr>';
            }
            $html .= '<tr><th colspan="6">Amount Recieved</th><th>Rs. ' . $total_recieved . '</th></tr>';
            $html .= '<tr><th colspan="6">Amount To Be Recieved</th><th>Rs. ' . $total_to_recieve;
            $html .= '</th></tr>';
            $html .= '<tr><th colspan="6">Total Amount</th><th>Rs. ' . $total . '</th></tr>';
            $html .= '</tbody></table>';
            $dompdf->set_paper('letter');
            $dompdf->load_html($html);
            $dompdf->render();

            // Output PDF to browser
            $dompdf->stream('provider_ratings_report.pdf', array('Attachment' => false));
            break;
    }
}
