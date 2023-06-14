<?php

namespace Getsno\Relesys\Api\Communication\Enums;

enum MessageType: string
{
    case Welcome = 'welcome';
    case LoginInfo = 'logininfo';
    case ForgottenPassword = 'forgottenpassword';
}
