<?php

namespace Getsno\Relesys\Api\UserManagement\ValueObjects;

use Getsno\Relesys\Traits\FillableTrait;

class UserGroup
{
    use FillableTrait;

    public readonly string $id;
    public readonly ?string $dataSource;
}
