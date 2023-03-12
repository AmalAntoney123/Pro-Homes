<?php
session_start();
include("connection.php");
$u_id = $_SESSION["l_id"];

$query = "SELECT Provider_ID FROM `tbl_service_provider` WHERE `User_ID`=$u_id";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$provider_id = $row["Provider_ID"];

$unavailabledates = $_POST['unavailabledates'];
if (isset($_POST['sunday']))
    $sunday = "Yes";
else
    $sunday = "No";

$startday = $_POST['startday'];
$endday = $_POST['endday'];

$query = "SELECT * FROM `tbl_service_provider_availability` WHERE `Provider_ID`=$provider_id";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    $query = "UPDATE `tbl_service_provider_availability` 
                SET `Unavailable Dates`='$unavailabledates',`Sunday_Unvailable`='$sunday',`Workday_Start`='$startday',`Workday_End`='$endday' 
                    WHERE `Provider_ID`=$provider_id";
} else {

    $query = "INSERT INTO `tbl_service_provider_availability`(`Provider_ID`, `Unavailable Dates`,`Sunday_Unvailable`, `Workday_Start`, `Workday_End`) 
                VALUES ($provider_id,'$unavailabledates','$sunday','$startday','$endday')";
}
$result = mysqli_query($con, $query);
header('location: Service_provider_availability.php')

?>