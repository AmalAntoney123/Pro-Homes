<?php
session_start();
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $enable = $_POST['enabled'];
    include("connection.php");
    if ($enable == 0) {
        $query = "UPDATE `tbl_user` SET `User_Status`='active' WHERE `User_ID`='$id'";
    } else {
        $query = "UPDATE `tbl_user` SET `User_Status`='disabled' WHERE `User_ID`='$id'";
    }
    $result = mysqli_query($con, $query);
}
?>