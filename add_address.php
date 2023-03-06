<?php
session_start();
include("connection.php");

$uid=$_SESSION["l_id"];
$house = $_POST['house'];
$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$locality = $_POST['locality'];
$landmark = $_POST['landmark'];
$pincode = $_POST['pincode'];

$query = "INSERT INTO `tbl_address`(`User_ID`, `House`,`Street`,`State`, `City`, `Locality`, `Landmark`, `Pincode`)
            VALUES ('$uid','$house','$street','$state','$city','$locality','$landmark','$pincode')";
$result = mysqli_query($con,$query);

mysqli_close($con);
header('location: user_profile.php');
?>