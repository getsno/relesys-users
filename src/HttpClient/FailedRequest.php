<?php

namespace Getsno\Relesys\HttpClient;

class FailedRequest
{
    public function __construct(
        public readonly string $method,
        public readonly string $url,
        public readonly array $params,
    ) {}
}
