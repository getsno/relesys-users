<?php

namespace Getsno\Relesys;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\PendingRequest as HttpClient;
use Getsno\Relesys\Exceptions\RelesysHttpClientException;

class RelesysHttpClient
{
    protected const BASE_URI = 'https://api.relesysapp.net/api/v1.1/';

    protected readonly HttpClient $httpClient;

    /**
     * @throws RelesysHttpClientException
     */
    public function __construct(
        protected readonly string $client_id,
        protected readonly string $client_secret,
    )
    {
        $this->httpClient = Http::acceptJson()
            ->baseUrl(self::BASE_URI)
            ->withToken($this->requestToken());
    }

    /**
     * @throws RelesysHttpClientException
     */
    private function requestToken(): string
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
            $error = $e->response ? $e->response->object()->error : $e->getMessage();
            throw RelesysHttpClientException::getTokenFailed($error, $e->getCode(), $e);
        }
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function get(string $path, array $params = []): array
    {
        try {
            $response = $this->httpClient->get($path, $params);

            $response->throwUnlessStatus(200);

            return $response->json();
        } catch (RequestException $e) {
            $error = $e->response ? $e->response->object()->error : $e->getMessage();
            throw RelesysHttpClientException::getRequestFailed($error, $e->getCode(), $e);
        }
    }
}
