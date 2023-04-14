<?php

namespace Getsno\Relesys\Tests\Api\UsersManagement;

use Mockery\MockInterface;
use Getsno\Relesys\Tests\TestCase;
use Getsno\Relesys\Api\ApiQueryParams;
use Getsno\Relesys\Facades\RelesysFacade as Relesys;
use Getsno\Relesys\Api\UserManagement\CustomFields;
use Getsno\Relesys\Exceptions\RelesysHttpClientException;
use Getsno\Relesys\Api\UserManagement\Entities\CustomField;

use function Getsno\Relesys\Tests\getDepartmentsResponse;
use function Getsno\Relesys\Tests\getCustomFieldsResponse;

class CustomFieldsTest extends TestCase
{
    public function testCustomFieldsFacade(): void
    {
        $this->mockFacadeIfTestingInIsolation('customFields');

        $this->assertInstanceOf(CustomFields::class, Relesys::customFields());
    }

    /**
     * @throws RelesysHttpClientException
     */
    public function testGetCustomFields(): void
    {
        $this->mockFacadeIfTestingInIsolation('customFields', function (MockInterface $mock) {
            $mock->shouldReceive('get')
                ->once()
                ->withArgs(static fn(string $path, array $params) => $path === 'customfields/users')
                ->andReturn(getCustomFieldsResponse(3));
        });

        $queryParams = (new ApiQueryParams)
            ->limit(5);
        $response = Relesys::customFields()->getCustomFields($queryParams, 2);

        $this->assertIsInt($response->count);
        $this->assertContainsOnlyInstancesOf(CustomField::class, $response->data);
    }
}
