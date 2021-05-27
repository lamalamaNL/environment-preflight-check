<?php

namespace Lamalama\PreflightCheck;

use Illuminate\Support\ServiceProvider;
use Lamalama\PreflightCheck\Commands\PreflightCheckCommand;

class PreflightChecksServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/preflight.php' => $this->publishPath('preflight.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                PreflightCheckCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/preflight.php',
            'preflight'
        );
    }

    private function publishPath($configFile)
    {
        if (function_exists('config_path')) {
            return config_path($configFile);
        }

        return base_path('config/' . $configFile);
    }
}
