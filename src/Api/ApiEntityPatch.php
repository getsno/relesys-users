<?php

namespace Getsno\Relesys\Api;

class ApiEntityPatch
{
    protected array $patch = [];

    public function addOperation(
        PatchOperation $operation,
        string $path,
        string|array|null $value = null
    ): void {
        $newPatchOperation = [
            'op'    => $operation->value,
            'path'  => $path,
        ];

        if (in_array($operation, [
            PatchOperation::Add,
            PatchOperation::Replace,
            PatchOperation::Test
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
