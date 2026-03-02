<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Nếu chưa đăng nhập -> chuyển tới trang đăng nhập
        if (!Auth::check()) {
            return redirect()->guest(route('login'));
        }

        $user = Auth::user();

        // Check if user is admin - use isAdmin() method if available, otherwise check role field
        $isAdmin = method_exists($user, 'isAdmin') ? $user->isAdmin() : ($user->role === 'admin');

        if (! $isAdmin) {
            abort(403, 'Bạn không có quyền truy cập chức năng này.');
        }

        return $next($request);
    }
}
