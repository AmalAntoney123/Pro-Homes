<?php
session_start();
include("connection.php");

$selectedOption = $_POST['selectedOption'];
$requestID = $_POST['requestID'];

if ($selectedOption == "completed") {
    $selectedOption = rand(100000, 999999);
    $query = "UPDATE `tbl_service_request` 
                    SET `Status`='$selectedOption', `Appoinment_End_Time`= now()
                        WHERE `Request_ID`='$requestID'";
    $result = mysqli_query($con, $query);
    echo "<script>location.href='send_completion_mail.php?requestID=" . $requestID . "'</script>";
} else {
    $query = "UPDATE `tbl_service_request` 
                SET `Status`='$selectedOption' 
                    WHERE `Request_ID`='$requestID'";
    $result = mysqli_query($con, $query);
}
if ($selectedOption == "completed") {
    // $query3 = "SELECT * FROM `tbl_service_request` WHERE `Request_ID`='$requestID'";
    // $result3 = mysqli_query($con, $query3);
    // $request = mysqli_fetch_array($result3);

    // $user_id = $request['User_ID'];
    // $provider_id = $request['Provider_ID'];
    // $start = strtotime($request['Appoinment_Start_Time']);
    // $end = strtotime($request['Appoinment_End_Time']);

    // $query4 = "SELECT * FROM `tbl_service_provider` WHERE `Provider_ID`='$provider_id'";
    // $result4 = mysqli_query($con, $query4);
    // $provider = mysqli_fetch_array($result4);
    // $price_ph = $provider['Price'];

    // $duration = ($end - $start) / 3600;
    // $total_cost = round($duration * $price_ph,3);


    // $query1 = "INSERT INTO `tbl_payment`(`User_ID`, `Request_ID`, `Provider_ID`, `Amount`, `Payment_Status`) 
    //             VALUES ('$user_id','$requestID','$provider_id','$total_cost','pending')";
    // $result1 = mysqli_query($con, $query1);
}
