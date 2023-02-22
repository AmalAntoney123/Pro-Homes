<?php
    session_start();
    include("connection.php");

    $fname=trim($_POST["fname"]);
    $lname=trim($_POST["lname"]);
    $uname=trim($_POST["uname"]);
    $mail=trim($_POST["email"]);
    $pass=trim($_POST["pass"]);
    $phone=$_POST["phone"];
    $pic=$_FILES["p_pic"]["name"];
    $city=$_POST["city"];

    $query = "INSERT INTO `tbl_user`(`First_Name`, `Last_Name`, `Username`, `Email`, `Password`, `Phone_Number`, `Profile_Picture`, `City`, `User_Type`) 
                    VALUES ('$fname','$lname','$uname','$mail','$pass','$phone','$pic','$city','Customer')";
    $result = mysqli_query($con,$query);
    
    if($result){
        $target = "uploads/".$pic;
        move_uploaded_file($_FILES["p_pic"]["tmp_name"],$target);
    }

    if($result){
        header("Location: signin.php");
    }
    $_SESSION['Check_login']="REGISTERED";
?>