<?php

namespace App\Providers;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        // $this->registerPolicies($gate);
        $this->registerPolicies();

        //My gates
        Gate::define('isAdmin',function($user){
            return $user->type === 'admin';
        });

         //User gates
         Gate::define('isUser',function($user){
            return $user->type === 'user';
        });
        // Passport::routes();
        // $gate->define('isAdmin',function($user){
        //     return $user->type == 'admin';
        // });

        
    }
}