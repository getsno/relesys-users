<?php

namespace Getsno\Relesys\Tests\Api\Auth;

use Getsno\Relesys\Tests\TestCase;

class BearerTokenTest extends TestCase
{
    /**
     * @doesNotPerformAssertions
     */
    public function testGetBearerToken(): void
    {
        // getting token in construct
        \Relesys::getFacadeRoot();
    }
}
