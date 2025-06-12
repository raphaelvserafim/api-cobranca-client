<?php

use ApiCobranca\Core\HttpClient;
use ApiCobranca\Client\BoletoClient;

require 'vendor/autoload.php';

$http = new HttpClient('https://payments.cachesistemas.com.br', '');

$boleto = new BoletoClient($http);

$response = $boleto->get([
  'day' => '2025-06-09',
  'page' => 0,
  'type' => 'liquidated'
]);


echo $response['status'] . PHP_EOL;
echo sizeof($response['body']['items']);
echo json_encode($response['body']['items'], JSON_PRETTY_PRINT) . PHP_EOL;