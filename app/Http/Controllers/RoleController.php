<?php

namespace App\Http\Controllers;

use App\RoleMeta;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public $validator = [
        'name' => 'required',
        'description' => 'required|string',
        'long' => 'string|nullable',
        'permissions.*' => 'required|numeric'
    ];

    public $messages = [
        'name.required' => 'A role name is required',
        'description.required' => 'A role description is required',
        'description.string' => 'A role description must be a string',
        'long.string' => 'A long description must be a string',
        'long.nullable' => 'The long description is not required',
        'permissions.required' => 'Please assign a set of permissions to assign',
        'permissions.numeric' => 'Permissions must be numeric'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $roles = Role::all();
        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        $permissions = Permission::all();
        $variables = ['form' => ['action' => route('role.store'), 'method' => 'POST']];
        return view('role.create', compact('variables', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = validator($request->all(), $this->validator, $this->messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        if (count($request->get('permissions')) == 0 || $request->get('permissions') == null) {
            return back()->withErrors(['Please assign a set of permissions to assign']);
        }

        $rolesNames = Role::all()->first()->pluck('name')->toArray();
        if( in_array($request->get('name'), $rolesNames) ) {
            return back()->withErrors(['Please choose a new name for this role']);
        }

        try {
            $role = Role::create([
                'name' => $request->get('name')
            ]);

            foreach ($request->get('permissions') as $permission) {
                $p = Permission::where('id', '=', $permission)->first();
                $role->givePermissionTo($p);
            }

            RoleMeta::create([
                'role_id' => $role->id,
                'description' => $request->get('description'),
                'long' => $request->get('long')
            ]);
        } catch (RoleAlreadyExists $e) {
            return back()->withErrors(['Role already exists']);
        }

        return redirect()->route('role.index')->with('success', 'Role created');
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return Application|Factory|View
     */
    public function show(Role $role)
    {
        return view('role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return Application|Factory|View
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $variables = ['form' => ['action' => route('role.update', $role->id), 'method' => 'POST', 'hidden' => 'PUT']];
        return view('role.update', compact('role', 'variables', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        $validator = validator($request->all(), $this->validator, $this->messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        if (count($request->get('permissions')) == 0 || $request->get('permissions') == null) {
            return back()->withErrors(['Please assign a set of permissions to assign']);
        }

        $rolesNames = Role::where('id', '!=', $role->id)->get()->pluck('name')->toArray();
        if( in_array($request->get('name'), $rolesNames) ) {
            return back()->withErrors(['Please choose a new name for this role']);
        }

        $role = Role::where('id', '=', $role->id)->first();
        $role->name = $request->get('name');
        $role->save();

        $ps = [];
        foreach ($request->get('permissions') as $permission) {
            $ps[] = Permission::where('id', '=', $permission)->first();
        }
        $role->syncPermissions($ps);

        $meta = RoleMeta::where('role_id', '=', $role->id)->first();
        $meta->description = $request->get('description');
        $meta->long = $request->get('long');
        $meta->save();

        return redirect()->route('role.index')->with('success', 'Role updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('role.index')->with('success', 'Role deleted');
    }
}
