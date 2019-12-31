<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
//Policies
use App\Policies\BookPolicy;
use App\Policies\ReviewPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         '\App\Book::class' => 'BookPolicy::class',
         '\App\Review::class' => 'ReviewPolicy::class',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Passport
        Passport::routes();

        // Gates 
        // Authorizes some methods to only be accessed by admin users
        Gate::define('isAdmin', function ($user) {
            return $user->role == "admin";
        });

        // Authorizes authenticated user to modify his account
        Gate::define('isAccountOwner', function ($user) {
            return $user->id == auth()->user()->id;
        });
    }
}
