<?php
session_start();
include("connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$requestID = $_REQUEST['requestID'];

try_again:
//mailer

$query3 = "SELECT * FROM `tbl_service_request` WHERE `Request_ID`='$requestID'";
$result3 = mysqli_query($con, $query3);
$request = mysqli_fetch_array($result3);

$user_id = $request['User_ID'];
$code = $request['Status'];
$query = "SELECT * FROM `tbl_user` 
                WHERE `User_ID` = '$user_id'";

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
$mail->Subject = 'Service Completion Code Pro Homes';
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
        <p>Give this code to Service Provider Only After Completion.</p>
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

if (!$mail->send()) {
    goto try_again;
  } else {
    $rqsturl=urlencode(base64_encode($requestID));
    header("Location: verify_service_complete.php?token=$rqsturl");
  }