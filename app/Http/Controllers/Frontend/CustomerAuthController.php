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
        // Validate login form data
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials, $request->remember)) {
            // Login successfully
            return redirect()->intended(route('homepage'));
        } else {
            // Login failed
            session()->flash('error', 'Invalid login credentials! Please try again.');
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
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
            'username' => ['required', 'unique:customers', 'min:6', 'max:255', 'alpha_num'],
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

    public function showLinkRequestForm()
    {
        return view('frontend.customer.reset-password');
    }

    public function reset(Request $request)
    {
        // Validate reset password form data
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $customer = Customer::where('email', $request->email)->first();

        if ($customer) {
            $customer->password = Hash::make($request->password);
            $customer->save();

            // Login after reset password
            Auth::guard('customer')->login($customer);

            // Redirect to homepage
            return redirect()->route('homepage');
        } else {
            session()->flash('error', 'Invalid email! Please try again.');
            return redirect()->back();
        }
    }

    public function sendResetLinkEmail(Request $request)
    {
        // Validate send reset password link form data
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $customer = Customer::where('email', $request->email)->first();

        if ($customer) {
            // Send reset password link
            $customer->sendPasswordResetNotification($customer->createToken('password_reset')->plainTextToken);

            session()->flash('success', 'Reset password link sent on your email id.');
            return redirect()->back();
        } else {
            session()->flash('error', 'Invalid email! Please try again.');
            return redirect()->back();
        }
    }

    public function showResetPasswordForm(Request $request)
    {
        $token = $request->token;
        return view('frontend.customer.reset-password-form', compact('token'));
    }

    //logout function
    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('homepage');
    }
}
