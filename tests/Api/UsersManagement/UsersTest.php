<?php

namespace Getsno\Relesys\Tests\Api\UsersManagement;

use Carbon\Carbon;
use Mockery\MockInterface;
use Getsno\Relesys\Tests\TestCase;
use Getsno\Relesys\Api\ApiQueryParams;
use Getsno\Relesys\Api\UserManagement\Users;
use Getsno\Relesys\Facades\RelesysFacade as Relesys;
use Getsno\Relesys\Api\UserManagement\Entities\User;
use Getsno\Relesys\Api\UserManagement\Enums\UserStatus;
use Getsno\Relesys\Exceptions\RelesysHttpClientException;
use Getsno\Relesys\Api\UserManagement\ValueObjects\PhoneNumber;
use Getsno\Relesys\Api\UserManagement\Entities\Patches\UserPatch;
use Getsno\Relesys\Api\UserManagement\Enums\PasswordResetLinkDeliveryMethod;

use function Getsno\Relesys\Tests\getUserResponse;
use function Getsno\Relesys\Tests\getUsersResponse;
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
        $testUserId = fake()->uuid;

        $this->mockFacadeIfTestingInIsolation(
            'users',
            static function (MockInterface $mock) use ($testUserId) {
                $mock->shouldReceive('get')
                    ->once()
                    ->with("users/$testUserId")
                    ->andReturn(getUserResponse($testUserId));
            }
        );

        $user = Relesys::users()->getUser($testUserId);

        $this->assertEquals($testUserId, $user->id);
        $this->assertEquals(UserStatus::Activated->value, $user->status->value);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testGetUsers(): void
    {
        $this->mockFacadeIfTestingInIsolation('users', function (MockInterface $mock) {
            $mock->shouldReceive('get')
                ->once()
                ->withArgs(static fn(string $path, array $params) => $path === 'users')
                ->andReturn(getUsersResponse(3));
        });

        $queryParams = (new ApiQueryParams)
            ->sortBy('name')
            ->limit(5);
        $response = Relesys::users()->getUsers($queryParams, 2);

        $this->assertIsInt($response->count);
        $this->assertContainsOnlyInstancesOf(User::class, $response->data);
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
            'primaryDepartmentId' => fake()->uuid,
            'phoneNumber'         => [
                'countryCode' => 47,
                'number'      => '46700524',
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
                    return (bool) preg_match('/^users\/[a-zA-Z0-9_-]+\/passwordresetlink$/', $path);
                })
                ->andReturnNull();
        });

        Relesys::users()->sendPasswordResetLink(
            fake()->uuid,
            PasswordResetLinkDeliveryMethod::Email,
            true
        );
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testSendSms(): void
    {
        $this->mockFacadeIfTestingInIsolation('users', function (MockInterface $mock) {
            $mock->shouldReceive('post')
                ->once()
                ->withArgs(static function (string $path) {
                    return (bool) preg_match('/^users\/[a-zA-Z0-9_-]+\/sms$/', $path);
                })
                ->andReturnNull();
        });

        Relesys::users()->sendSms(
            fake()->uuid,
            'Test SMS message'
        );
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testUpdateUser(): void
    {
        $this->mockFacadeIfTestingInIsolation('users', function (MockInterface $mock) {
            $mock->shouldReceive('patch')
                ->once()
                ->withArgs(static fn(string $path, array $params) => true)
                ->andReturnUsing(static fn() => createUserResponse(User::fromArray(['title' => 'Cyber god'])));
        });

        $userPatch = (new UserPatch())
            ->title('Cyber god')
            ->birthDate(Carbon::parse('05-02-1991'))
            ->secondaryPhoneNumber(PhoneNumber::fromArray(['countryCode' => 47, 'number' => 777777]));
        $user = Relesys::users()->updateUser(fake()->uuid, $userPatch);

        $this->assertEquals('Cyber god', $user->title);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testChangeUserStatus(): void
    {
        $this->mockFacadeIfTestingInIsolation('users', function (MockInterface $mock) {
            $mock->shouldReceive('put')
                ->once()
                ->withArgs(static function (string $path) {
                    return (bool) preg_match('/^users\/[a-zA-Z0-9_-]+\/status$/', $path);
                })
                ->andReturnNull();
        });

        Relesys::users()->changeUserStatus(
            fake()->uuid,
            UserStatus::Activated
        );
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testDeleteUser(): void
    {
        $this->mockFacadeIfTestingInIsolation('users', function (MockInterface $mock) {
            $mock->shouldReceive('delete')
                ->once()
                ->withArgs(static fn(string $path) => (bool) preg_match('/^users\/[a-zA-Z0-9_-]+$/', $path))
                ->andReturnNull();
        });

        Relesys::users()->deleteUser(fake()->uuid);
    }
}
