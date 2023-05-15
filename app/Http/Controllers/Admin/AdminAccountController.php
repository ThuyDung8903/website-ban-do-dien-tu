<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAccountController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function post_login(Request $request)
    {
        $login_data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $check_login = Auth::guard()->attempt($login_data);
        if(! $check_login){
            return redirect()->back()->with('error','Login failed, please try again!');
        }
        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
