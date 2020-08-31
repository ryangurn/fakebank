<?php

namespace App\Http\Controllers;

use App\Account;
use App\Bank;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccountController extends Controller
{
    protected $validator = [
        'bank_id' => 'required|exists:banks,id|integer',
        'type' => 'required|in:0,1,2|integer',
        'number' => 'required|numeric',
        'balance' => 'required|numeric',
    ];

    protected $messages = [
        'bank_id.required' => 'A bank account is required',
        'bank_id.integer' => 'A bank account is an integer',
        'bank_id.exists' => 'The bank account must already exist',
        'type.required' => 'The account type is required',
        'type.in' => 'The type must be one of the following: Checking, Saving, or Credit Card',
        'type.integer' => 'The type must be an integer',
        'number.required' => 'A bank account number is required',
        'number.numeric' => 'A bank account must be a numeric value',
        'balance.required' => 'A bank account balance is required',
        'balance.numeric' => 'A bank account balance must be numeric',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $accounts = Account::all();
        return view('account.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $variables = ['form' => ['action' => route('account.store'), 'method' => 'POST']];
        $banks = Bank::all();
        return view('account.create', compact('variables', 'banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), $this->validator, $this->messages);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        Account::create([
            'bank_id' => $request->get('bank_id'),
            'type' => $request->get('type'),
            'number' => $request->get('number'),
            'balance' => $request->get('balance'),
        ]);

        return redirect()->route('account.index')->with('success', 'Account was created!');
    }

    /**
     * Display the specified resource.
     *
     * @param Account $account
     * @return Response
     */
    public function show(Account $account)
    {
        return view('account.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Account $account)
    {
        $variables = ['form' => ['action' => route('account.update', $account->id), 'method' => 'POST', 'hidden' => 'PUT']];
        $banks = Bank::all();
        return view('account.update', compact('account', 'variables', 'banks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
