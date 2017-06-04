<?php

/*
 * This file is part of the osub/laravel-minapp-session.
 *
 * (c) webstar <webstarchina@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Osub\LaravelMinappSession;

use Illuminate\Support\ServiceProvider;

class MinappServiceProvider extends ServiceProvider
{
    /**
     * Application bootstrap event.
     */
    public function boot()
    {
        $rootPath = dirname(__DIR__);

        $this->publishes([
            $rootPath . '/config/minapp.php' => config_path('minapp.php')
        ], 'config');
        
        $datePrefix = date('Y_m_d_His');
        $this->publishes([
            $rootPath . '/database/migrations/create_minapp_info_session_table.php' => database_path("/migrations/{$datePrefix}_create_minapp_info_session_table.php")
        ], 'migrations');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->mergeConfigFrom(dirname(__DIR__).'/config/minapp.php', 'minapp');
        $this->app->singleton(Osub\LaravelMinappSession\Auth\Auth::class, function ($app) {
            return new Auth();
        });
    }
}