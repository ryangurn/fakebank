<?php

namespace App\Providers;

use App\Account;
use App\Bank;
use App\Template;
use App\Transaction;
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
        view()->composer('layouts.app', function($view){
            $bankCount = Bank::all()->count();
            $accountCount = Account::all()->count();
            $transactionCount = Transaction::all()->count();
            $templates = Template::all();
            $view->with('templates', $templates);
            $view->with('bankCount', $bankCount);
            $view->with('accountCount', $accountCount);
            $view->with('transactionCount', $transactionCount);
        });
    }
}
