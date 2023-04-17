<?php
session_start();
// Connect to the database
include("connection.php");
// Retrieve the latest service request

$lid = $_SESSION["l_id"];
$query = "SELECT sp.`Provider_ID`, sp.`User_ID`, sp.`Service_ID`, sp.`Address`, sp.`Service_Desc`, sp.`Qualification_File`, sp.`Insurance_File`, sp.`Certificate_File`, sp.`Price`, sp.`Verification_status`, u.`First_Name`, u.`Last_Name`, u.`Username`, u.`Email`, u.`Password`, u.`Phone_Number`, u.`Profile_Picture`, u.`City`, u.`User_Type`, u.`Last_Log_Date`, u.`Register_Date`, u.`Verification_status`, u.`User_Status`
            FROM `tbl_service_provider` sp
                INNER JOIN `tbl_user` u ON sp.`User_ID` = u.`User_ID`
                    WHERE sp.`User_ID`= $lid";
$result1 = mysqli_query($con, $query);
$row=mysqli_fetch_array($result1);
$pid=$row['Provider_ID'];


$sql = "SELECT * FROM `tbl_service_request` WHERE `Provider_ID` =$pid ORDER BY `Request_ID` DESC";
$result = mysqli_query($con, $sql);

// Check if a new request is found
if (mysqli_num_rows($result) > 0) {
    $new_count = mysqli_num_rows($result);
    if (!isset($_SESSION['service_count']) || $new_count > $_SESSION['service_count']) {
        // A new service request has been found since the last check
        $_SESSION['service_count'] = $new_count;
        echo "new";
    }
    else{
        echo "no";
    }
}

// Close the database connection
mysqli_close($con);

?>
