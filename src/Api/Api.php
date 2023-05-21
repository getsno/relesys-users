<?php

namespace Getsno\Relesys\Api;

use Getsno\Relesys\HttpClient\HttpClient;

class Api
{
    public function __construct(
        readonly protected HttpClient $httpClient,
    ) {}
}
