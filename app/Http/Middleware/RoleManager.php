<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if ($request->user()->role !== $role) {
            

            if ($request->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            
            if ($request->user()->role === 'user') {
                return redirect()->route('customer.dashboard');
            }
        }

        return $next($request);
    }
}