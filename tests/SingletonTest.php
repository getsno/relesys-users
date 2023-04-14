<?php

namespace Getsno\Relesys\Tests;

use Getsno\Relesys\Facades\RelesysFacade as Relesys;

class SingletonTest extends TestCase
{
    public function testSingleton(): void
    {
        $instance1 = Relesys::getFacadeRoot();
        $instance2 = Relesys::getFacadeRoot();

        $this->assertSame($instance1, $instance2);
    }
}
