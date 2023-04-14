<?php

namespace Getsno\Relesys\Api\UserManagement\Entities\Patches;

use Getsno\Relesys\Api\PatchOperation;
use Getsno\Relesys\Api\ApiEntityPatch;

class UserGroupPatch extends ApiEntityPatch
{
    public function description(string $description): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/description', $description);

        return $this;
    }

    public function externalId(string $externalId): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/externalId', $externalId);

        return $this;
    }

    public function name(string $name): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/name', $name);

        return $this;
    }
}
