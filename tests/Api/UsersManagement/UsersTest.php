<?php

namespace Getsno\Relesys\Tests\Api\UsersManagement;

use Mockery;
use Mockery\MockInterface;
use Getsno\Relesys\Tests\TestCase;
use Getsno\Relesys\HttpClient\HttpClient;
use Getsno\Relesys\Api\UserManagement\Users;
use Getsno\Relesys\Api\UserManagement\Entities\User;

use Getsno\Relesys\Api\UserManagement\Enums\UserStatus;

use function Getsno\Relesys\FakeResponses\getUserResponse;
use function Getsno\Relesys\FakeResponses\getUsersResponse;

class UsersTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if ($this->isTestingInIsolation()) {
            $relesysHttpClientMock = $this->mock(HttpClient::class, function (MockInterface $mock) {
                $mock->shouldReceive('get')
                    ->with('users')
                    ->andReturn(getUsersResponse(3));

                $mock->shouldReceive('get')
                    ->with('users/123')
                    ->andReturn(getUserResponse('123'));
            });
            $usersApiMock = Mockery::mock(Users::class, [$relesysHttpClientMock])->makePartial();
            \Relesys::shouldReceive('users')
                ->andReturn($usersApiMock);
        }

    }

    public function testUsersFacade(): void
    {
        $this->assertInstanceOf(Users::class, \Relesys::users());
    }

    public function testGetUser(): void
    {
        $user = \Relesys::users()->getUser('123');

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('123', $user->id);
        $this->assertEquals(UserStatus::ACTIVATED->value, $user->status->value);
    }

    public function testGetUsers(): void
    {
        $users = \Relesys::users()->getUsers();

        $this->assertIsArray($users);
        $this->assertInstanceOf(User::class, $users[0]);
    }
}
