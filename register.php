<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include("connection.php");


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$fname = trim($_POST["fname"]);
$lname = trim($_POST["lname"]);
$uname = trim($_POST["uname"]);
$mail1 = trim($_POST["email"]);
$pass = trim($_POST["pass"]);
$phone = $_POST["phone"];
$pic = $_FILES["p_pic"]["name"];
$city = $_POST["city"];
$code= rand(10000,99999);

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


$query = "INSERT INTO `tbl_user`(`First_Name`, `Last_Name`, `Username`, `Email`, `Password`, `Phone_Number`, `Profile_Picture`, `City`, `User_Type`, `Verification_status`) 
                    VALUES ('$fname','$lname','$uname','$mail1','$pass','$phone','$pic','$city','Customer','$code')";
$result = mysqli_query($con, $query);

if ($result) {
    $target = "uploads/" . $pic;
    move_uploaded_file($_FILES["p_pic"]["tmp_name"], $target);
}

if ($result) {
    $_SESSION['uname'] = $uname;
    header("Location: validate_email.php");
}

?>