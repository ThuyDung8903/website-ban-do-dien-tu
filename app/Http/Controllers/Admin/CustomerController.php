<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class CustomerController extends Controller
{
    public function list()
    {
        $customers = Customer::all();
        return view('admin.customer.list', compact('customers'));
    }

    public function edit($id)
    {
        $obj = Customer::find($id);
        return view('admin.customer.edit', compact('obj'));
    }

    public function doEdit($id, Request $request)
    {
        // TODO: Implement doEdit() method.
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:customers,username,' . $id,
            'fullname' => 'required',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone' => 'required|regex:/^0\d{9}$/',
            'address' => 'required',
            'joined_date' => 'required|date',
        ]);
        if ($validator->fails()) {
            $errors = new MessageBag($validator->errors()->all());
            return redirect()->back()->withErrors($errors)->withInput();
        }
        $data = $request->except('avatar');
        unset($data['_token']);
        Customer::where('id', $id)->update($data);
        return redirect()->back()->with('success', 'Update successfully!');
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        Customer::where('id', $id)->delete();
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
        $request->avatar->move(public_path('uploads/customers'), $file_name);
        $path = '/uploads/customers/' . $file_name;
        $data = $request->only('avatar');
        unset($data['_token']);
        $data['avatar'] = $path;
        try {
            Customer::where('id', $id)->update($data);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->back()->with('success', 'Change avatar successfully!');
    }
}