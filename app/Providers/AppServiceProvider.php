<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $account = request('account');

        Config::set('database.connections.account', array_merge(
            Config::get('database.connections.' . Config::get('database.default')),
            ['database'  => $account]
        ));
    }
}
