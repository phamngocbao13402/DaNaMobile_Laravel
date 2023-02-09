<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkAdminFull
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       
        if(Auth::user()->role == '1')
        {
            return $next($request);
        }
        else
        {
            // nó sẽ thông báo quyền truy cập đã bị từ chối
            return redirect('/admin')->with('message','Quyền đăng nhập bị từ chối! Bạn không phải là quản trị viên');
        }
    }
}
