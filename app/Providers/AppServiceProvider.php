<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    Gate::define('shipments.shipments', function (User $user) {
            return $user->isCustomer()
                ? Response::allow()
                : Response::denyAsNotFound();
       });


       Gate::define('admin.admin', function (User $user) {
            return $user->isAdmin()
                ? Response::allow()
                : Response::denyAsNotFound();
       });

        Gate::define('driver.driverDashboard', function (User $user) {
            return $user->isDriver()
                ? Response::allow()
                : Response::denyAsNotFound();
       });
    }
}
