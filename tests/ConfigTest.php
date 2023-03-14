<?php

namespace Getsno\Relesys\Tests;

class ConfigTest extends TestCase
{
    public function testConfig(): void
    {
        $relesysConfig = config('relesys');

        $this->assertIsArray($relesysConfig);
        $this->assertArrayHasKey('client_id', $relesysConfig);
        $this->assertArrayHasKey('client_secret', $relesysConfig);
    }
}
