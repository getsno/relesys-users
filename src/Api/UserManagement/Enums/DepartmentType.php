<?php

namespace Getsno\Relesys\Api\UserManagement\Enums;

enum DepartmentType: string
{
    case Company = 'Company';
    case Country = 'Country';
    case Department = 'Department';
    case District = 'District';
    case Division = 'Division';
    case Other = 'Other';
    case Partner = 'Partner';
    case Region = 'Region';
    case Store = 'Store';
    case Subdepartment = 'Subdepartment';
}
