<?php

namespace Getsno\Relesys\Tests;

use Getsno\Relesys\Facades\RelesysFacade;
use Getsno\Relesys\RelesysServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageAliases($app): array
    {
        return [
            'Relesys' => RelesysFacade::class,
        ];
    }

    protected function getPackageProviders($app): array
    {
        return [
            RelesysServiceProvider::class,
        ];
    }
}
