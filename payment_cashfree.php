<?php
session_start();
include("connection.php");
require_once('vendor/autoload.php');

try {
    $client = new \GuzzleHttp\Client();
    $pid=$_POST['pid'];
    $email=$_POST['email'];
    $name=$_POST['name'];
    $price=$_POST['price'];
    $phone=$_POST['phone'];
    $id="order_".date("Y"."m"."d"."H"."i"."s");
    $response = $client->request('POST', 'https://sandbox.cashfree.com/pg/links', [
      'body' => '{"customer_details":{"customer_phone":"'.$phone.'","customer_email":"'.$email.'","customer_name":"'.$name.'"},"link_notify":{"send_sms":true,"send_email":true},"link_notes":{"newKey":"New Value"},"link_meta":{"return_url":"http://localhost/prohomes/paymentcheck.php?link_id={link_id}","upi_intent":false},"link_id":"'.$id.'","link_amount":"'.$price.'","link_currency":"INR","link_purpose":"Pay for your Service","link_auto_reminders":true}',
      'headers' => [
        'accept' => 'application/json',
        'content-type' => 'application/json',
        'x-api-version' => '2022-09-01',
        'x-client-id' => 'TEST3437325d45ce39c499a3088c78237343',
        'x-client-secret' => 'TEST81ad41200d25187f8f46ce627ec23fee9a78f5a5',
      ],
    ]);

    // After receiving the response from the API
    $responseBody = $response->getBody();
    $responseData = json_decode($responseBody, true);

    // Get the payment link from the response data
    $paymentLink = $responseData['link_url'];
    $LinkID = $responseData['link_id'];

    $query = "UPDATE `tbl_payment` SET `Gateway_Order_ID`='$LinkID' WHERE `Payment_ID`=$pid";
    $result = mysqli_query($con, $query);

    // Redirect the user to the payment link
    header("Location: $paymentLink");
    exit();
} catch (Exception $e) {
    // Redirect the user to a 404 page
    header("Location: 404.html");
    exit();
}