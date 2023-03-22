<?php

namespace Getsno\Relesys\Tests\Api\UsersManagement;

use Mockery\MockInterface;
use Getsno\Relesys\Tests\TestCase;
use Getsno\Relesys\Api\UserManagement\Users;
use Getsno\Relesys\Facades\RelesysFacade as Relesys;
use Getsno\Relesys\Api\UserManagement\Entities\User;
use Getsno\Relesys\Api\UserManagement\Enums\UserStatus;
use Getsno\Relesys\Exceptions\RelesysHttpClientException;
use Getsno\Relesys\Api\UserManagement\Enums\PasswordResetLinkDeliveryMethod;

use function Getsno\Relesys\Tests\getUsersResponse;
use function Getsno\Relesys\Tests\getUserResponse;
use function Getsno\Relesys\Tests\createUserResponse;

class UsersTest extends TestCase
{
    public function testUsersFacade(): void
    {
        $this->mockFacadeIfTestingInIsolation('users');

        $this->assertInstanceOf(Users::class, Relesys::users());
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testGetUser(): void
    {
        $this->mockFacadeIfTestingInIsolation('users', static function (MockInterface $mock) {
            $mock->shouldReceive('get')
                ->once()
                ->with('users/123')
                ->andReturn(getUserResponse('123'));
        });

        $user = Relesys::users()->getUser('123');

        $this->assertEquals('123', $user->id);
        $this->assertEquals(UserStatus::ACTIVATED->value, $user->status->value);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testGetUsers(): void
    {
        $this->mockFacadeIfTestingInIsolation('users', function (MockInterface $mock) {
            $mock->shouldReceive('get')
                ->once()
                ->with('users')
                ->andReturn(getUsersResponse(3));
        });

        $users = Relesys::users()->getUsers();

        $this->assertIsArray($users);
        $this->assertContainsOnlyInstancesOf(User::class, $users);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testCreateUser(): void
    {
        $this->mockFacadeIfTestingInIsolation('users', function (MockInterface $mock) {
            $mock->shouldReceive('post')
                ->once()
                ->withArgs(static fn(string $path, array $params) => true)
                ->andReturnUsing(static function (string $path, array $params) {
                    return createUserResponse(User::fromArray($params));
                });
        });

        $user = User::fromArray([
            'name'                => 'Anton',
            'primaryDepartmentId' => '123',
            'phoneNumber'         => [
                'countryCode' => 47,
                'number'      => '1111111',
            ],
            'userGroups'          => [
                [
                    'id'         => fake()->uuid,
                    'dataSource' => 'testing',
                ],
            ],
        ]);
        $newUser = Relesys::users()->createUser($user);

        $this->assertEquals('Anton', $newUser->name);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testSendPasswordResetLink(): void
    {
        $this->mockFacadeIfTestingInIsolation('users', function (MockInterface $mock) {
            $mock->shouldReceive('post')
                ->once()
                ->withArgs(static function (string $path) {
                    return (bool) preg_match('/^users\/\w+\/passwordresetlink$/', $path);
                })
                ->andReturnNull();
        });

        Relesys::users()->sendPasswordResetLink(
            '123',
            PasswordResetLinkDeliveryMethod::EMAIL,
            true
        );
    }
}
