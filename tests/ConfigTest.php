<?php

namespace Getsno\Relesys\Tests;

use Orchestra\Testbench\TestCase;
use Getsno\Relesys\RelesysServiceProvider;

class ConfigTest extends TestCase
{
    public function testConfig(): void
    {
        $relesysConfig = config('relesys');

        $this->assertIsArray($relesysConfig);
        $this->assertArrayHasKey('client_id', $relesysConfig);
        $this->assertArrayHasKey('client_secret', $relesysConfig);
    }

    protected function getPackageProviders($app): array
    {
        return [
            RelesysServiceProvider::class,
        ];
    }
}
