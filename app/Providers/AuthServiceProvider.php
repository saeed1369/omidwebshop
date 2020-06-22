<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\postpolicy;
use App\Post;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
		Post::class =>postpolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // define a gate
        Gate::define('edit-setting', function($user){
            return $user->id;
        });

        Gate::define('update-post',function($user,$post){
            return $user->id === $post->user_id;
            // if we want to return else true or false we use response
           // return $user->isAdmin()? Response::allow() : Response::deny("you must administrator"); 
        });
		

        //
    }
}
