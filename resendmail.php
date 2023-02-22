<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include("connection.php");


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$uname=$_SESSION['uname'];
$code= rand(10000,99999);
$query = "SELECT * FROM `tbl_user` 
                WHERE `Username` = '$uname'";

$result = mysqli_query($con,$query);
$count=mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
$mail1=$row['Email'];
$fname=$row['First_Name'];
$lname=$row['Last_Name'];


//mailer start
$mail = new PHPMailer;

// Set up SMTP configuration
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'mail.prohomes@gmail.com';
$mail->Password = 'soxizaywlhblgsqu';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$ffname=ucfirst($fname);
$llname=ucfirst($lname);

$fullname= "$ffname $llname";
$msg ="<b>Your verification Code: $code";
// Set up email details
$mail->setFrom('mail.prohomes@gmail.com', 'Pro Homes');
$mail->addAddress($mail1, $fullname);
$mail->Subject = 'Verification Code Pro Homes';
$mail->Body = $msg;

// Send the email
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}

//mailer end

$query = "UPDATE `tbl_user` SET `Verification_status`='$code' WHERE `Username` = '$uname'";
$result = mysqli_query($con, $query);

if ($result) {
    $_SESSION['uname'] = $uname;
    header("Location: validate_email.php");
}

?>