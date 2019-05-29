<?php

namespace Cms\Roles;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use RoleCms\Service\RoleCmsChecker as Check;
use Illuminate\Support\Facades\Gate;

class RolesProvider extends ServiceProvider {

    /**
     * Seeds to register
     *
     * @var array
     */
    protected $seeds = [
        'RolesTableSeeder' => RolesTableSeeder::class
    ];

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = '\Cms\Roles\Http\Controllers';

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map(): void {
//        \Route::prefix('web')
//                ->namespace($this->namespace)
//                ->group(__DIR__ . '/../routes/web.php');
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

        $this->commands(Commands\BuildTable::class);
        $this->mergeConfigFrom(__DIR__ . '/Config/rolecms.php', 'rolecms');
        $this->loadViewsFrom(__DIR__ . '/Resources/views', 'roles');
        $this->registerGates();

        parent::register();
    }

    public function registerGates() {

        foreach (config('rolecms.abilities') as $module => $actions) {

            foreach ($actions as $action) {

                $ability = $module . '.' . $action;

                Gate::define($ability, function ($user) use($ability) {
                    return $user->hasAccess($ability) ?: false;
                });
            }
        }
    }

}
