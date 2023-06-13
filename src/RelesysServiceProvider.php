<?php

namespace Getsno\Relesys;

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;
use Getsno\Relesys\Exceptions\RelesysException;
use Getsno\Relesys\HttpClient\HttpClient;

class RelesysServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/relesys.php' => config_path('relesys.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/relesys.php', 'relesys');

        // Register the main class to use with the facade
        $this->app->singleton('relesys.users', static function () {
            $clientId = config('relesys.client_id');
            $clientSecret = config('relesys.client_secret');

            /** @noinspection NotOptimalIfConditionsInspection */
            if (!Str::isUuid($clientId) || empty($clientSecret)) {
                throw RelesysException::invalidAuthCredentials();
            }

            return new Relesys(new HttpClient($clientId, $clientSecret));
        });
    }
}
