<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EnsurePasswordIsPermanent
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param null $redirectToRoute
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $redirectToRoute = null)
    {
        if (! $request->user() || ($request->user() instanceof MustVerifyEmail && $request->user()->temporary_password)) {
            return $request->expectsJson()
                ? abort(403, 'Your password cannot be temporary.')
                : Redirect::route($redirectToRoute ?: 'auth.temporary');
        }

        return $next($request);
    }
}
