<?php

enum PasswordResetLinkDeliveryMethod
{
    case phone;
    case email;
}

var_dump(PasswordResetLinkDeliveryMethod::phone->name);
