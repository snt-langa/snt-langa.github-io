<?php
require_once ("index.php");
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.stitch.money/graphql',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"query":"mutation CreatePaymentRequest(\\r\\n    $amount: MoneyInput!,\\r\\n    $payerReference: String!,\\r\\n    $beneficiaryReference: String!,\\r\\n    $externalReference: String,\\r\\n    $beneficiaryName: String!,\\r\\n    $beneficiaryBankId: BankBeneficiaryBankId!,\\r\\n    $beneficiaryAccountNumber: String!) {\\r\\n  clientPaymentInitiationRequestCreate(input: {\\r\\n      amount: $amount,\\r\\n      payerReference: $payerReference,\\r\\n      beneficiaryReference: $beneficiaryReference,\\r\\n      externalReference: $externalReference,\\r\\n      beneficiary: {\\r\\n          bankAccount: {\\r\\n              name: $beneficiaryName,\\r\\n              bankId: $beneficiaryBankId,\\r\\n              accountNumber: $beneficiaryAccountNumber\\r\\n          }\\r\\n      }\\r\\n    }) {\\r\\n    paymentInitiationRequest {\\r\\n      id\\r\\n      url\\r\\n    }\\r\\n  }\\r\\n}","variables":{"amount":{"quantity":1000,"currency":"ZAR"},"payerReference":"KombuchaFizz","beneficiaryReference":"Joe-Fizz-01","externalReference":"example-e32e5478-325b-4869-a53e-2021727d2afe","beneficiaryName":"FizzBuzz Co.","beneficiaryBankId":"fnb","beneficiaryAccountNumber":"123456789"}}',
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer ".$_SESSION['access token'],
    'Content-Type: application/json'
  ),
));
// print_r($_SESSION['access token']);

$response = curl_exec($curl);

$decoded = json_decode($response);
// print_r($decoded);

curl_close($curl);
// echo $response;

$_SESSION['payment id'] = $decoded->data->clientPaymentInitiationRequestCreate->paymentInitiationRequest->id;
$_SESSION['payment url'] = $decoded->data->clientPaymentInitiationRequestCreate->paymentInitiationRequest->url;
// print_r($_SESSION['payment url']);

header ('Location: '.$_SESSION['payment url'].'?redirect_uri=http://localhost:8080/return');



