<?php
require_once('vendor/autoload.php');

$client = new \GuzzleHttp\Client();
$payment_id=$_GET['link_id'];

$response = $client->request('GET', 'https://sandbox.cashfree.com/pg/links/'.$payment_id, [
  'headers' => [
    'accept' => 'application/json',
    'x-api-version' => '2022-09-01',
    'x-client-id' => 'TEST3437325d45ce39c499a3088c78237343',
    'x-client-secret' => 'TEST81ad41200d25187f8f46ce627ec23fee9a78f5a5',
  ],
]);

$responseBody = $response->getBody();

$responseData = json_decode($responseBody, true);

// Get the payment link from the response data
$paymentLink = $responseData['link_status'];
if ($paymentLink!="PAID")
    echo "Error Completing Payment. Try again later or contact Custumer Care";
else
    echo"Yey";