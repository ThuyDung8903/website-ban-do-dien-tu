<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('frontend.customer.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            // Login successfully
            return redirect()->intended(route('homepage'));
        } else {
            // Login failed
            session()->flash('error', 'Invalid login credentials');
            return redirect()->back()->withInput($request->only('email'));
        }
    }

    public function showRegistrationForm()
    {
        return view('frontend.customer.register');
    }

    public function register(Request $request)
    {
        // Validate registration form data
        $request->validate([
            'username' => ['required', 'unique:users', 'min:6', 'max:255', 'alpha_num'],
            'email' => ['required', 'email', 'max:255', 'unique:customers'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $customer = Customer::create([
            'username' => $request->username,
            'email' => $request->email,
            'status' => '1',
            'password' => Hash::make($request->password),
        ]);

        // Login after registration
        Auth::guard('customer')->login($customer);

        // Redirect to homepage
        return redirect()->route('homepage');
    }

    //logout function
    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('homepage');
    }
}
