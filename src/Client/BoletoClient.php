<?php

namespace ApiCobranca\Client;

use ApiCobranca\Core\HttpClient;

class BoletoClient
{
  private HttpClient $http;

  public function __construct(HttpClient $http)
  {
    $this->http = $http;
  }

  public function create(array $boleto): array
  {
    return $this->http->request('POST', '/v1/charge/boleto', [], $boleto);
  }

  public function get(array $filters = []): array
  {
    return $this->http->request('GET', '/v1/charge/boleto', $filters);
  }

  public function update(array $data): array
  {
    return $this->http->request('PUT', '/v1/charge/boleto', [], $data);
  }

  public function getInfo(string $code): array
  {
    return $this->http->request('GET', '/v1/charge/boleto/info', ['code' => $code]);
  }

  public function getPdf(string $linhaDigitavel): array
  {
    return $this->http->request('GET', '/v1/charge/boleto/pdf', ['linhaDigitavel' => $linhaDigitavel]);
  }

  public function getWebhook(): array
  {
    return $this->http->request('GET', '/v1/charge/boleto/webhook');
  }

  public function createWebhook(string $url): array
  {
    return $this->http->request('POST', '/v1/charge/boleto/webhook', [], ['webhookUrl' => $url]);
  }
}