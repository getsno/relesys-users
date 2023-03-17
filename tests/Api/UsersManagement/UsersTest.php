<?php

namespace Getsno\Relesys\Tests\Api\UsersManagement;

use Mockery;
use Mockery\MockInterface;
use Getsno\Relesys\Tests\TestCase;
use Getsno\Relesys\RelesysHttpClient;
use Getsno\Relesys\Facades\RelesysFacade;
use Getsno\Relesys\Api\UserManagement\Users;
use Getsno\Relesys\Api\UserManagement\Entities\User;

use function Getsno\Relesys\FakeResponses\getUserResponse;

class UsersTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $relesysHttpClientMock = $this->mock(RelesysHttpClient::class, function (MockInterface $mock) {
            $mock->shouldReceive('get')
                ->with('users')
                ->andReturn([
                    'count' => 2,
                    'data'  => [
                        [
                            'id' => '123',
                        ],
                        [
                            'id' => '456',
                        ],
                    ],
                ]);

            $mock->shouldReceive('get')
                ->with('users/123')
                ->andReturn(getUserResponse('123'));
        });
        $usersApiMock = Mockery::mock(Users::class, [$relesysHttpClientMock])->makePartial();
        RelesysFacade::shouldReceive('users')
            ->andReturn($usersApiMock);
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
    }

    // public function testGetUsers(): void
    // {
    //     $users = \Relesys::users()->getUsers();
    //
    //     $this->assertIsArray($users);
    //     $this->assertInstanceOf(User::class, $users[0]);
    // }
}
