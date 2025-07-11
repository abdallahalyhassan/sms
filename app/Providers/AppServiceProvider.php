<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::define("is_admin", function () {
            return Auth::user()->role === "admin";
        });
        Gate::define("is_teacher", function () {
            return Auth::user()->role === "teacher";
        });
        Gate::define("is_student", function () {
            return Auth::user()->role === "student";
        });
        Gate::define("is_or_admin_teacher", function () {
            return in_array(Auth::user()->role, ['teacher', 'admin']);
        });
    }
}
