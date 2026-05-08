<?php

namespace Openapi;

use Openapi\Interfaces\OpenapiHttpTransportInterface;
use Openapi\Transports\OpenapiCurlTransport;
use Psr\Http\Client\ClientInterface as PsrClientInterface;

class OpenapiClient
{
    private string $token;
    private OpenapiHttpTransportInterface|PsrClientInterface $transport;
    private ?string $baseUrl = null;

    public function __construct(?string $token = null, OpenapiHttpTransportInterface|PsrClientInterface|null $transport = null)
    {
        $this->token = $token ?? getenv('OPEN_API_TOKEN');
        if (getenv('OPENAPI_BASE_URL')) {
            $this->baseUrl = getenv('OPENAPI_BASE_URL');
        }
        $this->transport = $transport ?? new OpenapiCurlTransport($this->token);
    }

    public function request(
        string $method,
        string $url,
        mixed $payload = null,
        ?array $params = null
    ): string {
        if (!str_starts_with(strtolower($url), 'http') && !empty($this->baseUrl)) {
            $url = rtrim($this->baseUrl, '/') . '/' . ltrim($url, '/');
        }

        return $this->transport->request($method, $url, $payload, $params);
    }

    public function get(string $url, ?array $params = null): string
    {
        return $this->request('GET', $url, null, $params);
    }

    public function post(string $url, mixed $payload = null): string
    {
        return $this->request('POST', $url, $payload);
    }

    public function put(string $url, mixed $payload = null): string
    {
        return $this->request('PUT', $url, $payload);
    }

    public function delete(string $url): string
    {
        return $this->request('DELETE', $url);
    }

    public function patch(string $url, mixed $payload = null): string
    {
        return $this->request('PATCH', $url, $payload);
    }
}
