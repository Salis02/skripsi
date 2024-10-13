<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                switch (Auth::user()->role) {
                    case 'admin':
                        return redirect()->route('admin.dashboard');
                    case 'dosen':
                        return redirect()->route('dosen.dashboard');
                    case 'mahasiswa':
                        return redirect()->route('home');
                    default:
                        return redirect('/');
                }
            }
        }

        return $next($request);
    }
}
