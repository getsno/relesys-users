<?php

namespace Getsno\Relesys\Api\UserManagement\Enums;

enum UserStatus: string
{
    case Disabled = 'Disabled';
    case Activated = 'Activated';
    case Pending = 'Pending';
    case LoginBlocked = 'LoginBlocked';
}
