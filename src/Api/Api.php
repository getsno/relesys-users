<?php

namespace Getsno\Relesys\Api;

use Getsno\Relesys\RelesysHttpClient;

class Api
{
    public function __construct(
        readonly protected RelesysHttpClient $httpClient,
    )
    {
    }
}
