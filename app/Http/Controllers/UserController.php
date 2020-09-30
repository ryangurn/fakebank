<?php

namespace App\Http\Controllers;

use App\Notifications\SendTemporaryPassword;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UserController extends Controller
{
    public $validator = [
        'name' => 'required|alphadash',
        'email' => 'required|email'
    ];

    public $messages = [
        'name.required' => 'A name is required',
        'name.alphadash' => 'Alpha numeric characters only (including dash and underscore)',
        'email.required' => 'An email is required',
        'email.email' => 'Please provide a valid email'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        $variables = ['form' => ['action' => route('user.store'), 'method' => 'POST']];
        return view('user.create', compact('variables'));
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

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        # generate password
        $tmpPassword = Str::random(16);

        # add user record
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($tmpPassword)
        ]);


        # send email with password
        $user->notify(new SendTemporaryPassword($tmpPassword));
        $user->sendEmailVerificationNotification();

        return redirect()->route('user.index')->with('success', 'User created and notified of account creation.');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Application|Factory|Response|View
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
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
