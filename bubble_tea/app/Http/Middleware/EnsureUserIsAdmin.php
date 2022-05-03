<?php

namespace App\Http\Middleware;

use App\Entities\User;
use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if ($user instanceof User && User::ROLE_ADMIN !== $user->getRole()) {
            return redirect()->route('home.index');
        }

        return $next($request);
    }
}
