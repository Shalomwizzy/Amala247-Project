<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleChecker
{
    public function handle(Request $request, Closure $next)
    {
      
        if (!auth()->check()) {
     
            return redirect()->route('login');
        }

      
        $allowedRoles = ['admin', 'manager', 'salesperson'];
        if (!in_array(auth()->user()->role, $allowedRoles)) {
           
            abort(403, 'Unauthorized');
        }

      
        return $next($request);
    }
}




