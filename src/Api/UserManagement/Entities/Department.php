<?php

namespace Getsno\Relesys\Api\UserManagement\Entities;

use Getsno\Relesys\Api\ApiEntity;
use Getsno\Relesys\Api\UserManagement\Enums\DepartmentType;
use Getsno\Relesys\Api\UserManagement\ValueObjects\PhoneNumber;

class Department extends ApiEntity
{
    public ?string $addressLine;
    public ?string $addressLine2;
    public ?string $city;
    public ?string $contentCulture;
    public ?string $defaultPhoneCountryCode;
    public ?string $externalId;
    public string $id;
    public ?string $managerUserId;
    public string $name;
    public ?string $parentId;
    public ?PhoneNumber $phoneNumber;
    public bool $showInActivityStatistics;
    public bool $showInContacts;
    public bool $showInHighscores;
    public ?string $timeZone;
    public DepartmentType $type;
    public ?string $uiCulture;
    public string $url;
    public ?string $zipCode;

    protected function setPhoneNumber(array $phoneNumber): void
    {
        $this->phoneNumber = PhoneNumber::fromArray($phoneNumber);
    }

    protected function setType(string $type): void
    {
        $this->type = DepartmentType::from($type);
    }
}
