<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingMethod;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class ShippingMethodController extends Controller implements ICrud
{
    public function list(Request $request)
    {
        // TODO: Implement list() method.
        $shippingMethods = ShippingMethod::all();
        return view('admin.shipping-method.list', compact('shippingMethods'));
    }

    public function add()
    {
        // TODO: Implement add() method.
        return view('admin.shipping-method.add');
    }

    public function doAdd(Request $request)
    {
        // TODO: Implement doAdd() method.
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'shipping_fee' => 'required|numeric|gte:0'
        ]);

        if ($validator->fails()) {
            $errors = new MessageBag($validator->errors()->all());
            return redirect()->back()->withErrors($errors)->withInput();
        }
        $data = $request->all();
        unset($data['_token']);
        try {
            ShippingMethod::create($data);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->back()->with('success', 'Add a new shipping-method successfully');

    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
        $obj = ShippingMethod::find($id);
        return view('admin.shipping-method.edit', compact('obj'));
    }

    public function doEdit($id, Request $request)
    {
        // TODO: Implement doEdit() method.
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'shipping_fee' => 'required|numeric|gte:0'
        ]);

        if ($validator->fails()) {
            $errors = new MessageBag($validator->errors()->all());
            return redirect()->back()->withErrors($errors)->withInput();
        }
        $data = $request->all();
        unset($data['_token']);
        try {
            ShippingMethod::where('id', $id)->update($data);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->back()->with('success', 'Update shipping-method successfully');
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        ShippingMethod::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Delete successfully');
    }
}