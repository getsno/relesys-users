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
