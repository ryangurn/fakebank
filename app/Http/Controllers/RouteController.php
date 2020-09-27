<?php

namespace App\Http\Controllers;

use App\Template;
use App\TemplateRoute;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RouteController extends Controller
{
    public $validator = [
        'file_id' => 'required|numeric',
        'route' => 'required|alphadash'
    ];

    public $messages = [
        'file_id.required' => 'A file selection is required',
        'file_id.numeric' => 'Please select a valid file',
        'route.required' => 'A route is required',
        'route.alphadash' => 'A route must be alpha numeric including underscores and/or dashes'
    ];

    /**
     * Show the form for creating a new resource.
     *
     * @param Template $template
     * @return Response
     */
    public function create(Template $template)
    {
        $variables = ['form' => ['action' => route('route.store', $template->id), 'method' => 'POST']];
        return view('template.routes.create', compact('template', 'variables'));
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

        // ensure that file is within template
        $fileIDS = $template->files->pluck('id');
        if (!$fileIDS->contains($request->get('file_id'))) {
            return back()->withErrors(['File is not within the selected template']);
        }

        // ensure that route is unique to all routes within template
        $routes = $template->routes->pluck('route');
        if ($routes->contains($request->get('route'))) {
            return back()->withErrors(['Route must be unique to this template, please select another route label']);
        }

        TemplateRoute::create([
            'route' => $request->get('route'),
            'file_id' => $request->get('file_id'),
            'template_id' => $template->id
        ]);

        return redirect()->route('template.show', $template->id)->with('success', 'Route successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param TemplateRoute $route
     * @return Response
     */
    public function show(TemplateRoute $route)
    {
        return view('template.routes.show', compact('route'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TemplateRoute $route
     * @return Response
     */
    public function edit(TemplateRoute $route)
    {
        $template = $route->template;
        $variables = ['form' => ['action' => route('route.update', $route->id), 'method' => 'POST', 'hidden' => 'PUT']];
        return view('template.routes.update', compact('route', 'variables', 'template'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param TemplateRoute $route
     * @return Response
     */
    public function update(Request $request, TemplateRoute $route)
    {
        $template = $route->template;
        $validator = validator($request->all(), $this->validator, $this->messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        // ensure that file is within template
        $fileIDS = $template->files->pluck('id');
        if (!$fileIDS->contains($request->get('file_id'))) {
            return back()->withErrors(['File is not within the selected template']);
        }

        // ensure that route is unique to all routes within template
        $routes = $template->routes->pluck('route');
        if ($routes->contains($request->get('route'))) {
            return back()->withErrors(['Route must be unique to this template, please select another route label']);
        }

        $route->route = $request->get('route');
        $route->file_id = $request->get('file_id');
        $route->save();

        return redirect()->route('template.show', $template->id)->with('success', 'Route successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(TemplateRoute $route)
    {
        $template = $route->template->id;
        $route->delete();
        return redirect()->route('template.show', $template)->with('success', 'Route deleted');
    }
}
