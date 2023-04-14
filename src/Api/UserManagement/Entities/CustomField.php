<?php

namespace Getsno\Relesys\Api\UserManagement\Entities;

use Getsno\Relesys\Api\ApiEntity;

class CustomField extends ApiEntity
{
    public ?string $externalId;
    public string $id;
    public string $name;
    public string $type;
}
