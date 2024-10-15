<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
// In App\Providers\AuthServiceProvider

    public function boot()
    {
        $this->registerPolicies();

        // Define a gate for librarian roles
        Gate::define('manage-books', function ($user) {
            return $user->is_librarian;
        });
        Gate::define('manage-rentals', function ($user) {
            return $user->is_librarian;  // Assuming 'is_librarian' is a boolean attribute
        });
    }

    
}
