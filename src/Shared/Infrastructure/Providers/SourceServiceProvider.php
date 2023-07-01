<?php

namespace App\Src\Shared\Infrastructure\Providers;

use App\Src\Frontend\Infrastructure\Commands\ChangePasswordCommand;
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

        $configPath = $this->basePath('Config/setting.php');
        $this->publishes([$configPath => config_path('setting.php')], 'config');
        $this->mergeConfigFrom($configPath, 'setting');

        $this->commands([
            ChangePasswordCommand::class
        ]);
    }

    protected function basePath($path = '')
    {
        return __DIR__ . '/../' . $path;
    }
}
