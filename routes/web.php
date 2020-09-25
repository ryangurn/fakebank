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

Route::domain('fakebank.test')->group(function(){
    Route::get('/', function () {
        return view('public.index');
    });
});

Route::domain('admin.fakebank.test')->group(function(){
    Auth::routes();

    Route::group(['middleware' => 'auth'], function() {
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
