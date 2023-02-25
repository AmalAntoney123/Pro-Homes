<?php
session_start();

include("connection.php");
$pid = $_GET['sp_id'];
$query = "UPDATE `tbl_service_provider` SET `Verification_status`='verfied' WHERE `provider_id`='$pid'";
$result = mysqli_query($con, $query);
mysqli_close($con);
header("Location: verify_request.php");

?>