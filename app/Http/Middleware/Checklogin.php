<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Checklogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check())
        {
            //Phân quyền khi đăng nhập
            //Nếu là 1 thì là Admin
            if(Auth::user()->role == '1' || Auth::user()->role == '2')
            {
                return $next($request);
            }
            else
            {
                // nó sẽ thông báo quyền truy cập đã bị từ chối
                return redirect('/')->with('status','Quyền đăng nhập bị từ chối! Bạn không phải là quản trị viên');
            }
        }
        else
        {
            // nếu không đăng nhập thì nó sẽ hiện ra thông báo là vui lòng đăng nhập!
            return redirect('/')->with('status','Vui lòng đăng nhập vào tài khoản');
        }
    }
}