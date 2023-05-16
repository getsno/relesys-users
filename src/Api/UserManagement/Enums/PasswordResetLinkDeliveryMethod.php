<?php

namespace Getsno\Relesys\Api\UserManagement\Enums;

enum PasswordResetLinkDeliveryMethod: string
{
    case Phone = 'phone';
    case Email = 'email';
}
