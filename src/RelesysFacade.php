<?php

namespace Getsno\Relesys;

use Illuminate\Support\Facades\Facade;

class RelesysFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'relesys';
    }
}
