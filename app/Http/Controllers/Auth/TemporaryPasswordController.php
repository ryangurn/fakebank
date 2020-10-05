<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rules\StrongPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TemporaryPasswordController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *
     */
    public function show()
    {
        return view('auth.temporary_password');
    }

    /**
     * @param Request $request
     */
    public function change(Request $request)
    {
        $validator = validator($request->all(), [
            'old_password' => ['required'],
            'new_password' => ['required', 'confirmed', new StrongPassword()],
        ]);

        if ($validator->fails())
        {
            return back()->withErrors($validator);
        }

        if (!Auth::check())
        {
            return redirect()->route('login')->withErrors('It does not appear that you are logged in.');
        }

        if (!Hash::check($request->get('old_password'), Auth::user()->getAuthPassword()))
        {
            return back()->withErrors('The old password provided is incorrect.');
        }

        $user = Auth::user();
        $user->password = Hash::make($request->get('new_password'));
        $user->temporary_password = false;
        $user->save();

        activity('user')
            ->causedBy($user->id)
            ->performedOn($user)
            ->log('password reset');

        return redirect()->route('admin.home')->with('success', 'Password changed, keep it safe');

    }
}
