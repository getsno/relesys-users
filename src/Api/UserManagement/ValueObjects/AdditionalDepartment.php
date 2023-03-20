<?php

namespace Getsno\Relesys\Api\UserManagement\ValueObjects;

use Getsno\Relesys\Traits\FillableTrait;

class AdditionalDepartment
{
    use FillableTrait;

    public string $id;

    public string $dataSource;
}
