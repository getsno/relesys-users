<?php

namespace Getsno\Relesys\Api;

enum FilterOperator
{
    case eq;
    case ne;
    case lt;
    case lte;
    case gt;
    case gte;
}
