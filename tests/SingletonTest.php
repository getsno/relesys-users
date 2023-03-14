<?php

namespace Getsno\Relesys\Tests;

use Getsno\Relesys\Facades\RelesysFacade as Relesys;

class SingletonTest extends TestCase
{
    public function testSingleton(): void
    {
        $instance1Token = Relesys::getToken();
        $instance2Token = Relesys::getToken();

        $this->assertEquals($instance1Token, $instance2Token);
    }
}
