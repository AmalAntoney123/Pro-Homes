<?php
include("connection.php");
session_start();

if (isset($_SESSION['uname']))
    $uname = $_SESSION['uname'];

$code = $_POST["code"];

$query = "SELECT * FROM `tbl_user` 
                WHERE `Username` = '$uname'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
if ($row['Verification_status'] == $code) {
    $query = "UPDATE `tbl_user` SET `Verification_status`='verified' WHERE `Username` = '$uname'";
    $result = mysqli_query($con, $query);
    unset($_SESSION['uname']);
    $_SESSION['Check_login'] = "REGISTERED";
    header("Location: signin.php");
} else {
    $_SESSION["Check_login"] = "INVALID_CODE";
    header("Location: validate_email.php");
}
?>