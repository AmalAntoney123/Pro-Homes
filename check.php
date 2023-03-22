<?php
session_start();
include("connection.php");


$uname = $_POST["uname"];
$password = $_POST["pass"];

$query = "SELECT * FROM `tbl_user` WHERE `Username`='$uname'";
$result = mysqli_query($con, $query);
$time=date('Y-m-d H:i:s');

$row = mysqli_fetch_array($result);
if ($row && password_verify($password, $row['Password'])) {
    $lid=$row["User_ID"];
    $query = "UPDATE `tbl_user` SET `Last_Log_Date`='$time' WHERE `User_ID`='$lid'";
    $result = mysqli_query($con, $query);
    $_SESSION["l_id"] = $row["User_ID"];
    if ($row['Verification_status'] != 'verified') {
        unset($_SESSION["l_id"]);
        $_SESSION['uname'] = $uname;
        header("Location: validate_email.php");
    } else if ($row['User_Status'] == 'disabled') {
        $_SESSION['Check_login'] = 'DISABLED';
        unset($_SESSION["l_id"]);
        header("Location: signin.php");
    } else if ($row['User_Type'] == "Admin") {
        $_SESSION["admin_login"] = 1;
        header("Location: admin_index.php");
    } else
        header("Location: services.php");
} else {
    $_SESSION["Check_login"] = "INVALID";
    header("Location: signin.php");
}
?>