<?php
session_start();
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://secure.stitch.money/connect/token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'client_id=test-05c34d23-ede9-4646-b613-0090c155d485&scope=client_paymentrequest&grant_type=client_credentials&audience=https%3A%2F%2Fsecure.stitch.money%2Fconnect%2Ftoken&client_secret=C7PhXpowIbMQjZzXqo2SeHMS2uxSgbkzgrUnIpDPS%2B01IDKmTa1n%2Fz0dQY5tvwmVfCAjcGonUL9VZ5eK%2F%2BPmeA%3D%3D',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// echo $response;

$decoded = json_decode($response);
$_SESSION['access token'] = $decoded->access_token;
// print_r ($_SESSION['access token']);
// print_r($decoded);
header ('Location: step2.php');