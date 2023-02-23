<?php
session_start();
$lid = $_SESSION["l_id"];
include("connection.php");

$address = $_POST['address'];
$service = $_POST['service'];
$description = $_POST['description'];
$price = $_POST['price'];
$qualification = $_FILES['qualification']['name'];
$certificate = $_FILES['certificate']['name'];
$insurance = $_FILES['insurance']['name'];

$query1 = "SELECT * FROM `tbl_services` WHERE `Service_Name`='$service'";
$result = mysqli_query($con, $query1);
$service_tbl = mysqli_fetch_array($result);
$service_id = (int) $service_tbl['Service_ID'];

$query = "INSERT INTO `tbl_service_provider`(`User_ID`, `Service_ID`, `Address`, `Service_Desc`, `Qualification_File`, `Insurance_File`, `Certificate_File`, `Price`, `Verification_status`) 
                VALUES ('$lid','$service_id','$address','$description','$qualification','$insurance','$certificate','$price','pending')";

$result1 = mysqli_query($con, $query);
if ($result1) {
    $target_qualification = "uploaded files/qualification/" . $qualification;
    $target_insurance = "uploaded files/insurance/" . $insurance;
    $target_certificate = "uploaded files/certificates/" . $certificate;
    move_uploaded_file($_FILES["qualification"]["tmp_name"], $target_qualification);
    move_uploaded_file($_FILES["certificate"]["tmp_name"], $target_certificate);
    move_uploaded_file($_FILES["insurance"]["tmp_name"], $target_insurance);
}


$_SESSION["Requested"] = "VALID";
header("location:user_profile.php")


    ?>