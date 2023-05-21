<?php

namespace Getsno\Relesys\HttpClient;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\PendingRequest as LaravelHttpClient;
use Getsno\Relesys\Exceptions\RelesysHttpClientException;

class HttpClient
{
    protected const BASE_URI = 'https://api.relesysapp.net/api/v1.1/';

    protected readonly LaravelHttpClient $httpClient;

    protected readonly string $token;

    public function __construct(
        protected readonly string $client_id,
        protected readonly string $client_secret,
    ) {
        $this->httpClient = Http::acceptJson()->baseUrl(self::BASE_URI);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function get(string $path, array $params = []): array
    {
        return $this->sendRequest(HttpMethod::Get, $path, $params);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function post(string $path, array $params = []): ?array
    {
        return $this->sendRequest(HttpMethod::Post, $path, $params);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function put(string $path, array $params = []): void
    {
        $this->sendRequest(HttpMethod::Put, $path, $params);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function patch(string $path, array $params = []): array
    {
        return $this->sendRequest(HttpMethod::Patch, $path, $params);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function delete(string $path): void
    {
        $this->sendRequest(HttpMethod::Delete, $path);
    }

    /**
     * @throws RelesysHttpClientException
     */
    protected function sendRequest(HttpMethod $type, string $path, array $params = []): ?array
    {
        try {
            $this->token ??= $this->requestToken();
            $httpMethod = $type->value;
            $response = $this->httpClient->withToken($this->token)->$httpMethod($path, $params);

            $response->throw();

            return $response->json();
        } catch (RequestException $e) {
            $error = $e->response?->object()->error ?? $e->getMessage();
            throw RelesysHttpClientException::requestFailed($error, $e->getCode(), $e);
        }
    }

    /**
     * @throws RelesysHttpClientException
     */
    protected function requestToken(): string
    {
        try {
            $response = Http::asForm()->withHeaders([
                'Content-type' => 'application/x-www-form-urlencoded',
            ])->post('https://api.relesysapp.net/login/oauth/authorize', [
                'grant_type'    => 'client_credentials',
                'client_id'     => $this->client_id,
                'client_secret' => $this->client_secret,
                'scope'         => 'relesys.api.users',
            ]);

            $response->throwUnlessStatus(200);

            return $response['access_token'];
        } catch (RequestException $e) {
            $error = $e->response?->object()->error ?? $e->getMessage();
            throw RelesysHttpClientException::getTokenFailed($error, $e->getCode(), $e);
        }
    }
}
