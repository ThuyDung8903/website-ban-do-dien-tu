<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function changePassword()
    {
        return view('frontend.users.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->guard('customer')->user();

        $checkCurrentPassword = Hash::check($request->current_password, $user->password);

        if ($checkCurrentPassword) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
            return redirect()->back()->with('message', 'Password updated successfully');
        } else {
            return redirect()->back()->with('message', 'Old password does not match');
        }
    }

}
