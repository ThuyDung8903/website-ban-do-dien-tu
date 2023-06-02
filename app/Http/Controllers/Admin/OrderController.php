<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('customer', 'order_status', 'shipping_method', 'payment_method', 'order_details');
        $order_statuses = OrderStatus::all();
        if ($request->order_status != 'all' && $request->has('order_status')) {
            $orders->where('order_status_id', '=', $request->order_status);
        }
        if ($request->customer_name != null && $request->has('customer_name')) {
            $orders->whereHas('customer', function ($query) use ($request) {
                $query->where('fullname', 'like', '%' . $request->customer_name . '%');
            });
        }
        if ($request->time != 0 && $request->has('time')) {
            if ($request->time == '1') {
                $orders->whereDate('created_at', '=', Carbon::now()->format('Y-m-d'));
            } elseif ($request->time == '2') {
                $orders->whereDate('created_at', '=', date('Y-m-d', strtotime('-1 day')));
            } elseif ($request->time == '3') {
                $orders->whereDate('created_at', '>=', date('Y-m-d', strtotime('-7 day')));
            } elseif ($request->time == '4') {
                $orders->whereDate('created_at', '>=', date('Y-m-d', strtotime('-1 month')));
            } elseif ($request->time == '5') {
                $orders->whereDate('created_at', '>=', date('Y-m-d', strtotime('-6 month')));
            } elseif ($request->time == '6') {
                $orders->whereDate('created_at', '>=', date('Y-m-d', strtotime('-1 year')));
            }
        }
        if ($request->date != null && $request->has('date')) {
            $orders->whereDate('created_at', '=', $request->date);
        }
        $orders = $orders->get();
        return view('admin.order.list', compact('orders', 'order_statuses'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        Order::where('id', $id)->update(['order_status_id' => $request->order_status_id]);
        return redirect()->back()->with('success', 'Update order status successfully!');
    }

    public function invoice($id)
    {
        $order = Order::with('customer', 'order_status', 'shipping_method', 'payment_method', 'order_details')->findOrFail($id);
        return view('admin.order.invoice', compact('order'));
    }
    public function viewInvoice($id)
    {
        $order = Order::with('customer', 'order_status', 'shipping_method', 'payment_method', 'order_details')->findOrFail($id);
        return view('admin.order.invoice-generate', compact('order'));
    }
    public function generateInvoice($id)
    {
        $order = Order::with('customer', 'order_status', 'shipping_method', 'payment_method', 'order_details')->findOrFail($id);
        $data = [
            'order' => $order,
        ];
        $today = Carbon::today()->format('Y-m-d');
        return Pdf::loadView('admin.order.invoice-generate', $data)->download('invoice-'.$order->tracking_number.'-'.$today.'.pdf');
    }
}