<?php

namespace App\Http\Controllers;

use App\Template;
use App\TemplateFile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class FileController extends Controller
{
    public $validator = [
        'file' => 'required|file',
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

        $explode = explode(".", $request->file->getClientOriginalName());
        if ($explode[count($explode)-1] != "php" || $explode[count($explode)-2] != "blade") {
            return back()->withErrors(['Please upload a valid blade file']);
        }

        if (!is_dir(resource_path('views/public/'.$template->resource))) {
            mkdir(resource_path('views/public/'.$template->resource));
            return back()->withErrors(['Resource path does not exist, it has just been created again!']);
        }

        // get path & validate it
        $subPath = '';
        switch ($request->get('purpose')) {
            case 0:
                $subPath = 'layouts';
                break;
            case 1:
                $subPath = 'partials';
                break;
            case 2:
                $subPath = 'modals';
                break;
        }
        if ($subPath != '' && !is_dir(resource_path('views/public/'.$template->resource.'/'.$subPath))) {
            mkdir(resource_path('views/public/'.$template->resource.'/'.$subPath));
            return back()->withErrors(['Purpose path does not exist, it has just been created again!']);
        }

        $request->file->storeAs($template->resource."/".$subPath, $request->file->getClientOriginalName(), 'template');

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
     * @param TemplateFile $file
     * @return Response
     */
    public function show(TemplateFile $file)
    {
        return view('template.files.show', compact('file'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TemplateFile $file
     * @return Response
     */
    public function edit(TemplateFile $file)
    {
        $variables = ['form' => ['action' => route('file.store', $file->id), 'method' => 'POST', 'hidden' => 'PUT']];
        return view('template.files.update', compact('file', 'variables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param TemplateFile $file
     * @return Response
     */
    public function update(Request $request, TemplateFile $file)
    {
        $validator = validator($request->all(), ["purpose" => $this->validator['purpose']], $this->messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $subPath = '';
        switch ($request->get('purpose')) {
            case 0:
                $subPath = 'layouts';
                break;
            case 1:
                $subPath = 'partials';
                break;
            case 2:
                $subPath = 'modals';
                break;
        }

        // check the original path
        if (!file_exists(resource_path('views/public/'.$file->template->resource.'/'.strtolower($file->type).'s/'.$file->storage))) {
            return back()->withErrors(['Original file cannot be located']);
        }

        // check the new path
        if (!is_dir(resource_path('views/public/'.$file->template->resource.'/'.$subPath))) {
            mkdir(resource_path('views/public/'.$file->template->resource.'/'.$subPath));
            // return back()->withErrors(['New location does not exist, try again.']);
        }

        // move the file
        File::move(resource_path('views/public/'.$file->template->resource.'/'.strtolower($file->type).'s/'.$file->storage), resource_path('views/public/'.$file->template->resource.'/'.$subPath.'/'.$file->storage));

        // change the resources model.
        $file->type = $request->get('purpose');
        $file->save();

        return redirect()->route('template.show', $file->template->id)->with('success', 'File Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TemplateFile $file
     * @return Response
     */
    public function destroy(TemplateFile $file)
    {
        $template = $file->template->id;
        File::delete(resource_path('views/public/'.$file->template->resource.'/'.strtolower($file->type).'s/'.$file->storage));
        $file->delete();
        return redirect()->route('template.show', $template)->with('success', 'File Deleted');
    }
}
