<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    protected $policies = [];

    public function boot()
    {
        Gate::define('manage-users', function ($user) {
            return $user->role === 'superadmin';
        });
    }
}
