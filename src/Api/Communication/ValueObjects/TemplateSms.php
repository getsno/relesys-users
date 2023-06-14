<?php

namespace Getsno\Relesys\Api\Communication\ValueObjects;

use Getsno\Relesys\Traits\CreatableFromArray;
use Getsno\Relesys\Traits\ConvertibleToArray;

class TemplateSms
{
    use CreatableFromArray;
    use ConvertibleToArray;

    public readonly string $body;
}
