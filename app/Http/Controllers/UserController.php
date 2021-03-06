<?php

namespace App\Http\Controllers;

use App\Notifications\SendNewPassword;
use App\Notifications\SendTemporaryPassword;
use App\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UserController extends Controller
{
    public $validator = [
        'name' => 'required|alphadash',
        'email' => 'required|email|unique:users,email'
    ];

    public $messages = [
        'name.required' => 'A name is required',
        'name.alphadash' => 'Alpha numeric characters only (including dash and underscore)',
        'email.required' => 'An email is required',
        'email.email' => 'Please provide a valid email',
        'email.unique' => 'That email address cannot be used, please try another one.'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
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
     * @return RedirectResponse
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
            'password' => Hash::make($tmpPassword),
            'temporary_password' => false
        ]);

        # TODO: Update temporary password column(s)/table(s)

        # send email with password
        activity('user')
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->log('sent temporary password');

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
     * @param User $user
     * @return Application|Factory|Response|View
     */
    public function edit(User $user)
    {
        $variables = ['form' => ['action' => route('user.update', $user->id), 'method' => 'POST', 'hidden' => 'PUT']];
        return view('user.update', compact('user', 'variables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $validator = validator($request->all(), $this->validator, $this->messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $user->name = $request->get('name');

        if ($user->email != $request->get('email')) {
            $user->email = $request->get('email');
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'User Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User Deleted');
    }

    /**
     * @param User $user
     */
    public function reset(User $user)
    {
        activity('user')
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->log('reset password');

        # generate password
        $tmpPassword = Str::random(16);

        $user->password = Hash::make($tmpPassword);
        $user->temporary_password = true;
        $user->save();

        $user->notify(new SendNewPassword($tmpPassword));

        return redirect()->route('user.index')->with('success', 'A password reset has been sent');
    }
}
