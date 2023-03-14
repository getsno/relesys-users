<?php

namespace Getsno\Relesys\Tests;

use Getsno\Relesys\RelesysServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            RelesysServiceProvider::class,
        ];
    }
}
