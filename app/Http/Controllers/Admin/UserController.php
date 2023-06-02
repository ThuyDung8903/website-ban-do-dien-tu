<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class UserController extends Controller implements ICrud
{
    public function list(Request $request)
    {
        // TODO: Implement list() method.
        $users = User::all();
        return view('admin.user.list', compact('users'));
    }

    public function add()
    {
        // TODO: Implement add() method.
        return view('admin.user.add');
    }

    public function doAdd(Request $request)
    {
        // TODO: Implement doAdd() method.
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'fullname' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|regex:/^0\d{9}$/',
            'address' => 'required',
            'role' => 'required',
            'joined_time' => 'required|date',
            'avatar' => 'mimes:jpg,jpeg,png,gif|max:5120',
            'password' => 'required|min:6|max:32',
            'password_confirmation' => 'required|same:password'
        ]);
        if ($validator->fails()) {
            $errors = new MessageBag($validator->errors()->all());
            return redirect()->back()->withErrors($errors)->withInput();
        }
        $data = $request->except('avatar');
        if ($request->avatar != null) {
            $file_name = $request->avatar->getClientOriginalName();
            $request->avatar->move(public_path('uploads/users'), $file_name);
            $path = '/uploads/users/' . $file_name;
            $data['avatar'] = $path;
        }
        $data['password'] = Hash::make($data['password']);
        unset($data['_token'], $data['password_confirmation']);
        User::create($data);
        return redirect()->back()->with('success', 'Add successfully!');
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
        $obj = User::find($id);
        return view('admin.user.edit', compact('obj'));
    }

    public function doEdit($id, Request $request)
    {
        // TODO: Implement doEdit() method.
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username,' . $id,
            'fullname' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|regex:/^0\d{9}$/',
            'address' => 'required',
            'role' => 'required',
            'joined_time' => 'required|date',
            'password' => 'nullable|min:6|max:32',
            'password_confirmation' => 'nullable|same:password'
        ]);
        if ($validator->fails()) {
            $errors = new MessageBag($validator->errors()->all());
            return redirect()->back()->withErrors($errors)->withInput();
        }
        $data = $request->except('avatar');
        unset($data['_token']);
        User::where('id', $id)->update($data);
        return redirect()->back()->with('success', 'Update successfully!');
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        User::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Delete successfully!');
    }

    public function upload(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'avatar' => 'required|mimes:jpg,jpeg,png,gif|max:5120',
        ]);

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
            User::where('id', $id)->update($data);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->back()->with('success', 'Change avatar successfully!');
    }
}