<?php

namespace App\Http\Controllers;

use App\Template;
use App\TemplateVariable;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

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
     * @return Application|Factory|View|void
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
     * @return RedirectResponse
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

        return redirect()->route('template.show', $template->id)->with('success', 'Variable was created!');
    }

    /**
     * Display the specified resource.
     *
     * @param TemplateVariable $variable
     * @return Application|Factory|Response|View
     */
    public function show(TemplateVariable $variable)
    {
        return view('template.variables.show', compact('variable'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TemplateVariable $variable
     * @return Application|Factory|Response|View
     */
    public function edit(TemplateVariable $variable)
    {
        $variables = ['form' => ['action' => route('variable.update', $variable->id), 'method' => 'POST', 'hidden' => 'PUT']];
        return view('template.variables.update', compact('variable', 'variables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param TemplateVariable $variable
     * @return RedirectResponse
     */
    public function update(Request $request, TemplateVariable $variable)
    {
        $validator = validator($request->all(), $this->validator, $this->messages);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        // checking for uniqueness
        $variables = TemplateVariable::where('template_id', '=', $variable->template->id)->where('id', '!=', $variable->id)->get()->pluck('');
        if($variables->containsStrict($request->get('variable'))){
            return back()->withErrors(['Variable must be unique to this template']);
        }

        $var = TemplateVariable::where('id', '=', $variable->id)->first();
        $var->variable = $request->get('variable');
        $var->value = $request->get('value');

        // prepare executable
        $exec = false;
        switch ($request->get('executable')) {
            case 'yes':
                $exec = true;
                break;
        }
        $var->executable = $exec;
        $var->save();

        return redirect()->route('template.show', $variable->template->id)->with('success', 'Variable Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TemplateVariable $variable
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(TemplateVariable $variable)
    {
        $variable->delete();
        return redirect()->route('template.show', $variable->template->id)->with('success', 'Variable Deleted');
    }
}
