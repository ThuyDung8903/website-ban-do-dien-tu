<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('customer_id', auth()->guard('customer')->user()->id)->orderBy('id', 'DESC')->paginate(5);
        return view('frontend.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('customer_id', auth()->guard('customer')->user()->id)->where('id', $id)->first();
        if($order) {
            return view('frontend.orders.view', compact('order'));
        } else {
            return redirect()->back()->with('message', 'Order not found!');
        }
    }
}
