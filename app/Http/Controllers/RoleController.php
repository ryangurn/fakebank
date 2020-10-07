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
        'name' => 'required|unique:roles,name',
        'description' => 'required|string',
        'long' => 'string|nullable',
        'permissions.*' => 'required|numeric'
    ];

    public $messages = [
        'name.required' => 'A role name is required',
        'name.unique' => 'A role already exists with that name',
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
    public function store(Request $request)
    {
        $validator = validator($request->all(), $this->validator, $this->messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        if (count($request->get('permissions')) == 0 || $request->get('permissions') == null) {
            return back()->withErrors(['Please assign a set of permissions to assign']);
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

}
