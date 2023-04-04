<?php

namespace Getsno\Relesys\Api\UserManagement\Entities;

use Getsno\Relesys\Api\ApiEntity;

class UserGroup extends ApiEntity
{
    public ?string $description;
    public ?string $externalId;
    public string $id;
    public string $name;
    public ?string $url;
}
