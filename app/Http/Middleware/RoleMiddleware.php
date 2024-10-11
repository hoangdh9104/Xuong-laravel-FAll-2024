<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {

        $user = Auth::user();

        if (!$user || !$user->role) {
            return redirect('/login')->withErrors('Bạn không có quyền truy cập trang này.');
        }
    
        // Tách các vai trò thành một mảng
        $rolesArray = explode(',', $roles);
    
        // Kiểm tra xem vai trò người dùng có trong mảng các vai trò cho phép hay không
        if (!in_array($user->role, $rolesArray)) {
            return redirect('/')->withErrors('Bạn không có quyền truy cập trang này.');
        }
    

        return $next($request);
    }
}
