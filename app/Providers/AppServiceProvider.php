<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('super_admin', function (User $user) {
            return $user->role == '1';
        });

        Gate::define('admin', function (User $user) {
            return $user->role == '1' || $user->role == '2' || $user->role == '4';
        });

        Gate::define('user', function (User $user) {
            return $user->role == '1' || $user->role == '3' || $user->role == '4';
        });
    }
}
