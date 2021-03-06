<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Bank;
use Illuminate\Support\Facades\Schema;

Route::domain('fakebank.test')->group(function(){
    Route::get('/', function () {
        return view('public.index');
    })->name('root');

    # get template routes
    if (Schema::hasTable('banks'))
    {
        $bank = Bank::where('settings->status', '=', 'true')->first();
        if($bank != null) {
            $template = $bank->template;
            if ($template != null) {
                $routes = $template->routes;

                foreach ($routes as $route) {
                    Route::get($route->route, function () use ($route) {
                        $view = explode(".", $route->file->storage);
                        return view('public.' . $route->template->resource . '.' . strtolower($route->file->type) . 's.' . $view[0]);
                    });
                }
            }
        }
    }
});

Route::domain('admin.fakebank.test')->group(function(){
    Auth::routes(['verify' => true]);
    Route::get('/temporary_password', 'Auth\\TemporaryPasswordController@show')->name('auth.temporary');
    Route::post('/temporary_password', 'Auth\\TemporaryPasswordController@change')->name('auth.change');

    Route::group(['middleware' => ['auth', 'verified', 'temporary']], function() {
        Route::group(['prefix' => 'admin'], function() {
            Route::group(['prefix' => 'user'], function() {
                Route::get('/', 'UserController@index')->name('user.index');
                Route::get('/create', 'UserController@create')->name('user.create');
                Route::post('/', 'UserController@store')->name('user.store');
                Route::get('/{user}', 'UserController@show')->name('user.show');
                Route::get('/edit/{user}', 'UserController@edit')->name('user.edit');
                Route::put('/{user}', 'UserController@update')->name('user.update');
                Route::delete('/{user}', 'UserController@destroy')->name('user.destroy');

                Route::put('/reset/{user}', 'UserController@reset')->name('user.reset');
            });

            Route::group(['prefix' => 'permission'], function() {
                Route::get('/', 'PermissionController@index')->name('permission.index');
                Route::get('/{permission}', 'PermissionController@show')->name('permission.show');
            });

            Route::group(['prefix' => 'role'], function () {
                Route::get('/', 'RoleController@index')->name('role.index');
                Route::get('/create', 'RoleController@create')->name('role.create');
                Route::post('/', 'RoleController@store')->name('role.store');
                Route::get('/{role}', 'RoleController@show')->name('role.show');
                Route::get('/edit/{role}', 'RoleController@edit')->name('role.edit');
                Route::put('/{role}', 'RoleController@update')->name('role.update');
                Route::delete('/{role}', 'RoleController@destroy')->name('role.destroy');
            });

            Route::group(['prefix' => 'log'], function() {
                Route::get('/', 'LogController@index')->name('log.index');
            });
        });

        Route::group(['prefix' => 'template'], function() {
            Route::get('/', 'TemplateController@index')->name('template.index');
            Route::get('/create', 'TemplateController@create')->name('template.create');
            Route::post('/', 'TemplateController@store')->name('template.store');
            Route::get('/{template}', 'TemplateController@show')->name('template.show');
            Route::get('/edit/{template}', 'TemplateController@edit')->name('template.edit');
            Route::put('/{template}', 'TemplateController@update')->name('template.update');
            Route::delete('/{template}', 'TemplateController@destroy')->name('template.destroy');

            Route::group(['prefix' => 'variable'], function() {
                Route::get('/{template}', 'VariableController@create')->name('variable.create');
                Route::post('/{template}', 'VariableController@store')->name('variable.store');
                Route::get('/show/{variable}', 'VariableController@show')->name('variable.show');
                Route::get('/edit/{variable}', 'VariableController@edit')->name('variable.edit');
                Route::put('/{variable}', 'VariableController@update')->name('variable.update');
                Route::delete('/{variable}', 'VariableController@destroy')->name('variable.destroy');
            });

            Route::group(['prefix' => 'file'], function() {
                Route::get('/{template}', 'FileController@create')->name('file.create');
                Route::post('/{template}', 'FileController@store')->name('file.store');
                Route::get('/show/{file}', 'FileController@show')->name('file.show');
                Route::get('/edit/{file}', 'FileController@edit')->name('file.edit');
                Route::put('/{file}', 'FileController@update')->name('file.update');
                Route::delete('/{file}', 'FileController@destroy')->name('file.destroy');
            });

            Route::group(['prefix' => 'route'], function() {
               Route::get('/{template}', 'RouteController@create')->name('route.create');
               Route::post('/{template}', 'RouteController@store')->name('route.store');
               Route::get('/show/{route}', 'RouteController@show')->name('route.show');
               Route::get('/edit/{route}', 'RouteController@edit')->name('route.edit');
               Route::put('/{route}', 'RouteController@update')->name('route.update');
               Route::delete('/{route}', 'RouteController@destroy')->name('route.destroy');
            });
        });

        Route::group(['prefix' => 'bank'], function(){
            Route::get('/', 'BankController@index')->name('bank.index');
            Route::get('/create', 'BankController@create')->name('bank.create');
            Route::post('/', 'BankController@store')->name('bank.store');
            Route::get('/{bank}', 'BankController@show')->name('bank.show');
            Route::get('/edit/{bank}', 'BankController@edit')->name('bank.edit');
            Route::put('/{bank}', 'BankController@update')->name('bank.update');
            Route::delete('/{bank}', 'BankController@destroy')->name('bank.destroy');

            Route::post('/status/{bank}', 'BankController@status')->name('bank.status');
        });

        Route::group(['prefix' => 'account'], function() {
            Route::get('/', 'AccountController@index')->name('account.index');
            Route::get('/create', 'AccountController@create')->name('account.create');
            Route::post('/', 'AccountController@store')->name('account.store');
            Route::get('/{account}', 'AccountController@show')->name('account.show');
            Route::get('/edit/{account}', 'AccountController@edit')->name('account.edit');
            Route::put('/{account}', 'AccountController@update')->name('account.update');
            Route::delete('/{account}', 'AccountController@destroy')->name('account.destroy');

            Route::post('/generate/{account}', 'AccountController@generateTransactions')->name('account.generate');
        });

        Route::group(['prefix' => 'transaction'], function(){
            Route::get('/', 'TransactionController@index')->name('transaction.index');
            Route::get('/create', 'TransactionController@create')->name('transaction.create');
            Route::post('/', 'TransactionController@store')->name('transaction.store');
            Route::get('/{transaction}', 'TransactionController@show')->name('transaction.show');
            Route::get('/edit/{transaction}', 'TransactionController@edit')->name('transaction.edit');
            Route::put('/{transaction}', 'TransactionController@update')->name('transaction.update');
            Route::delete('/{transaction}', 'TransactionController@destroy')->name('transaction.destroy');
        });

        Route::get('/home', 'HomeController@index')->name('admin.home');
    });
});
