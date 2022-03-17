<?php

namespace Larog\Larog;

use Illuminate\Support\ServiceProvider;
use Larog\Larog\Commands\InstallCommand;

class LarogServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '../config/config.php', 'larog');

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }


        parent::register();
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '../config/config.php' => config_path('larog.php')
            ], 'config');
        }
    }

}
