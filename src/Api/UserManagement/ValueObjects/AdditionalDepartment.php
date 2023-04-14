<?php

namespace Getsno\Relesys\Api\UserManagement\ValueObjects;

use Getsno\Relesys\Traits\CreatableFromArray;
use Getsno\Relesys\Traits\ConvertibleToArray;

class AdditionalDepartment
{
    use CreatableFromArray;
    use ConvertibleToArray;

    public string $id;
    public ?string $dataSource;
}
