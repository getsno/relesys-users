<?php

namespace Getsno\Relesys\Api\UserManagement\Entities\Patches;

use Getsno\Relesys\Api\PatchOperation;
use Getsno\Relesys\Api\ApiEntityPatch;
use Getsno\Relesys\Api\UserManagement\Enums\DepartmentType;
use Getsno\Relesys\Api\UserManagement\ValueObjects\PhoneNumber;

class DepartmentPatch extends ApiEntityPatch
{
    public function addressLine(?string $addressLine): self
    {
        $this->addOperation(PatchOperation::Replace, '/addressLine', $addressLine);

        return $this;
    }

    public function addressLine2(?string $addressLine2): self
    {
        $this->addOperation(PatchOperation::Replace, '/addressLine2', $addressLine2);

        return $this;
    }

    public function city(?string $city): self
    {
        $this->addOperation(PatchOperation::Replace, '/city', $city);

        return $this;
    }

    public function contentCulture(string $contentCulture): self
    {
        $this->addOperation(PatchOperation::Replace, '/contentCulture', $contentCulture);

        return $this;
    }

    public function externalId(?string $externalId): self
    {
        $this->addOperation(PatchOperation::Replace, '/externalId', $externalId);

        return $this;
    }

    public function managerUserId(?string $managerUserId): self
    {
        $this->addOperation(PatchOperation::Replace, '/managerUserId', $managerUserId);

        return $this;
    }

    public function name(string $name): self
    {
        $this->addOperation(PatchOperation::Replace, '/name', $name);

        return $this;
    }

    public function parentId(?string $parentId): self
    {
        $this->addOperation(PatchOperation::Replace, '/parentId', $parentId);

        return $this;
    }

    public function phoneNumber(PhoneNumber $phoneNumber): self
    {
        $this->addOperation(PatchOperation::Replace, '/phoneNumber', $phoneNumber->toArray());

        return $this;
    }

    public function showInActivityStatistics(bool $showInActivityStatistics): self
    {
        $this->addOperation(
            PatchOperation::Replace,
            '/showInActivityStatistics',
            $showInActivityStatistics
        );

        return $this;
    }

    public function showInContacts(bool $showInContacts): self
    {
        $this->addOperation(PatchOperation::Replace, '/showInContacts', $showInContacts);

        return $this;
    }

    public function showInHighscores(bool $showInHighscores): self
    {
        $this->addOperation(PatchOperation::Replace, '/showInHighscores', $showInHighscores);

        return $this;
    }

    public function type(DepartmentType $type): self
    {
        $this->addOperation(PatchOperation::Replace, '/type', $type->value);

        return $this;
    }

    public function uiCulture(string $uiCulture): self
    {
        $this->addOperation(PatchOperation::Replace, '/uiCulture', $uiCulture);

        return $this;
    }

    public function zipCode(?string $zipCode): self
    {
        $this->addOperation(PatchOperation::Replace, '/zipCode', $zipCode);

        return $this;
    }
}
