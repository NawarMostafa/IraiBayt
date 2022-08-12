<?php

namespace App\Providers;

use App\Depart;
use App\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
//use App\Passport\Passport;
use Illuminate\Support\Facades\Schema;

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
        View::share('setting',Setting::first());
        View::share('departs',Depart::all());
        Schema::defaultStringLength(191);

    }
}
