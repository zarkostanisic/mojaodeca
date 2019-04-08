<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         Schema::defaultStringLength(191);


         view()->composer(['layouts.app','homepage.index','create','list-page','edit','login','single'],'App\Http\ViewComposers\CategoryViewComposer');
         view()->composer(['homepage.index','create','list-page','edit'],'App\Http\ViewComposers\CountryViewComposer');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
