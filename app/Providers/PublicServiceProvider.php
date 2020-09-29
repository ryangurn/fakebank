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
        $bank = Bank::where('settings->status', '=', 'true')->first();
        if ($bank == null) return;

        view()->composer('public.index', function($view) use ($bank){
            $view->with('activeBank', $bank);
        });

        foreach ($bank->template->routes as $route) {
            $view = explode(".", $route->file->storage);
            view()->composer('public.' . $route->template->resource . '.' . strtolower($route->file->type) . 's.' . $view[0], function($view) use ($bank) {
                foreach ($bank->template->variables as $variable) {
                    $view->with($variable->variable, $variable->value);
                }
            });
        }
    }
}
