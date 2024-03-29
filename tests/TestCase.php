<?php

namespace Getsno\Relesys\Tests;

use Mockery;
use Getsno\Relesys\HttpClient\HttpClient;
use Getsno\Relesys\RelesysServiceProvider;
use Getsno\Relesys\Api\UserManagement\Users;
use Getsno\Relesys\Api\UserManagement\UserGroups;
use Getsno\Relesys\Api\UserManagement\Departments;
use Getsno\Relesys\Facades\RelesysFacade as Relesys;
use Getsno\Relesys\Api\UserManagement\CustomFields;
use Getsno\Relesys\Api\Communication\Communication;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public const TEST_CLIENT_ID = '00000000-0000-0000-0000-000000000000';
    public const TEST_CLIENT_SECRET = '666';

    protected function getPackageProviders($app): array
    {
        return [
            RelesysServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        // Set relesys config as it's required for Service provider to test via facade
        $clientId = config('relesys.client_id');
        $clientSecret = config('relesys.client_secret');

        if (empty($clientId) && empty($clientSecret)) {
            $app['config']->set('relesys.client_id', self::TEST_CLIENT_ID);
            $app['config']->set('relesys.client_secret', self::TEST_CLIENT_SECRET);
        }
    }

    /**
     * Fake the requests if credentials are missing
     */
    protected function isTestingInIsolation(): bool
    {
        $clientId = config('relesys.client_id');
        $clientSecret = config('relesys.client_secret');

        return $clientId === self::TEST_CLIENT_ID && $clientSecret === self::TEST_CLIENT_SECRET;
    }

    protected function mockFacadeIfTestingInIsolation(string $apiType, ?callable $mockCallback = null): void
    {
        if ($this->isTestingInIsolation()) {
            $relesysHttpClientMock = $this->mock(HttpClient::class, $mockCallback);

            $target = match ($apiType) {
                'users'         => Users::class,
                'departments'   => Departments::class,
                'userGroups'    => UserGroups::class,
                'customFields'  => CustomFields::class,
                'communication' => Communication::class,
            };
            $apiMock = Mockery::mock($target, [$relesysHttpClientMock])->makePartial();

            Relesys::shouldReceive($apiType)
                ->once()
                ->andReturn($apiMock);
        }
    }
}
