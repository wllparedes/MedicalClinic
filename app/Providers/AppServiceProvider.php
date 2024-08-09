<?php

namespace App\Providers;

use App\Models\Patient;
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
        Gate::define('allowAdmin', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('allowReceptionist', function ($user) {
            return $user->role === 'receptionist';
        });

        Gate::define('allowDoctor', function ($user) {
            return $user->role === 'doctor';
        });

        Gate::define('allowPatientPending', function ($user, Patient $patient) {
            return $patient->status === 'pending';
        });
    }
}
