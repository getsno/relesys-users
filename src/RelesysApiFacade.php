<?php

namespace Getsno\RelesysApi;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Getsno\RelesysApi\Skeleton\SkeletonClass
 */
class RelesysApiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'relesys-api';
    }
}
