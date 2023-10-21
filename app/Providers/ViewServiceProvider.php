<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // Using class based composers...
        View::composer(
            ['layouts.app','layouts.landing'],
            'App\Http\View\Composers\FrontComposer'
        );
        View::composer(
            ['layouts.admin'],
            'App\Http\View\Composers\AdminComposer'
        );
    }
}
