<?php

namespace Getsno\Relesys\Api\UserManagement\Enums;

enum DepartmentType: string
{
    case COMPANY = 'Company';
    case COUNTRY = 'Country';
    case DEPARTMENT = 'Department';
    case DISTRICT = 'District';
    case DIVISION = 'Division';
    case OTHER = 'Other';
    case PARTNER = 'Partner';
    case REGION = 'Region';
    case STORE = 'Store';
    case SUBDEPARTMENT = 'Subdepartment';
}
