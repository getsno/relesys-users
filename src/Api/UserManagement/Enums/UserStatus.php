<?php

namespace Getsno\Relesys\Api\UserManagement\Enums;

enum UserStatus
{
    case Disabled;
    case Activated;
    case Pending;
    case LoginBlocked;
}
