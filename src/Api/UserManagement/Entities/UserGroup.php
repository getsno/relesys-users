<?php

namespace Getsno\Relesys\Api\UserManagement\Entities;

use Getsno\Relesys\Traits\FillableTrait;

class UserGroup
{
    use FillableTrait;

    public string $description;
    public string $externalId;
    public string $id;
    public string $name;
    public string $url;
}
