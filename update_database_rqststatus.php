<?php
include("connection.php");

$selectedOption = $_POST['selectedOption'];
$requestID = $_POST['requestID'];

if ($selectedOption == "completed")
    $query = "UPDATE `tbl_service_request` 
                    SET `Status`='$selectedOption', `Appoinment_End_Time`= now()
                        WHERE `Request_ID`='$requestID'";
else
    $query = "UPDATE `tbl_service_request` 
                SET `Status`='$selectedOption' 
                    WHERE `Request_ID`='$requestID'";
$result = mysqli_query($con, $query);
