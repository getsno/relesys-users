<?php

namespace Getsno\Relesys\Api\UserManagement\Enums;

enum UserStatus: string
{
    case DISABLED = 'Disabled';
    case ACTIVATED = 'Activated';
    case PENDING = 'Pending';
    case LOGIN_BLOCKED = 'LoginBlocked';
}
