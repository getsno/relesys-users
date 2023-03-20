<?php

namespace Getsno\Relesys\Api\UserManagement\Entities;

use JetBrains\PhpStorm\ArrayShape;
use Getsno\Relesys\Traits\FillableTrait;
use Getsno\Relesys\Api\ApiEntityInterface;
use Getsno\Relesys\Api\UserManagement\Enums\UserStatus;
use Getsno\Relesys\Api\UserManagement\ValueObjects\PhoneNumber;
use Getsno\Relesys\Api\UserManagement\ValueObjects\AdditionalDepartment;
use \Getsno\Relesys\Api\UserManagement\ValueObjects\UserGroup;

class User implements ApiEntityInterface
{
    use FillableTrait;

    /**
     * @var AdditionalDepartment[]
     */
    public array $additionalDepartments;
    public ?string $birthDate;
    public ?string $dataSource;
    public ?string $departmentUrl;
    public string $email;
    public ?string $employmentDate;
    public ?string $employmentEndDate;
    public ?string $externalId;
    public string $id;
    public string $name;
    public ?PhoneNumber $phoneNumber;
    public ?string $primaryDepartmentId;
    public ?string $secondaryEmail;
    public ?PhoneNumber $secondaryPhoneNumber;
    public UserStatus $status;
    public ?string $title;
    public ?string $url;

    /**
     * @var UserGroup[]
     */
    public array $userGroups;
    public ?string $userName;

    protected function setAdditionalDepartments(array $additionalDepartments): void
    {
        foreach ($additionalDepartments as $additionalDepartment) {
            $this->additionalDepartments[] = AdditionalDepartment::fromArray($additionalDepartment);
        }
    }

    protected function setPhoneNumber(array $phoneNumber): void
    {
        $this->phoneNumber = PhoneNumber::fromArray($phoneNumber);
    }

    protected function setSecondaryPhoneNumber(array $phoneNumber): void
    {
        $this->secondaryPhoneNumber = PhoneNumber::fromArray($phoneNumber);
    }

    protected function setStatus(string $status): void
    {
        $this->status = UserStatus::from($status);
    }

    protected function setUserGroups(array $userGroups): void
    {
        foreach ($userGroups as $userGroup) {
            $this->userGroups[] = UserGroup::fromArray($userGroup);
        }
    }
}
