<?php

namespace App\Http\Controllers;

use App\Bank;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class BankController extends Controller
{
    protected $validator = [
        'name' => 'required|min:2|max:255|string',
        'caption' => 'required|min:2|max:255|string',
        'trolls' => 'nullable|json'
    ];

    protected $messages = [
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
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $banks = Bank::all();

        return view('bank.index', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $variables = ['form' => ['action' => route('bank.store'), 'method' => 'POST']];
        return view('bank.create', compact('variables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // ensure that the submitted form fields are validated
        // properly, while this is meant to be a trolly system
        // i still want to ensure the admin system is completely
        // secure

        $validator = validator($request->all(), $this->validator, $this->messages);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $settings = [
            'status' => false
        ];
        Bank::create([
            'name' => $request->get('name'),
            'caption' => $request->get('caption'),
            'trolls' => $request->get('trolls'),
            'settings' => $settings
        ]);

        return redirect()->route('bank.index')->with('success', 'Bank was created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Bank  $bank
     * @return Response
     */
    public function show(Bank $bank)
    {
        return view('bank.show', compact('bank'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Bank $bank
     * @return Response
     */
    public function edit(Bank $bank)
    {
        $variables = ['form' => ['action' => route('bank.update', $bank->id), 'method' => 'POST', 'hidden' => 'PUT']];
        return view('bank.update', compact('variables', 'bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Bank $bank
     * @return Response
     */
    public function update(Request $request, Bank $bank)
    {
        $validator = validator($request->all(), $this->validator, $this->messages);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $bank->name = $request->get('name');
        $bank->caption = $request->get('caption');
        $bank->trolls = $request->get('trolls');
        $bank->save();

        return redirect()->route('bank.show', $bank->id)->with('success', 'Bank Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Bank $bank
     * @return Response
     * @throws Exception
     */
    public function destroy(Bank $bank)
    {
        $bank->delete();
        return redirect()->route('bank.index')->with('success', 'Bank Deleted');
    }

    /**
     * @param Request $request
     * @param Bank $bank
     */
    public function status(Request $request, Bank $bank){
        $validator = validator($request->all(), [
            'operation' => 'required|in:enable,disable'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }


    }


}
