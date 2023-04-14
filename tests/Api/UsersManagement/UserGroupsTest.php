<?php

namespace Getsno\Relesys\Tests\Api\UsersManagement;

use Mockery\MockInterface;
use Getsno\Relesys\Tests\TestCase;
use Getsno\Relesys\Api\BatchResponse;
use Getsno\Relesys\Api\ApiQueryParams;
use Getsno\Relesys\Api\UserManagement\UserGroups;
use Getsno\Relesys\Facades\RelesysFacade as Relesys;
use Getsno\Relesys\Exceptions\RelesysHttpClientException;
use Getsno\Relesys\Api\UserManagement\Entities\UserGroup;
use Getsno\Relesys\Api\UserManagement\Entities\Patches\UserGroupPatch;

use function Getsno\Relesys\Tests\getUserGroupResponse;
use function Getsno\Relesys\Tests\getUserGroupsResponse;
use function Getsno\Relesys\Tests\createUserGroupResponse;

class UserGroupsTest extends TestCase
{
    public function testUserGroupsFacade(): void
    {
        $this->mockFacadeIfTestingInIsolation('userGroups');

        $this->assertInstanceOf(UserGroups::class, Relesys::userGroups());
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testGetUserGroup(): void
    {
        $testUserGroupId = fake()->uuid;

        $this->mockFacadeIfTestingInIsolation(
            'userGroups',
            static function (MockInterface $mock) use ($testUserGroupId) {
                $mock->shouldReceive('get')
                    ->once()
                    ->with("userGroups/$testUserGroupId")
                    ->andReturn(getUserGroupResponse($testUserGroupId));
            }
        );

        $userGroup = Relesys::userGroups()->getUserGroup($testUserGroupId);

        $this->assertEquals($testUserGroupId, $userGroup->id);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testGetUserGroups(): void
    {
        $this->mockFacadeIfTestingInIsolation('userGroups', function (MockInterface $mock) {
            $mock->shouldReceive('get')
                ->once()
                ->withArgs(static fn(string $path, array $params) => $path === 'userGroups')
                ->andReturn(getUserGroupsResponse(3));
        });

        $queryParams = (new ApiQueryParams)
            ->sortBy('name')
            ->limit(5);
        $response = Relesys::userGroups()->getUserGroups($queryParams, 2);

        $this->assertIsInt($response->count);
        $this->assertContainsOnlyInstancesOf(UserGroup::class, $response->data);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testCreateUserGroup(): void
    {
        $this->mockFacadeIfTestingInIsolation('userGroups', function (MockInterface $mock) {
            $mock->shouldReceive('post')
                ->once()
                ->withArgs(static fn(string $path, array $params) => true)
                ->andReturnUsing(static function (string $path, array $params) {
                    return createUserGroupResponse(UserGroup::fromArray($params));
                });
        });

        $userGroup = UserGroup::fromArray([
            'name'        => 'Test userGroup',
            'description' => 'Test description',
        ]);
        $newUserGroup = Relesys::userGroups()->createUserGroup($userGroup);

        $this->assertEquals($userGroup->name, $newUserGroup->name);
        $this->assertEquals($userGroup->description, $newUserGroup->description);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testUpdateUserGroup(): void
    {
        $this->mockFacadeIfTestingInIsolation('userGroups', function (MockInterface $mock) {
            $mock->shouldReceive('patch')
                ->once()
                ->withArgs(static fn(string $path, array $params) => true)
                ->andReturnUsing(static function () {
                    return createUserGroupResponse(
                        UserGroup::fromArray([
                            'name'        => 'Test userGroup',
                            'description' => 'Test description',
                        ])
                    );
                });
        });

        $userGroupPatch = (new UserGroupPatch())
            ->name('Test userGroup')
            ->description('Test description');
        $userGroup = Relesys::userGroups()->updateUserGroup(fake()->uuid, $userGroupPatch);

        $this->assertEquals('Test userGroup', $userGroup->name);
        $this->assertEquals('Test description', $userGroup->description);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testDeleteDepartment(): void
    {
        $this->mockFacadeIfTestingInIsolation('userGroups', function (MockInterface $mock) {
            $mock->shouldReceive('delete')
                ->once()
                ->withArgs(static function (string $path) {
                    return (bool) preg_match('/^userGroups\/[a-zA-Z0-9_-]+$/', $path);
                })
                ->andReturnNull();
        });

        Relesys::userGroups()->deleteUserGroup(fake()->uuid);
    }
}
