<?php

namespace Getsno\Relesys\Api\UserManagement\Entities\Patches;

use Carbon\Carbon;
use Getsno\Relesys\Api\PatchOperation;
use Getsno\Relesys\Api\UserManagement\ApiEntityPatch;
use Getsno\Relesys\Api\UserManagement\Enums\DepartmentType;
use Getsno\Relesys\Api\UserManagement\ValueObjects\UserGroup;
use Getsno\Relesys\Api\UserManagement\ValueObjects\PhoneNumber;
use Getsno\Relesys\Api\UserManagement\ValueObjects\AdditionalDepartment;

class DepartmentPatch extends ApiEntityPatch
{
    public function addressLine(string $addressLine): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/addressLine', $addressLine);

        return $this;
    }

    public function addressLine2(string $addressLine2): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/addressLine2', $addressLine2);

        return $this;
    }

    public function city(string $city): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/city', $city);

        return $this;
    }

    public function contentCulture(string $contentCulture): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/contentCulture', $contentCulture);

        return $this;
    }

    public function externalId(string $externalId): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/externalId', $externalId);

        return $this;
    }

    public function managerUserId(string $managerUserId): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/managerUserId', $managerUserId);

        return $this;
    }

    public function name(string $name): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/name', $name);

        return $this;
    }

    public function parentId(string $parentId): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/parentId', $parentId);

        return $this;
    }

    public function phoneNumber(PhoneNumber $phoneNumber): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/phoneNumber', $phoneNumber->toArray());

        return $this;
    }

    public function showInActivityStatistics(bool $showInActivityStatistics): self
    {
        $this->addOperation(
            PatchOperation::REPLACE,
            '/showInActivityStatistics',
            $showInActivityStatistics
        );

        return $this;
    }

    public function showInContacts(bool $showInContacts): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/showInContacts', $showInContacts);

        return $this;
    }

    public function showInHighscores(bool $showInHighscores): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/showInHighscores', $showInHighscores);

        return $this;
    }

    public function type(DepartmentType $type): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/type', $type->value);

        return $this;
    }

    public function uiCulture(string $uiCulture): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/uiCulture', $uiCulture);

        return $this;
    }

    public function zipCode(string $zipCode): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/zipCode', $zipCode);

        return $this;
    }
}
