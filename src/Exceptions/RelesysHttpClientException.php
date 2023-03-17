<?php

namespace Getsno\Relesys\Exceptions;

use Illuminate\Http\Client\RequestException;

class RelesysHttpClientException extends RelesysException
{
    public static function getTokenFailed(string $error, int $code, RequestException $prevException): self
    {
        return new static("Failed to get Bearer token: $error", $code, $prevException);
    }

    public static function getRequestFailed(string $error, int $code, RequestException $prevException): self
    {
        return new static("GET request failed: $error", $code, $prevException);
    }
}
