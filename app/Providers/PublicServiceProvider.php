<?php

namespace App\Providers;

use App\Bank;
use Illuminate\Support\ServiceProvider;

class PublicServiceProvider extends ServiceProvider
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
        view()->composer('public.index', function($view){
            $activeBank = Bank::where('settings->status', '=', 'true')->first();
            $view->with('activeBank', $activeBank);
        });
    }
}
