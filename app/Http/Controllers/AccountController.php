<?php

namespace App\Http\Controllers;

use App\Account;
use App\Bank;
use App\Transaction;
use Exception;
use Faker\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

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

    protected $generateValidator = [
        'account_id' => 'required|exists:accounts,id|integer',
        'count' => 'required|integer'
    ];

    protected $generateMessages = [
        'account_id.required' => 'A bank account is required',
        'account_id.exists' => 'The bank account must already exist',
        'account_id.integer' => 'The bank account is an integer',
        'count.required' => 'The number of transactions is required',
        'count.integer' => 'The count must be an integer'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|Response|View
     */
    public function index()
    {
        $accounts = Account::all();
        return view('account.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|Response|View
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
     * @return RedirectResponse
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
     * @return Application|\Illuminate\Contracts\View\Factory|Response|View
     */
    public function show(Account $account)
    {
        return view('account.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Account $account
     * @return Application|\Illuminate\Contracts\View\Factory|Response|View
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
     * @param Account $account
     * @return RedirectResponse
     */
    public function update(Request $request, Account $account)
    {
        $validator = validator($request->all(), $this->validator, $this->messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $account->bank_id = $request->get('bank_id');
        $account->type = $request->get('type');
        $account->number = $request->get('number');
        $account->balance = $request->get('balance');
        $account->save();

        return redirect()->route('account.index')->with('success', 'Account Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Account $account
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()->route('account.index')->with('success', 'Account Deleted');
    }

    /**
     * Generate transactions given a specific account
     *
     * @param Request $request
     * @param Account $account
     * @return RedirectResponse
     */
    public function generateTransactions(Request $request, Account $account)
    {
        $request->merge(['account_id' => $account->id]);
        $validator = validator($request->all(), $this->generateValidator, $this->generateMessages);

        if ($validator->fails())
        {
            return back()->withErrors($validator);
        }

        for ($i = 0; $i < $request->get('count'); $i++)
        {
            //faker
            $generator = Factory::create();

            $transaction = new Transaction();
            $transaction->account_id = $account->id;
            $transaction->description = $generator->company;
            $transaction->amount = $generator->randomFloat(2, 0.01, 9999.99);
            $transaction->save();

        }

        return redirect()->route('account.index')->with('success', 'Generated '.$request->get('count').' transactions for account.');
    }
}
