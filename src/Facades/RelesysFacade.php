<?php

namespace Getsno\Relesys\Facades;

use Illuminate\Support\Facades\Facade;
use Getsno\Relesys\Api\UserManagement\Users;
use Getsno\Relesys\Api\UserManagement\UserGroups;
use Getsno\Relesys\Api\UserManagement\Departments;

/**
 * @method static Users users
 * @method static Departments departments
 * @method static UserGroups userGroups
 */
class RelesysFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'relesys.users';
    }
}
