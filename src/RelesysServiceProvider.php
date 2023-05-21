<?php

namespace Getsno\Relesys;

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
                __DIR__.'/../config/relesys.php' => config_path('relesys.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/relesys.php', 'relesys');

        // Register the main class to use with the facade
        $this->app->singleton('relesys.users', static function () {
            $client_id = config('relesys.client_id');
            $client_secret = config('relesys.client_secret');
            if (empty($client_id) || empty($client_secret)) {
                throw RelesysException::invalidAuthCredentials();
            }

            return new Relesys(new HttpClient($client_id, $client_secret));
        });
    }
}
