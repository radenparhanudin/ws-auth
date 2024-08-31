<?php

namespace Radenparhanudin\WsAuth;

use Illuminate\Support\ServiceProvider;
use Radenparhanudin\WsAuth\Services\LoginService;
use Radenparhanudin\WsAuth\Services\ResponseJsonService;

class WSAuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        /* Load Config */
        $this->mergeConfigFrom(__DIR__ . '/../config/ws-auth.php', 'ws-auth');

        /* Register Servcie */
        $this->app->singleton('response-json', function ($app) {
            return new ResponseJsonService();
        });

        $this->app->singleton('login', function ($app) {
            return new LoginService();
        });

        // Publikasikan file konfigurasi
        $this->publishes([
            __DIR__ . '/../publish/app/Models/Role.php' => app_path('Models/Role.php'),
        ], 'models');
        $this->publishes([
            __DIR__ . '/../publish/config/permission.php' => config_path('permission.php'),
        ], 'config');
        $this->publishes([
            __DIR__ . '/../publish/database/migrations' => database_path('migrations'),
        ], 'migrations');
        $this->publishes([
            __DIR__ . '/../publish/database/seeders' => database_path('seeders'),
        ], 'seeders');
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
