<?php

namespace Getsno\Relesys\Api\UserManagement\Enums;

enum PasswordResetLinkDeliveryMethod: string
{
    case PHONE = 'phone';
    case EMAIL = 'email';
}
