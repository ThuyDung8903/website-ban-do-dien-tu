<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class AccountProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = User::find(Auth::guard()->user()->id);
        return view('admin.account.profile', compact('user'));
    }

    public function doEdit(Request $request)
    {
        $rules = [
            'username' => 'required',
            'fullname' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^0\d{9}$/'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = new MessageBag($validator->errors()->all());
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $data = $request->except('avatar', 'role');
//        dd($data);
        unset($data['_token']);
        try {
            User::where('id', Auth::guard()->user()->id)->update($data);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->route('admin.account.profile')->with('success', 'Update successfully!');
    }

    public function upload(Request $request)
    {
        $rules = [
            'avatar' => 'required|mimes:jpg,jpeg,png,gif|max:5120',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = new MessageBag($validator->errors()->all());
            return redirect()->back()->withErrors($errors)->withInput();
        }
        $file_name = $request->avatar->getClientOriginalName();
        $request->avatar->move(public_path('uploads/users'), $file_name);
        $path = '/uploads/users/' . $file_name;
        $data = $request->only('avatar');
        unset($data['_token']);
        $data['avatar'] = $path;
        try {
            User::where('id', Auth::guard()->user()->id)->update($data);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->back()->with('success', 'Change avatar successfully!');
    }
}