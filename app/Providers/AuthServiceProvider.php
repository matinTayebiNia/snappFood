<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Permission;
use App\Policies\OrderPolicy;
use Illuminate\Foundation\Auth\User;
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
//        Order::class => OrderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        Gate::before(fn(User $user) => $user instanceof Admin ? $user->isSuperuser() : false);

        Permission::all()->map(
            fn($item) => Gate::define($item->name,
                fn(User $user) => $user instanceof Admin ?
                    $user->hasPermission($item) :
                    false));

        $this->registerPolicies();

        //
    }
}
