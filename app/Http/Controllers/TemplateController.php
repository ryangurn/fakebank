<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Template;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Activitylog\Models\Activity;

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

        // metadata
        $bankCount = Bank::all()->count();
        $templateCount = $templates->count();

        // activity log
        $activity = Activity::where('log_name', '=', env('ACTIVITY_LOGGER_TEMPLATE', 'template'))->get();

        return view('template.index', compact('templates', 'bankCount', 'templateCount', 'activity'));
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
     * @param Template $template
     * @return Response
     */
    public function show(Template $template)
    {
        return view('template.show', compact('template'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Template $template
     * @return Response
     */
    public function edit(Template $template)
    {
        $banks = Bank::all();
        $variables = ['form' => ['action' => route('template.update', $template->id), 'method' => 'POST', 'hidden' => 'PUT']];
        return view('template.update', compact('template', 'variables', 'banks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Template $template
     * @return Response
     */
    public function update(Request $request, Template $template)
    {
        $validator = validator($request->all(), $this->validator, $this->messages);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $template->bank_id = $request->get('bank_id');
        $template->resource = $request->get('resource');
        $template->settings = $request->get('settings');
        $template->save();

        return redirect()->route('template.index')->with('success', 'Template Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Template $template
     * @return Response
     * @throws Exception
     */
    public function destroy(Template $template)
    {
        $template->delete();
        return redirect()->route('template.index')->with('success', 'Template Deleted!');
    }
}
