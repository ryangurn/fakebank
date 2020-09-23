<?php

namespace App\Http\Controllers;

use App\Template;
use App\TemplateFile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FileController extends Controller
{
    public $validator = [
        'file' => 'required|file|mimes:php,html',
        'purpose' => 'required|numeric|in:0,1,2',
    ];

    public $messages = [
        'file.required' => 'A file is required',
        'file.file' => 'Please select a valid file',
        'file.mimes' => 'Please upload a valid blade file',
        'purpose.required' => 'A file purpose is required',
        'purpose.numeric' => 'Please select a valid file purpose',
        'purpose.in' => 'Please select a valid file purpose'
    ];

    /**
     * Show the form for creating a new resource.
     *
     * @param Template $template
     * @return Response
     */
    public function create(Template $template)
    {
        $variables = ['form' => ['action' => route('file.store', $template->id), 'method' => 'POST']];
        return view('template.files.create', compact('template', 'variables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Template $template
     * @return Response
     */
    public function store(Request $request, Template $template)
    {
        $validator = validator($request->all(), $this->validator, $this->messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        if (!is_dir(resource_path('views/public/'.$template->resource))) {
            return back()->withErrors(['Resource path does not exist']);
        }

        $request->file->storeAs($template->resource, $request->file->getClientOriginalName(),'template');

        TemplateFile::create([
            'template_id' => $template->id,
            'type' => $request->get('purpose'),
            'storage' => $request->file->getClientOriginalName()
        ]);

        return redirect()->route('template.show', $template->id)->with('success', 'File was successfully uploaded!');
    }

    /**
     * Display the specified resource.
     *
     * @param TemplateFile $templateFile
     * @return Response
     */
    public function show(TemplateFile $templateFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TemplateFile $templateFile
     * @return Response
     */
    public function edit(TemplateFile $templateFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param TemplateFile $templateFile
     * @return Response
     */
    public function update(Request $request, TemplateFile $templateFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TemplateFile $templateFile
     * @return Response
     */
    public function destroy(TemplateFile $templateFile)
    {
        //
    }
}
