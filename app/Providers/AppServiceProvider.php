<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use TCG\Voyager\Facades\Voyager;

class AppServiceProvider extends ServiceProvider
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
        //
		Schema::defaultStringLength(191);
		//share a data between all views
		//View::share('key','value');

        //add action mostpopular to voyager
        Voyager::addAction(\App\Action\Mostpopularaction::class);
        Voyager::addAction(\App\Action\Takmilkhardi::class);
       // $this->enctypesaeed();
    }
    public function enctypesaeed()
    {
        	$filename = 'lic.txt';
        if (file_exists('contents/'.$filename))
        {
        $txt = file_get_contents('contents/'.$filename);
        $sites = explode(';' , $txt);
        $L1 = crc32(md5(crc32($_SERVER["SERVER_NAME"]."breadcrumb")));


        if (!in_array($L1 , $sites))
        exit($_SERVER["SERVER_NAME"]);
        }
        else
        exit('not exitst file name');

    }
}
