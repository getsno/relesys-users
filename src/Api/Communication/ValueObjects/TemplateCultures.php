<?php

namespace Getsno\Relesys\Api\Communication\ValueObjects;

use Getsno\Relesys\Traits\CreatableFromArray;
use Getsno\Relesys\Traits\ConvertibleToArray;

class TemplateCultures
{
    use CreatableFromArray;
    use ConvertibleToArray;

    public readonly string $cultureCode;
    public readonly TemplateSms $sms;
    public readonly TemplateEmail $email;
}
