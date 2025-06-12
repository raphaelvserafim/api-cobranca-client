<?php

namespace ApiCobranca\Core;

class HttpClient
{
  private string $baseUrl;
  private string $apiKey;


  public function __construct(string $baseUrl, string $apiKey)
  {
    $this->baseUrl = rtrim($baseUrl, '/');
    $this->apiKey = $apiKey;
  }

  public function request(string $method, string $endpoint, array $query = [], $body = null): array
  {
    $url = $this->baseUrl . $endpoint;
    if ($query) {
      $url .= '?' . http_build_query($query);
    }

    $headers = [
      'Content-Type: application/json',
      'Accept: application/json',
      'api-key: ' . $this->apiKey,
    ];



    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    if ($body !== null) {
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    }

    $response = curl_exec($ch);
    $error = curl_error($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($error) {
      throw new \Exception("Erro de requisição: $error");
    }

    return [
      'status' => $code,
      'body' => json_decode($response, true)
    ];
  }
}