<?php

namespace Getsno\Relesys\Api\Communication\ValueObjects;

use Getsno\Relesys\Traits\CreatableFromArray;
use Getsno\Relesys\Traits\ConvertibleToArray;

class TemplateEmail
{
    use CreatableFromArray;
    use ConvertibleToArray;

    public readonly string $subject;
    public readonly string $body;
}
