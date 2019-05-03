<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();
        $this->registerPermissions();
    }

    /**
     * Wczytanie updarwniej do guarda - gate
     */
    public function registerPermissions() {
//        $premissions = \App\User::getPremissions();
//        foreach ($premissions as $module => $premission) {
//            foreach ($premission as $action) {
//                $gateName = $module . '.' . $action;
//                Gate::define($gateName, function ($user) use ($gateName) {
//                    return $user->hasAccess($gateName);
//                });
//            }
//        }
    }

}
