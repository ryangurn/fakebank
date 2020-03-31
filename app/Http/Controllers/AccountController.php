<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    protected $validator = [
        //
    ];

    protected $messages = [
        //
    ];

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $accounts = Account::all();

        return view('accounts.index', compact('accounts'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $banks = Bank::all();

        $variables = ['form' => ['action' => route('account.store'), 'method' => 'POST']];
        return view('accounts.create', compact('banks', 'variables'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Account  $account
    * @return \Illuminate\Http\Response
    */
    public function show(Account $account)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Account  $account
    * @return \Illuminate\Http\Response
    */
    public function edit(Account $account)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Account  $account
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Account  $account
    * @return \Illuminate\Http\Response
    */
    public function destroy(Account $account)
    {
        //
    }
}
