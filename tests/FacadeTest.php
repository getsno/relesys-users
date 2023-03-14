<?php

namespace Getsno\Relesys\Tests;

use Relesys;
use Orchestra\Testbench\TestCase;
use Getsno\Relesys\Facades\RelesysFacade;

class FacadeTest extends TestCase
{
    public function testRelesysFacade(): void
    {
        $value = Relesys::test();

        $this->assertEquals(1, $value);
    }

    protected function getPackageAliases($app): array
    {
        return [
            'Relesys' => RelesysFacade::class,
        ];
    }
}
