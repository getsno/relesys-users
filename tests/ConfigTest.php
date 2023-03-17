<?php

namespace Getsno\Relesys\Tests;

class ConfigTest extends TestCase
{
    public function testConfig(): void
    {
        $relesysConfig = config('relesys');

        $this->assertIsArray($relesysConfig);
        $this->assertEqualsCanonicalizing(
            [
                'client_id',
                'client_secret',
                'scopes',
            ],
            array_keys($relesysConfig)
        );
    }
}
