<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include("connection.php");
$pid = $_GET['sp_id'];
$query = "UPDATE `tbl_service_provider` SET `Verification_status`='verfied' WHERE `provider_id`='$pid'";
$result = mysqli_query($con, $query);

$query = "SELECT * FROM `tbl_service_provider` WHERE `provider_id`='$pid'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$uid = $row['User_ID'];

$query = "UPDATE `tbl_user` SET `User_Type`='provider' WHERE `User_ID`='$uid'";
$result = mysqli_query($con, $query);

$query = "SELECT * FROM `tbl_user` WHERE `User_ID`='$uid'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$mail1=$row['Email'];
//mailer
try_again:

$fname = $row['First_Name'];
$lname = $row['Last_Name'];

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
$mail->Subject = 'Service Provider request Update';
$mail->Body = '<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
      body {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
        font-size: 16px;
        line-height: 1.6;
      }

      .container {
        padding: 1rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        background-color: #fff;
        max-width: 600px;
        margin: 0 auto;
      }

      .header {
        padding: 1rem 0;
        background-color: #f06161;
      }

      .header h1 {
        text-align: center;
        color: #fff;
        font-size: 2rem;
        margin: 0;
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
        margin: 0;
      }

      .button {
        display: inline-block;
        padding: 0.5rem 1rem;
        background-color: #f06161;
        color: #fff;
        text-decoration: none;
        border-radius: 0.25rem;
        transition: background-color 0.2s ease-in-out;
      }

      .button:hover {
        background-color: #d54d4d;
      }
    </style>
    <title>Service Provider Access Granted</title>
  </head>
  <body>
    <div class="container">
      <div class="header">
        <h1>Pro Homes</h1>
      </div>
      <div class="title">
        <h2>Service Provider Access Granted</h2>
        <p>Congratulations! You have been accepted as a service provider and can now access the service provider page from your profile.</p>
      </div>
      <div class="code">
        <a href="http://localhost/prohomes/signin.php" class="button">Go to Login</a>
      </div>
      <div class="message">
        <p>This email was sent by Pro Homes</p>
      </div>
      <div class="footer">
        <p>&copy; 2023 Pro Homes. All rights reserved.</p>
      </div>
    </div>
  </body>
</html>
';

if (!$mail->send()) {
    goto try_again;
} else {
    header("Location: admin_verify_request.php");
}
mysqli_close($con);
?>