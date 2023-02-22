<?php
session_start();
if (isset($_SESSION["l_id"])) {

    include("connection.php");
    $lid = $_SESSION["l_id"];
    $query = "SELECT * FROM `tbl_user` 
                    WHERE `User_ID` = '$lid'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);

    $tb_pass = $row["Password"];

    $cr_pass = $_POST["password"];
    $new_pass = $_POST["newpassword"];
    if ($tb_pass == $cr_pass) {
        $query = "UPDATE `tbl_user` SET `Password`='$new_pass'
                    WHERE  `User_ID`='$lid'";
        $re = mysqli_query($con, $query);
        $_SESSION["pass_status"]=true;
    }
    else{
        $_SESSION["pass_status"]=false;
    }
    mysqli_close($con);
    header("Location: user_profile.php");
}
?>