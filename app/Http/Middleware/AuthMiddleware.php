<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected $model = Usuario::class;

    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('user')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
