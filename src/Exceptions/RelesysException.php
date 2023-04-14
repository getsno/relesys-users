<?php

namespace Getsno\Relesys\Exceptions;

use Exception;

class RelesysException extends Exception
{
    public static function invalidAuthCredentials(): self
    {
        return new static('Invalid authentication credentials: RELESYS_CLIENT_ID, RELESYS_CLIENT_SECRET');
    }
}
