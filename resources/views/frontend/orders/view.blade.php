@extends('layouts.app')

@section('title', 'My Order Details')

@section('content')

    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            <i class="fa fa-shopping-cart"></i> Order Details <span>#{{ $order->id }}</span> <button class="btn btn-info">{{ $order->order_statuses->name }}</button>
                            <a href="{{ url('/orders') }}" class="btn btn-sm btn-primary float-end">Back</a>
                        </h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3">Order Information</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Order ID</th>
                                        <td>{{ $order->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Date</th>
                                        <td>{{ $order->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tracking No</th>
                                        <td>{{ $order->tracking_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Bill</th>
                                        <td>${{ $order->total_bill }}</td>
                                    </tr>
                                    <tr>
                                        <th>Payment Method</th>
                                        <td>{{ $order->payment_methods->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Status</th>
                                        <td class="text-info">{{ $order->order_statuses->name }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <h5 class="mb-3">Shipping Information</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $order->shipping_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $order->shipping_email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $order->shipping_phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>{{ $order->shipping_address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Comments</th>
                                        <td>{{ $order->comment }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5 class="mb-3">Product Information</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Total Price</th>
                                    </tr>
                                    @foreach ($order->order_details as $order_detail)
                                        <tr>
                                            <td>{{ $order_detail->products->id }}</td>
                                            <td>
                                                @if($order_detail->product_image)
                                                    <img src="{{ $order_detail->product_image }}"
                                                         style="width: 50px"
                                                         alt="{{ $order_detail->products->name }}">
                                                @else
                                                    <img src="{{ asset('frontend/images/no-image.png') }}"
                                                         style="width: 50px; height: 50px"
                                                         alt="">
                                                @endif
                                            </td>
                                            <td>{{ $order_detail->products->name }}</td>
                                            <td>{{ $order_detail->quantity }}</td>
                                            <td>${{ $order_detail->product_price }}</td>
                                            <td>${{ $order_detail->quantity*$order_detail->product_price }}</td>
                                        </tr>
                                    @endforeach
                                    <tr class="text-danger">
                                        <td colspan="5" class="text-end">Total Bill</td>
                                        <td>${{ $order->total_bill }}</td>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <h5 class="mb-3">Payment Information</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Payment ID</th>
                                        <td>{{ $order->payment_id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Payment Status</th>
                                        <td>{{ $order->payment_status }}</td>
                                    </tr>
                                    <tr>
                                        <th>Payment Date</th>
                                        <td>{{ $order->payment_date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Payment Amount</th>
                                        <td>${{ $order->total_bill }}</td>
                                    </tr>
                                    <tr>
                                        <th>Payment Method</th>
                                        <td>{{ $order->payment_methods->name }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
