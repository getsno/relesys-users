<?php

namespace Getsno\Relesys\Api\UserManagement\Entities;

use Getsno\Relesys\Traits\FillableTrait;
use Getsno\Relesys\Api\ApiEntityInterface;
use Getsno\Relesys\Api\UserManagement\Enums\UserStatus;
use Getsno\Relesys\Api\UserManagement\ValueObjects\PhoneNumber;

class User implements ApiEntityInterface
{
    use FillableTrait;

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
    public array $userGroups;
    public ?string $userName;

    public static function fromArray(array $data): self
    {
        return (new self())->fill($data);

    }
}
