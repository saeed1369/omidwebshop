<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // using class base composer
        View::composer('profile','App\Http\View\Composer\ProfileComposer');

        //using closure base composer
        View::composer('dashboadr', function($view) {
            //
        });
    }
}
