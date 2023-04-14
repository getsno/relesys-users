<?php

namespace Getsno\Relesys;

use Getsno\Relesys\Api\UserManagement\Users;
use Getsno\Relesys\HttpClient\HttpClient;
use Getsno\Relesys\Api\UserManagement\UserGroups;
use Getsno\Relesys\Api\UserManagement\Departments;
use Getsno\Relesys\Api\UserManagement\CustomFields;

class Relesys
{
    public function __construct(
        protected readonly HttpClient $httpClient,
    )
    {
    }

    public function departments(): Departments
    {
        return new Departments($this->httpClient);
    }

    public function userGroups(): UserGroups
    {
        return new UserGroups($this->httpClient);
    }

    public function users(): Users
    {
        return new Users($this->httpClient);
    }

    public function customFields(): CustomFields
    {
        return new CustomFields($this->httpClient);
    }
}
