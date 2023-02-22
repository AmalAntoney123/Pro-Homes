<?php
    include("connection.php");
    session_start();

    $uname=$_POST["uname"];
    $password=$_POST["pass"];
    
    $query = "SELECT * FROM `tbl_user` 
                WHERE `Username`='$uname' AND `Password`='$password'";
    $result = mysqli_query($con,$query);
    $count=mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    if($count){
        $_SESSION["l_id"] = $row["User_ID"];
        if($row['User_Type']=="Admin"){
            $_SESSION["admin_login"]=1;
            header("Location: admin_index.php");
        }
        else
            header("Location: services.php");
    }
    else{
        $_SESSION["Check_login"] = "INVALID";
        header("Location: signin.php");
    }
?>