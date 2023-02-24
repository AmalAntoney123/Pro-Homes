<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

session_start();
$i=0;
try_again:
include("connection.php");

$fname = trim($_POST["fname"]);
$lname = trim($_POST["lname"]);
$uname = trim($_POST["uname"]);
$mail1 = trim($_POST["email"]);
$pass = trim($_POST["pass"]);
$phone = $_POST["phone"];
$pic = $_FILES["p_pic"]["name"];
$city = $_POST["city"];
$code = rand(10000, 99999);

//mailer start
$mail = new PHPMailer;

// Set up SMTP configuration
$mail->isHTML(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'mail.prohomes@gmail.com';
$mail->Password = 'soxizaywlhblgsqu';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$ffname = ucfirst($fname);
$llname = ucfirst($lname);

$fullname = "$ffname $llname";

// Set up email details
$mail->setFrom('mail.prohomes@gmail.com', 'Pro Homes');
$mail->addAddress($mail1, $fullname);
$mail->Subject = 'Verification Code Pro Homes';
$mail->Body = '<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
      body {
        background-color: #f8f9fa;
      }

      .container {
        padding: 1rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        background-color: #fff;
      }

      .header {
        padding: 1rem 0;
        background-color: #f06161;
      }

      .header h1 {
        text-align: center;
        color: #fff;
      }

      .title {
        text-align: center;
        color: #f06161;
        margin-top: 2rem;
      }

      .code {
        text-align: center;
        margin-top: 5rem;
      }

      .code h2 {
        color: #f06161;
        font-size: 5rem;
        font-weight: bold;
        margin-bottom: 2rem;
      }

      .message {
        text-align: center;
        margin-top: 2rem;
      }

      .footer {
        padding: 1rem 0;
        background-color: #f06161;
      }

      .footer p {
        text-align: center;
        color: #fff;
      }
    </style>
    <title>Verification Code</title>
  </head>
  <body>
    <div class="container">
      <div class="header">
        <h1>Pro Homes</h1>
      </div>
      <div class="title">
        <h2>Verification Code</h2>
        <p>Your verification code is:</p>
      </div>
      <div class="code">
        <h2>' . $code . '</h2>
        <p>Enter this code to verify your email address.</p>
      </div>
      <div class="message">
        <p>This email was sent by Pro Homes</p>
      </div>
      <div class="footer">
        <p>&copy; 2023 Pro Homes. All rights reserved.</p>
      </div>
    </div>
  </body>
</html>';
if($i==0){
$query = "INSERT INTO `tbl_user`(`First_Name`, `Last_Name`, `Username`, `Email`, `Password`, `Phone_Number`, `Profile_Picture`, `City`, `User_Type`, `Verification_status`) 
                    VALUES ('$fname','$lname','$uname','$mail1','$pass','$phone','$pic','$city','Customer','$code')";
$result = mysqli_query($con, $query);

if ($result) {
  $target = "uploaded files/Profile Pictures/" . $pic;
  move_uploaded_file($_FILES["p_pic"]["tmp_name"], $target);
}
$i+=1;
}
if (!$mail->send()) {
  goto try_again;
} else {
  $_SESSION['uname'] = $uname;
  header("Location: validate_email.php");
}

?>