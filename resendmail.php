<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$i=0;
try_again:


include("connection.php");




$uname = $_SESSION['uname'];
$code = rand(10000, 99999);
$query = "SELECT * FROM `tbl_user` 
                WHERE `Username` = '$uname'";

$result = mysqli_query($con, $query);
$count = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
$mail1 = $row['Email'];
$fname = $row['First_Name'];
$lname = $row['Last_Name'];


//mailer start
$mail = new PHPMailer;
$mail->isHTML(true);
// Set up SMTP configuration
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'mail.prohomes@gmail.com';
$mail->Password = 'kicsgygmfxurgqlf';
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
$query = "UPDATE `tbl_user` SET `Verification_status`='$code' WHERE `Username` = '$uname'";
$result = mysqli_query($con, $query);
$i+=1;
}
// Send the email
if (!$mail->send()) {
  goto try_again;
} else {
  $_SESSION['uname'] = $uname;
  header("Location: validate_email.php");
}

//mailer end



?>