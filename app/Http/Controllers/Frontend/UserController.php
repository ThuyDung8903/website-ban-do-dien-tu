<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->guard('customer')->user();
        return view('frontend.users.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'fullname' => 'string|max:255',
            'phone' => 'regex:/^[0-9]{10,11}$/',
            'address' => 'string|max:500',
        ]);
        $user = auth()->guard('customer')->user();
        $user->update([
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        return redirect()->back()->with('message', 'Profile updated successfully');
    }
}
