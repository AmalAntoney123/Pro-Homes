<?php
session_start();
include("connection.php");

$address_id=$_GET["token"];

$query = "DELETE FROM tbl_address WHERE `tbl_address`.`Address_ID` = $address_id";
$result = mysqli_query($con,$query);

mysqli_close($con);
header('location: user_profile.php');
?>