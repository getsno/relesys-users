<?php

namespace Getsno\Relesys\Api\UserManagement\ValueObjects;

use Getsno\Relesys\Traits\CreatableFromArray;
use Getsno\Relesys\Traits\ConvertibleToArray;

class PhoneNumber
{
    use CreatableFromArray;
    use ConvertibleToArray;

    public readonly ?int $countryCode;
    public readonly ?string $number;
}
