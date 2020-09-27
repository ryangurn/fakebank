<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RouteController extends Controller
{
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
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
