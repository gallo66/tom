<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class Ka2ServiceProvider extends ServiceProvider
{

    protected $index = 0;

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
        View::composer('Ka2.index','App\Http\Composers\Ka2Composer');

    }
}
