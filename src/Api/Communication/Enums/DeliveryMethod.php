<?php

namespace Getsno\Relesys\Api\Communication\Enums;

enum DeliveryMethod: string
{
    case Sms = 'sms';
    case Email = 'email';
    case Both = 'both';
}
