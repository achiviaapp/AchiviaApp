<?php

namespace App\Providers;

use App\Models\Action;
use Illuminate\Support\ServiceProvider;

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
        view()->composer('layouts/aside', function ($view) {
            $list = Action::where('active', 1)->orderBy('order')->get()->toArray();
            $view->with('list', $list);
        });
        view()->composer('web/layouts/aside', function ($view) {
            $list = Action::where('active', 1)->orderBy('order')->get()->toArray();
            $view->with('list', $list);
        });
    }
}
