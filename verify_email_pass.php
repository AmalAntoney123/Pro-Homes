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
$mail1 = $_POST['mail'];


$query = "SELECT * FROM `tbl_user` 
                    WHERE `Email` = '$mail1'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$fname = trim($row['First_Name']);
$lname = trim($row['Last_Name']);

$count = mysqli_num_rows($result);
$id = $row['User_ID'];
if ($count > 0) {

    $link="localhost/prohomes/reset_password.php?id=".$id;

    //mailer start
    $mail = new PHPMailer;
    $mail->isHTML(true);
    // Set up SMTP configuration
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
    $mail->Subject = 'Reset Password. Pro Homes';
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
    
          .link {
            text-align: center;
            margin-top: 5rem;
          }
    
          .link a {
            display: inline-block;
            padding: 1rem 2rem;
            background-color: #f06161;
            color: #fff;
            text-decoration: none;
            font-size: 2rem;
            font-weight: bold;
            border-radius: 0.5rem;
          }
    
          .link a:hover {
            background-color: #e74c3c;
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
        <title>Forgot Password Link</title>
      </head>
      <body>
        <div class="container">
          <div class="header">
            <h1>Pro Homes</h1>
          </div>
          <div class="title">
            <h2>Forgot Password Link</h2>
            <p>Click on the link below to reset your password:</p>
          </div>
          <div class="link">
            <a href="'.$link.'">Reset Password</a>
            <p>Clicking on the link will take you to the password reset page.</p>
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
        $_SESSION["pass_status"] = false;
        header("Location: signin.php");
      }
} else {
    $_SESSION["Check_login"] = "INVALID_EMAIL";
    header("Location:forget_password.php");
}
?>