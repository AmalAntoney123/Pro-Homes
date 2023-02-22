<?php
    include("connection.php");
    session_start();
    $lid = $_SESSION["l_id"];
    $fname=trim($_POST["fname"]);
    $lname=trim($_POST["lname"]);
    $uname=trim($_POST["uname"]);
    $phone=$_POST["phone"];
    $pic=$_FILES["p_pic"]["name"];
    $city=$_POST["city"];
    if($pic== ""){
        $query="UPDATE `tbl_user` SET `First_Name`='$fname',`Last_Name`='$lname',`Username`='$uname',`Phone_Number`='$phone',`City`='$city' 
                    WHERE  `User_ID`='$lid'";
    }else{
        $query="UPDATE `tbl_user` SET `First_Name`='$fname',`Last_Name`='$lname',`Username`='$uname',`Phone_Number`='$phone',`Profile_Picture`='$pic',`City`='$city' 
                    WHERE  `User_ID`='$lid'";
    }
    $re=mysqli_query($con,$query);
    if($re){
        $target = "uploads/".$pic;
        move_uploaded_file($_FILES["p_pic"]["tmp_name"],$target);
    }


    mysqli_close($con);
    header("Location: user_profile.php");
    
?> 