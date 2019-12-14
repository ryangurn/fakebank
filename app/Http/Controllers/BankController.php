<?php

namespace App\Http\Controllers;

use App\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::all();

        return view('bank.index', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $variables = ['form' => ['action' => route('bank.store'), 'method' => 'POST']];
        return view('bank.create', compact('variables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ensure that the submitted form fields are validated
        // properly, while this is meant to be a trolly system
        // i still want to ensure the admin system is completely
        // secure

        $validator = validator($request->all(), [
            'name' => 'required|min:2|max:255|string',
            'caption' => 'required|min:2|max:255|string',
            'trolls' => 'nullable|json'
        ], [
            'name.required' => 'A bank name is required',
            'name.min' => 'A bank\'s name must be more than 2 characters',
            'name.max' => 'A bank\'s name must be less than 255 characters',
            'name.string' => 'Why are you sending the wrong data type for the name? This must be a string!',
            'caption.required' => 'A bank caption is required',
            'caption.min' => 'A bank\'s caption must be more than 2 characters',
            'caption.max' => 'A bank\'s caption must be less than 255 characters',
            'caption.string' => 'Why are you sending the wrong data type for the caption? This must be a string!',
            'trolls.nullable' => 'The trolls field must be nullable or a json object.',
            'trolls.json' => 'The trolls field must be a valid json object.'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $settings = [
            'status' => false
        ];
        Bank::create([
            'name' => $request->get('name'),
            'caption' => $request->get('caption'),
            'trolly' => $request->get('trolly'),
            'settings' => $settings
        ]);

        return redirect()->route('bank.index')->with('success', 'Bank was created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        return view('bank.show', compact('bank'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
