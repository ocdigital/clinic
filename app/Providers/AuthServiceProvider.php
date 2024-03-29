<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Policies\AdminPolicy;
use App\Policies\AtendentePolicy;
use App\Policies\MedicoPolicy;
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

        Gate::resource('users', AdminPolicy::class);
        Gate::resource('users', MedicoPolicy::class);
        Gate::resource('users', AtendentePolicy::class);
    }
}
