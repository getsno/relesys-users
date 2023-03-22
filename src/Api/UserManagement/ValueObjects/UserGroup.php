<?php

namespace Getsno\Relesys\Api\UserManagement\ValueObjects;

use Getsno\Relesys\Traits\CreatableFromArray;
use Getsno\Relesys\Traits\ConvertibleToArray;

class UserGroup
{
    use CreatableFromArray;
    use ConvertibleToArray;

    public readonly string $id;
    public readonly ?string $dataSource;
}
