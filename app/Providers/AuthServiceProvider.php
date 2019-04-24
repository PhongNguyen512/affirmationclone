<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Category' => 'App\Policies\AdminPolicy',
        'App\GroupItem' => 'App\Policies\AdminPolicy',
        'App\Item' => 'App\Policies\AdminPolicy',
        'App\SubItem' => 'App\Policies\AdminPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Leave it comment at this time
        //This is check if the condition is true.
        //It will keep all of the rest policy
        // Gate::before(function($user){
        //     return $user->role == 'super_admin';
        // });
    }
}
