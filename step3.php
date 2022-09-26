<?php
require ("index.php");
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $_SESSION['payment url'].'?redirect_uri=http://localhost:8080/return',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'id=cGF5cmVxLzk1MjdkYjEwLTQ3M2EtNGQxYS05OTY0LWJkY2ViZWVlNDY3Nw%3D%3D&status=complete&externalReference=',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$_SESSION['access token'],
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
