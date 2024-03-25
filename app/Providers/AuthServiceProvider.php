<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Permission;
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
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Permission::with('roles')->each(function ($permission) {
            Gate::define($permission->name, function ($user) use ($permission) {
                // !! این علامت خروجی رو به بولی تبدیل می کند
                return !!$permission->roles->intersect($user->roles)->count();
            });
        });
    }
}
