<?php

namespace Cms\Persons;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class Provider extends ServiceProvider {

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
    protected $namespace = '\Cms\Persons\Http\Controllers';

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

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        parent::boot();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->loadViewsFrom(__DIR__ . '/Resources/views', 'persons');
        parent::register();
    }


}
