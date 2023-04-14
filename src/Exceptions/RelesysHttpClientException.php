<?php

namespace Getsno\Relesys\Exceptions;

use Illuminate\Http\Client\RequestException;

class RelesysHttpClientException extends RelesysException
{
    public static function getTokenFailed(string $error, int $code, RequestException $prevException): self
    {
        return new static("Failed to get Bearer token: $error", $code, $prevException);
    }

    public static function requestFailed(string $error, int $code, RequestException $prevException): self
    {
        return new static("API request failed: $error", $code, $prevException);
    }
}
