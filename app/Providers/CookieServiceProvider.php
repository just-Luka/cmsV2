<?php

namespace App\Providers;

use App\Traits\AttachableTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class CookieServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if(isset($_COOKIE['lang'])) {
            App::setLocale($_COOKIE['lang']);
        }
    }
}
