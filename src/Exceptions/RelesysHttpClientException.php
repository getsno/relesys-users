<?php

namespace Getsno\Relesys\Exceptions;

use Throwable;
use Illuminate\Http\Client\RequestException;
use Getsno\Relesys\HttpClient\FailedRequest;

class RelesysHttpClientException extends RelesysException
{
    public readonly FailedRequest $failedRequest;

    public function __construct(
        $message = '',
        $code = 0,
        Throwable $previous = null,
        FailedRequest $failedRequest = null,
    ) {
        parent::__construct($message, $code, $previous);

        $this->failedRequest = $failedRequest;
    }

    public static function getTokenFailed(string $error, int $code, RequestException $prevException): self
    {
        return new static("[Relesys] Failed to get Bearer token: $error", $code, $prevException);
    }

    public static function requestFailed(
        string $error,
        int $code,
        RequestException $prevException,
        FailedRequest $failedRequest,
    ): self {
        return new static("[Relesys] API request failed: $error", $code, $prevException, $failedRequest);
    }
}
