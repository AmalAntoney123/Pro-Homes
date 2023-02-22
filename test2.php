<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$mail = new PHPMailer;

// Set up SMTP configuration
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username='mail.prohomes@gmail.com';
$mail->Password='soxizaywlhblgsqu';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Set up email details
$mail->setFrom('mail.prohomes@gmail.com', 'Pro Homes');
$mail->addAddress('recipient@example.com', 'Recipient Name');
$mail->Subject = 'Test email';
$mail->Body = 'This is a test email sent via PHPMailer using Gmail.';

// Send the email
if(!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}
?>