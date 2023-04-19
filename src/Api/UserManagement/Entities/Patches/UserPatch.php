<?php

namespace Getsno\Relesys\Api\UserManagement\Entities\Patches;

use Carbon\Carbon;
use Getsno\Relesys\Api\PatchOperation;
use Getsno\Relesys\Api\ApiEntityPatch;
use Getsno\Relesys\Api\UserManagement\ValueObjects\UserGroup;
use Getsno\Relesys\Api\UserManagement\ValueObjects\PhoneNumber;
use Getsno\Relesys\Api\UserManagement\ValueObjects\AdditionalDepartment;

class UserPatch extends ApiEntityPatch
{
    public function externalId(?string $externalId): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/externalId', $externalId);

        return $this;
    }

    public function name(string $name): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/name', $name);

        return $this;
    }

    public function title(?string $title): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/title', $title);

        return $this;
    }

    public function dataSource(?string $dataSource): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/dataSource', $dataSource);

        return $this;
    }

    public function email(?string $email): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/email', $email);

        return $this;
    }

    public function secondaryEmail(?string $secondaryEmail): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/secondaryEmail', $secondaryEmail);

        return $this;
    }

    public function phoneNumber(PhoneNumber $phoneNumber): self
    {
        $this->addOperation(
            PatchOperation::REPLACE,
            '/phoneNumber',
            $phoneNumber->toArray()
        );

        return $this;
    }

    public function secondaryPhoneNumber(PhoneNumber $phoneNumber): self
    {
        $this->addOperation(
            PatchOperation::REPLACE,
            '/secondaryPhoneNumber',
            $phoneNumber->toArray()
        );

        return $this;
    }

    public function birthDate(?Carbon $birthDate): self
    {
        $this->addOperation(
            PatchOperation::REPLACE,
            '/birthDate',
            $birthDate?->format('m-d-Y')
        );

        return $this;
    }

    public function primaryDepartmentId(string $primaryDepartmentId): self
    {
        $this->addOperation(PatchOperation::REPLACE, '/primaryDepartmentId', $primaryDepartmentId);

        return $this;
    }

    public function employmentDate(?Carbon $employmentDate): self
    {
        $this->addOperation(
            PatchOperation::REPLACE,
            '/employmentDate',
            $employmentDate?->format('m-d-Y')
        );

        return $this;
    }

    public function employmentEndDate(?Carbon $employmentEndDate): self
    {
        $this->addOperation(
            PatchOperation::REPLACE,
            '/employmentEndDate',
            $employmentEndDate?->format('m-d-Y')
        );

        return $this;
    }

    public function addAdditionalDepartment(AdditionalDepartment $department): self
    {
        $this->addOperation(
            PatchOperation::ADD,
            '/additionalDepartments/-',
            $department->toArray()
        );

        return $this;
    }

    public function removeAdditionalDepartment(int $departmentIndex): self
    {
        $this->addOperation(
            PatchOperation::REMOVE,
            "/additionalDepartments/$departmentIndex",
        );

        return $this;
    }

    public function addUserGroup(UserGroup $userGroup): self
    {
        $this->addOperation(
            PatchOperation::ADD,
            '/userGroups/-',
            $userGroup->toArray()
        );

        return $this;
    }

    public function removeUserGroup(int $userGroupIndex): self
    {
        $this->addOperation(
            PatchOperation::REMOVE,
            "/userGroups/$userGroupIndex",
        );

        return $this;
    }
}
