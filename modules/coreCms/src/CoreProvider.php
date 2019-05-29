<?php

namespace Cms\Core;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class CoreProvider extends ServiceProvider {

    /**
     * Seeds to register
     *
     * @var array
     */
    protected $seeds = [
    ];

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Cms\Core';

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map(): void {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void {
        $this->publishes([
            __DIR__ . '/public/assets' => public_path('admin'),
                ], 'public');
        
        parent::boot();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->mergeConfigFrom(__DIR__ . '/Config/corecms.php', 'corecms');
        $this->loadViewsFrom(__DIR__ . '/Resources/views', 'cms');
        parent::register();
    }

}
