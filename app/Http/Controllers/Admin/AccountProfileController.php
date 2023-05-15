<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountProfileController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::guard()->user()->id);
        return view('admin.account-profile', compact('user'));
    }
}