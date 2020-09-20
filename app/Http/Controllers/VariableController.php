<?php

namespace App\Http\Controllers;

use App\Template;
use App\TemplateVariable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VariableController extends Controller
{
    protected $validator = [
        'variable' => 'required|alpha_dash',
        'value' => 'required',
        'executable' => 'required|in:yes,no'
    ];

    protected $messages = [
        'variable.required' => 'A variable is required',
        'variable.alpha_dash' => 'A variable must be alpha numeric allowing for dashes and underscores',
        'value.required' => 'A value is required',
        'executable.required' => 'The executable toggle must either be on or off',
        'executable.in' => 'The executable value either needs to be checked or unchecked',
    ];

    /**
     * Show the form for creating a new resource.
     *
     * @param Template $template
     * @return void
     */
    public function create(Template $template)
    {
        $variables = ['form' => ['action' => route('variable.store', $template->id), 'method' => 'POST']];
        return view('template.variables.create', compact('template', 'variables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request, Template $template)
    {
        $validator = validator($request->all(), $this->validator, $this->messages);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $variables = TemplateVariable::where('template_id', '=', $template->id)->get()->pluck('variable');
        // adding additional validation for uniqueness.
        if($variables->containsStrict($request->get('variable'))) {
            return back()->withErrors(['Variable must be unique to this template']);
        }

        // prepare executable
        $exec = false;
        switch ($request->get('executable')) {
            case 'yes':
            $exec = true;
                break;
        }

        TemplateVariable::create([
           'template_id' => $template->id,
           'variable' => $request->get('variable'),
           'value' => $request->get('value'),
           'executable' => $exec
        ]);

        return redirect()->route('variable.create', $template->id)->with('success', 'Variable was created!');
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
