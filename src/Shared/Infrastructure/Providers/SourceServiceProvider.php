<?php

namespace App\Src\Shared\Infrastructure\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class SourceServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'sms');
    }

    public function boot()
    {
        $migrationPath = $this->basePath('Database/migrations');
        $this->loadMigrationsFrom($migrationPath);
        $this->publishes([$migrationPath => database_path('migrations')], 'migrations');
        $seederPath = $this->basePath('database/seeds');
        $this->publishes([$seederPath => database_path('seeds')], 'seeds');

        $configPath = $this->basePath('Config/setting.php');
        $this->publishes([$configPath => config_path('setting.php')], 'config');
        $this->mergeConfigFrom($configPath, 'setting');


        $this->commands([

        ]);
    }

    protected function basePath($path = '')
    {
        return __DIR__ . '/../' . $path;
    }
}
