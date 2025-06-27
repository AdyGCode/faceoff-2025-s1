<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use App\Policies\v1\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class, // Add this line
    ];

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
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });

        /**
         * Scramble Docs Access for Hosted site
         * using 'viewApiDocs'
         * 
         * Allowed Access for:
         * - Super Admin
         * - Admin
         * - & Staff
         */
        Gate::define('viewApiDocs', function ($user) {
            return $user->hasRole('Super Admin') || $user->hasRole('Admin') || $user->hasRole('Staff');
        });

        Paginator::useBootstrap();
    }
}
