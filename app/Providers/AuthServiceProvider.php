<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\Device::class => \App\Policies\DevicePolicy::class,
        \App\Models\User::class => \App\Policies\UserPolicy::class,
        \App\Models\Radio::class => \App\Policies\RadioPolicy::class,
        \App\Models\Network::class => \App\Policies\NetworkPolicy::class,
        \App\Models\Gun::class => \App\Policies\GunPolicy::class,
        \App\Models\Vehicle::class => \App\Policies\VehiclePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
{
        $this->registerPolicies();

        // Define a gate for super admin
        Gate::define('super_admin', function (User $user) {
            return $user->hasRole('super_admin');
        });
        // Define a gate for authenticated users
        Gate::define('authenticated', function (User $user) {
            return $user->exists;
        });
}
}
