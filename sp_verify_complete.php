<?php
include("connection.php");
session_start();

$requestID= $_POST['requestID'];

$code = $_POST["code"];
$query = "SELECT * FROM `tbl_service_request` 
                WHERE `Request_ID`='$requestID'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
if ($row['Status'] == $code) {
    $query = "UPDATE `tbl_service_request` SET `Status`='completed' WHERE `Request_ID`='$requestID'";
    $result = mysqli_query($con, $query);

    $query3 = "SELECT * FROM `tbl_service_request` WHERE `Request_ID`='$requestID'";
    $result3 = mysqli_query($con, $query3);
    $request = mysqli_fetch_array($result3);

    $user_id = $request['User_ID'];
    $provider_id = $request['Provider_ID'];
    $start = strtotime($request['Appoinment_Start_Time']);
    $end = strtotime($request['Appoinment_End_Time']);

    $query4 = "SELECT * FROM `tbl_service_provider` WHERE `Provider_ID`='$provider_id'";
    $result4 = mysqli_query($con, $query4);
    $provider = mysqli_fetch_array($result4);
    $price_ph = $provider['Price'];

    $duration = ($end - $start) / 3600;
    $total_cost = round($duration * $price_ph,3);


    $query1 = "INSERT INTO `tbl_payment`(`User_ID`, `Request_ID`, `Provider_ID`, `Amount`, `Payment_Status`) 
                VALUES ('$user_id','$requestID','$provider_id','$total_cost','pending')";
    $result1 = mysqli_query($con, $query1);

    header("Location: sp_recent_appoinments.php");
} else {
    $rqsturl=urlencode(base64_encode($requestID));
    $_SESSION["Check_login"] = "INVALID_CODE";
    header("Location: verify_service_complete.php?token=$rqsturl");
}
?>