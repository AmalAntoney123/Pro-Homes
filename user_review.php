<?php
session_start();
include("connection.php");
$lid = $_SESSION["l_id"];
$provider_id = $_POST["provider_id"];
$rating = $_POST["rating"];
$review = $_POST["review"];
$query = "INSERT INTO `tbl_service_provider_ratings`( `Provider_ID`, `User_ID`, `Rating`, `Review`) 
            VALUES ('$provider_id','$lid','$rating','$review')";
$result = mysqli_query($con, $query);
header("location:user_profile.php")
?>