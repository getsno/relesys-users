<?php

namespace Getsno\Relesys\Api\UserManagement\ValueObjects;

use Getsno\Relesys\Traits\FillableTrait;

class PhoneNumber
{
    use FillableTrait;

    public readonly ?int $countryCode;
    public readonly ?string $number;
}
