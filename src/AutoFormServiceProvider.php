<?php

namespace Tecdrip\LaravelAutoForm;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AutoFormServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        Config::set('breadcrumbs.view', 'breadcrumbs::bootstrap5');

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'autoform');
        $this->publishes([
            __DIR__.'/config/autoform.php' => config_path('autoform.php'),
        ]);
    }
}
