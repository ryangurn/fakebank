<?php

namespace App\Http\Controllers;

use App\Account;
use App\Bank;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    protected $validator = [
        'account_id' => 'required|integer|exists:accounts,id',
        'description' => 'required|min:2|max:255|string',
        'amount' => 'required|numeric'
    ];

    protected $messages = [
        'account_id.required' => 'An account number is required',
        'account_id.integer' => 'An account number is an integer',
        'account_id.exists' => 'The account must already exist',
        'description.required' => 'A transaction description is required',
        'description.min' => 'Description is required to be at least 2 characters',
        'description.max' => 'Description is required to be at max 255 characters',
        'description.string' => 'Description must be a string',
        'amount.required' => 'Transaction amount is required',
        'amount.numeric' => 'Transaction must be numeric',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $transactions = Transaction::where('amount', '>', '0')->orderBy('time', 'desc')->get();

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $variables = ['form' => ['action' => route('transaction.store'), 'method' => 'POST']];
        $accounts = Account::all();
        return view('transactions.create', compact('variables','accounts'));
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

        if($validator->fails()){
            return back()->withErrors($validator);
        }
        Transaction::create([
            'amount' => $request->get('amount'),
            'description' => $request->get('description'),
            'account_id' => $request->get('account_id')
        ]);

        return redirect()->route('transaction.index')->with('success', 'Transaction was created!');
    }

    /**
     * Display the specified resource.
     *
     * @param Transaction $transaction
     * @return Response
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Transaction $transaction
     * @return Response
     */
    public function edit(Transaction $transaction)
    {
        $variables = ['form' => ['action' => route('transaction.update', $transaction->id), 'method' => 'POST', 'hidden' => 'PUT']];
        $accounts = Account::all();
        return view('transactions.update', compact('transaction', 'variables', 'accounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Transaction $transaction
     * @return Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validator = validator($request->all(), $this->validator, $this->messages);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $transaction->account_id = $request->get('account_id');
        $transaction->description = $request->get('description');
        $transaction->amount = $request->get('amount');
        $transaction->save();

        return redirect()->route('transaction.index')->with('success', 'Transaction Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Transaction $transaction
     * @return Response
     * @throws \Exception
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transaction.index')->with('success', 'Transaction Deleted');
    }
}
