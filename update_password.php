<?php
session_start();

include("connection.php");
$lid = $_SESSION["l_id"];
$query = "SELECT * FROM `tbl_user` 
                    WHERE `User_ID` = '$lid'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$new_pass = $_POST["pass"];
$query = "UPDATE `tbl_user` SET `Password`='$new_pass'
                    WHERE  `User_ID`='$lid'";
$re = mysqli_query($con, $query);
$_SESSION["pass_status"] = true;
mysqli_close($con);
header("Location: signin.php");

?>