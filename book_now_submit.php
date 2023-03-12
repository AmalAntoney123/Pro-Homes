<?php
session_start();
include("connection.php");

$appoinmentdate = $_POST['appoinmentdate'];
$timeStart = $_POST['time_start'];
$description = $_POST['description'];
$service_id = $_POST['service_id'];
$provider_id=$_SESSION["provider_id"];
$user_id=$_SESSION["l_id"];
$address_id = $_POST['address'];

$query = "INSERT INTO `tbl_service_request`(`User_ID`, `Provider_ID`, `Serivce_ID`, `Address_ID`, `Service_Description`, `Appointment_Date`, `Appoinment_Start_Time`) 
            VALUES ($user_id,$provider_id,$service_id,$address_id,'$description','$appoinmentdate','$timeStart')";
$result = mysqli_query($con, $query);

unset($_SESSION["provider_id"]);
$_SESSION["Requested"]="SERVICE";
header("location:user_profile.php");
?>