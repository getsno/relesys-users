<?php

namespace Getsno\Relesys\Tests;

use Mockery;
use Getsno\Relesys\HttpClient\HttpClient;
use Getsno\Relesys\RelesysServiceProvider;
use Getsno\Relesys\Api\UserManagement\Users;
use Getsno\Relesys\Facades\RelesysFacade as Relesys;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            RelesysServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        // Set relesys config as it's required for Service provider to test via facade
        $client_id = config('relesys.client_id');
        $client_secret = config('relesys.client_secret');

        if (empty($client_id) && empty($client_secret)) {
            $app['config']->set('relesys.client_id', 'testing');
            $app['config']->set('relesys.client_secret', 'testing');
        }
    }

    /**
     * Fake the requests if credentials are missing
     */
    protected function isTestingInIsolation(): bool
    {
        $client_id = config('relesys.client_id');
        $client_secret = config('relesys.client_secret');

        return $client_id === 'testing' && $client_secret === 'testing';
    }

    protected function mockFacadeIfTestingInIsolation(string $apiType, ?callable $mockCallback = null): void
    {
        $relesysHttpClientMock = $this->mock(HttpClient::class, $mockCallback);
        $usersApiMock = Mockery::mock(Users::class, [$relesysHttpClientMock])->makePartial();

        Relesys::shouldReceive($apiType)
            ->once()
            ->andReturn($usersApiMock);
    }
}
