<?php
include("../../connection.php");

if(isset($_POST['uname']) && $_POST['uname']!="") {
    $uname=$_POST['uname'];
    $query=("SELECT Username FROM tbl_user WHERE Username = '$uname'");
    $result = mysqli_query($con,$query);
    $count=mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    
         if ($row > 0) {       
            echo "<script>$('#uname').addClass('is-invalid');checkValidity();</script><span class='text-danger'>Username already taken.</span>";
        } else {
            echo "<script>$('#uname').removeClass('is-invalid');checkValidity();</script> <span class='text-success'></span>";             
        }
    }
    mysqli_close($con);
?>
