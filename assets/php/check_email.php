<?php
include("../../connection.php");

if(isset($_POST['email']) && $_POST['email']!="") {
    $email=$_POST['email'];
    $query=("SELECT Username FROM tbl_user WHERE Email = '$email'");
    $result = mysqli_query($con,$query);
    $count=mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    
         if ($row > 0) {       
            echo "<script>$('#email').addClass('is-invalid');checkValidity();</script><span class='text-danger'>Email already taken.</span>";
        } else {
            echo "<script>$('#email').removeClass('is-invalid');checkValidity();</script> <span class='text-success'></span>";             
        }
    }
    mysqli_close($con);
?>
