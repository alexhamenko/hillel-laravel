<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('access-admin-panel', function (User $user) {
            return in_array($user->role_name->value, ['super_admin', 'admin', 'author', 'viewer']);
        });

        Gate::define('access-paid-functionality', function (User $user) {
            return in_array($user->role_name->value, ['super_admin', 'paid_user']);
        });
    }
}
