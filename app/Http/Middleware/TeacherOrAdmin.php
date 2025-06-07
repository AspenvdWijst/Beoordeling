<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeacherOrAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $userRoleId = auth()->user()->role_id;

        if (!in_array($userRoleId, [2, 3])) {
            abort(403, 'Unauthorized. Teachers and Admins only.');
        }

        return $next($request);
    }
}
