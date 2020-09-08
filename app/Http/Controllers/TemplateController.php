<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Template;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TemplateController extends Controller
{
    public $validator = [
        'bank_id' => 'required|exists:banks,id|integer',
        'settings' => 'required|json',
        'resource' => 'required',
    ];

    public $messages = [
        'bank_id.required' => 'A bank is required',
        'bank_id.exists' => 'The bank must already exist',
        'bank_id.integer' => 'A bank ID is an integer',
        'settings.required' => 'Settings are required, default: []',
        'settings.json' => 'Settings must be a JSON object',
        'resource.required' => 'A resource path is required'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $templates = Template::all();
        return view('template.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $banks = Bank::all();
        $variables = ['form' => ['action' => route('template.store'), 'method' => 'POST']];
        return view('template.create', compact('banks', 'variables'));
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

        Template::create([
            'bank_id' => $request->get('bank_id'),
            'settings' => $request->get('settings'),
            'resource' => $request->get('resource')
        ]);

        return redirect()->route('template.index')->with('success', 'Template was created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
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
