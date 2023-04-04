<?php

namespace Getsno\Relesys\Api\UserManagement;

use Getsno\Relesys\Api\PatchOperation;

class ApiEntityPatch
{
    protected array $patch = [];

    public function addOperation(
        PatchOperation $operation,
        string $path,
        string|array|null $value = null
    ): void
    {
        $newPatchOperation = [
            'op'    => $operation->value,
            'path'  => $path,
        ];

        if (in_array($operation, [
            PatchOperation::ADD,
            PatchOperation::REPLACE,
            PatchOperation::TEST
        ],true)) {
            $newPatchOperation['value'] = $value;
        }

        $this->patch[] = $newPatchOperation;
    }

    public function getPatch(): array
    {
        return $this->patch;
    }
}
