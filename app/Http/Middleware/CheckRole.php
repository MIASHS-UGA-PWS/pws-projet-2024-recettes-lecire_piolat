<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = 'admin';
        if (! $request->user()->roles || ! $request->user()->roles->pluck('name')->contains($role)) {
            return redirect()->route('login')->with('error', "Vous n'avez pas les accès nécessaires pour cette fonction.");
        }

        return $next($request);
    }
}
