<?php

namespace Getsno\Relesys\Facades;

use Getsno\Relesys\Relesys;
use Illuminate\Support\Facades\Facade;

class RelesysFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Relesys::class;
    }
}
