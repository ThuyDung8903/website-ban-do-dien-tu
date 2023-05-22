<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderStatus;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class OrderStatusController extends Controller implements ICrud
{
    public function list(Request $request)
    {
        // TODO: Implement list() method.
        $order_statuses = OrderStatus::all();
        return view('admin.order-status.list', compact('order_statuses'));
    }

    public function add()
    {
        // TODO: Implement add() method.
        return view('admin.order-status.add');
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
            OrderStatus::create($data);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->back()->with('success', 'Add a new order-status successfully');
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
        $obj = OrderStatus::find($id);
        return view('admin.order-status.edit', compact('obj'));
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
            OrderStatus::where('id', $id)->update($data);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect()->back()->with('success', 'Update order-status successfully');
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        OrderStatus::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Delete successfully');
    }
}