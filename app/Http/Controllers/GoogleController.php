<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;

class GoogleController extends Controller
{
    // Login with Google
    public function googleRedirect() {
        return Socialite::driver('google')->redirect();
    }
    // Google callback
    public function googleLogin() {
        $user = Socialite::driver('google')->user();
        // dd($user);
        try {
            $user = Socialite::driver('google')->user();
            $isUser = User::where('google_id', $user->id)->first();
            if($isUser) {
                Auth::login($isUser);
                return redirect('/')->with('status','Đăng nhập với Google thành công!');
            } else {
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'role' => '0',
                    'status' => '0',
                ]);
    
                Auth::login($createUser);
                return redirect('/')->with('status','Đăng nhập với Google thành công!');
            }
    
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    } 
}