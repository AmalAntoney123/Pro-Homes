<?php
session_start();
include("connection.php");

$house = $_POST['house'];
$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$locality = $_POST['locality'];
$landmark = $_POST['landmark'];
$pincode = $_POST['pincode'];
$address_id=$_POST["token"];

$query = "UPDATE `tbl_address` SET `House`='$house', `Street` = '$street', `State` = '$state', `City` = '$city', `Locality` = '$locality', `Landmark` = '$landmark', `Pincode` = '$pincode' WHERE `tbl_address`.`Address_ID` = $address_id";
$result = mysqli_query($con,$query);

mysqli_close($con);
$_SESSION["address"]='ADDRESS';

header('location: user_profile.php');
?>