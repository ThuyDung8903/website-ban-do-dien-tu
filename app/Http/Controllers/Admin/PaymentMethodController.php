<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class PaymentMethodController extends Controller implements ICrud
{
    public function list(Request $request)
    {
        // TODO: Implement list() method.
        $paymentMethods = PaymentMethod::all();
        return view('admin.payment-method.list', compact('paymentMethods'));
    }

    public function add()
    {
        // TODO: Implement add() method.
        return view('admin.payment-method.add');
    }

    public function doAdd(Request $request)
    {
        // TODO: Implement doAdd() method.
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = new MessageBag($validator->errors()->all());
            return redirect()->back()->withErrors($errors)->withInput();
        }
        $data = $request->all();
        unset($data['_token']);
        try {
            PaymentMethod::create($data);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->back()->with('success', 'Add a new payment-method successfully');

    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
        $obj = PaymentMethod::find($id);
        return view('admin.payment-method.edit', compact('obj'));
    }

    public function doEdit($id, Request $request)
    {
        // TODO: Implement doEdit() method.
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = new MessageBag($validator->errors()->all());
            return redirect()->back()->withErrors($errors)->withInput();
        }
        $data = $request->all();
        unset($data['_token']);
        try {
            PaymentMethod::where('id', $id)->update($data);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->back()->with('success', 'Update payment-method successfully');
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        PaymentMethod::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Delete successfully');
    }
}