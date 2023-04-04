<?php

namespace Getsno\Relesys\Tests\Api\UsersManagement;

use Mockery\MockInterface;
use Getsno\Relesys\Tests\TestCase;
use Getsno\Relesys\Api\UserManagement\Departments;
use Getsno\Relesys\Facades\RelesysFacade as Relesys;
use Getsno\Relesys\Exceptions\RelesysHttpClientException;
use Getsno\Relesys\Api\UserManagement\Entities\Department;
use Getsno\Relesys\Api\UserManagement\Enums\DepartmentType;
use Getsno\Relesys\Api\UserManagement\ValueObjects\PhoneNumber;
use Getsno\Relesys\Api\UserManagement\Entities\Patches\DepartmentPatch;

use function Getsno\Relesys\Tests\getUsersResponse;
use function Getsno\Relesys\Tests\getDepartmentResponse;
use function Getsno\Relesys\Tests\createDepartmentResponse;

class DepartmentsTest extends TestCase
{
    public function testDepartmentsFacade(): void
    {
        $this->mockFacadeIfTestingInIsolation('departments');

        $this->assertInstanceOf(Departments::class, Relesys::departments());
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testGetDepartment(): void
    {
        $testDepartmentId = fake()->uuid;

        $this->mockFacadeIfTestingInIsolation(
            'departments',
            static function (MockInterface $mock) use ($testDepartmentId) {
                $mock->shouldReceive('get')
                    ->once()
                    ->with("departments/$testDepartmentId")
                    ->andReturn(getDepartmentResponse($testDepartmentId));
            }
        );

        $department = Relesys::departments()->getDepartment($testDepartmentId);

        $this->assertEquals($testDepartmentId, $department->id);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testGetDepartments(): void
    {
        $this->mockFacadeIfTestingInIsolation('departments', function (MockInterface $mock) {
            $mock->shouldReceive('get')
                ->once()
                ->with('departments')
                ->andReturn(getUsersResponse(3));
        });

        $departments = Relesys::departments()->getDepartments();

        $this->assertIsArray($departments);
        $this->assertContainsOnlyInstancesOf(Department::class, $departments);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testCreateDepartment(): void
    {
        $this->mockFacadeIfTestingInIsolation('departments', function (MockInterface $mock) {
            $mock->shouldReceive('post')
                ->once()
                ->withArgs(static fn(string $path, array $params) => true)
                ->andReturnUsing(static function (string $path, array $params) {
                    return createDepartmentResponse(Department::fromArray($params));
                });
        });

        $department = Department::fromArray([
            'name' => 'Test department',
            'type' => DepartmentType::DEPARTMENT->value,
        ]);
        $newDepartment = Relesys::departments()->createDepartment($department);

        $this->assertEquals('Test department', $newDepartment->name);
        $this->assertEquals(DepartmentType::DEPARTMENT, $newDepartment->type);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testUpdateDepartment(): void
    {
        $this->mockFacadeIfTestingInIsolation('departments', function (MockInterface $mock) {
            $mock->shouldReceive('patch')
                ->once()
                ->withArgs(static fn(string $path, array $params) => true)
                ->andReturnUsing(static function () {
                    return createDepartmentResponse(Department::fromArray(['name' => 'Test department']));
                });
        });

        $departmentPatch = (new DepartmentPatch())
            ->name('Test department')
            ->phoneNumber(PhoneNumber::fromArray(['countryCode' => 47, 'number' => '666666']));
        $department = Relesys::departments()->updateDepartment(fake()->uuid, $departmentPatch);

        $this->assertEquals('Test department', $department->name);
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testDeleteDepartment(): void
    {
        $this->mockFacadeIfTestingInIsolation('departments', function (MockInterface $mock) {
            $mock->shouldReceive('delete')
                ->once()
                ->withArgs(static function (string $path) {
                    return (bool) preg_match('/^departments\/[a-zA-Z0-9_-]+$/', $path);
                })
                ->andReturnNull();
        });

        Relesys::departments()->deleteDepartment(fake()->uuid);
    }
}
