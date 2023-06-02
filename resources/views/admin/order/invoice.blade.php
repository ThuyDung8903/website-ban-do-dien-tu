@extends('layouts.admin')
@section('main-content')
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4 pb-3">
        <div class="row align-items-center justify-content-end">
            <div class="col-12 col-xl-auto mb-3">
                <a class="btn btn-sm btn-success" href="{{ route('admin.order.list', ['id'=>$order->id]) }}">
                    <i class="me-1" data-feather="box"></i>
                    Orders List
                </a>
            </div>
            <div class="col-12 col-xl-auto mb-3">
                <a class="btn btn-sm btn-success" href="{{ route('admin.order.view-invoice', ['id'=>$order->id]) }}">
                    <i class="me-1" data-feather="eye"></i>
                    View
                </a>
            </div>
            <div class="col-12 col-xl-auto mb-3">
                <a class="btn btn-sm btn-success"
                        href="{{ route('admin.order.invoice-generate', ['id'=>$order->id]) }}">
                    <i class="me-1" data-feather="download"></i>
                    Download Invoice
                </a>
            </div>
        </div>
        <!-- Invoice-->
        <div class="card invoice">
            <div class="card-header p-4 p-md-5 border-bottom-0 bg-gradient-primary-to-secondary text-white-50">
                <div class="row justify-content-between align-items-center">
                    <div class="col-12 col-lg-auto mb-5 mb-lg-0 text-center text-lg-start">
                        <!-- Invoice branding-->
                        <img class="invoice-brand-img rounded-circle mb-4"
                                src="{{ asset('admin/assets/img/demo/demo-logo.svg') }}" alt=""/>
                        <div class="h2 text-white mb-0">Shop Thuy Dung</div>
                    </div>
                    <div class="col-12 col-lg-auto text-center text-lg-end">
                        <!-- Invoice details-->
                        <div class="h3 text-white">Invoice</div>
                        Tracking No: {{ $order->tracking_number }}
                        <br/>
                        Ordered Date: {{ $order->created_at->format('d M Y H:i:s') }}
                    </div>
                </div>
            </div>
            <div class="card-body p-4 p-md-5">
                <!-- Invoice table-->
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead class="border-bottom">
                        <tr class="small text-uppercase text-muted">
                            <th scope="col">Product</th>
                            <th class="text-end" scope="col">Price</th>
                            <th class="text-end" scope="col">Quantity</th>
                            <th class="text-end" scope="col">Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Invoice item-->
                        @foreach($order->order_details as $order_detail)
                            <tr class="border-bottom">
                                <td>
                                    <div class="fw-bold">{{ $order_detail->product_name }}</div>
                                </td>
                                <td class="text-end fw-bold">${{ $order_detail->product_price }}</td>
                                <td class="text-end fw-bold">x{{ $order_detail->quantity }}</td>
                                <td class="text-end fw-bold">{{ $order_detail->product_price * $order_detail->quantity }}</td>
                            </tr>
                        @endforeach
                        <!-- Invoice subtotal-->
                        <tr>
                            <td class="text-end pb-0" colspan="3">
                                <div class="text-uppercase small fw-700 text-muted">Subtotal:</div>
                            </td>
                            <td class="text-end pb-0">
                                <div class="h5 mb-0 fw-700">${{ $order->total_bill }}</div>
                            </td>
                        </tr>
                        <!-- Invoice tax column-->
                        <tr>
                            <td class="text-end pb-0" colspan="3">
                                <div class="text-uppercase small fw-700 text-muted">Tax:</div>
                            </td>
                            <td class="text-end pb-0">
                                <div class="h5 mb-0 fw-700">${{ $order->tax_price }}</div>
                            </td>
                        </tr>
                        <!-- Invoice shipping-fee column-->
                        <tr>
                            <td class="text-end pb-0" colspan="3">
                                <div class="text-uppercase small fw-700 text-muted">Shipping-fee:</div>
                            </td>
                            <td class="text-end pb-0">
                                <div class="h5 mb-0 fw-700">${{ $order->customer_shipping_price }}</div>
                            </td>
                        </tr>
                        <!-- Invoice total-->
                        <tr>
                            <td class="text-end pb-0" colspan="3">
                                <div class="text-uppercase small fw-700 text-muted">Total Amount Due:</div>
                            </td>
                            <td class="text-end pb-0">
                                <div class="h5 mb-0 fw-700 text-green">${{ $order->total_bill }}</div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer p-4 p-lg-5 border-top-0">
                <div class="row">
                    <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <!-- Invoice - sent to info-->
                        <div class="small text-muted text-uppercase fw-700 mb-2">To</div>
                        <div class="h6 mb-1">{{ $order->shipping_name }}</div>
                        <div class="small">{{ $order->shipping_phone }}</div>
                        <div class="small">{{ $order->shipping_address }}</div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <!-- Invoice - sent from info-->
                        <div class="small text-muted text-uppercase fw-700 mb-2">From</div>
                        <div class="h6 mb-0">Shop Thuy Dung</div>
                        <div class="small">5678 Company Rd.</div>
                        <div class="small">Yorktown, MA 39201</div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Invoice - additional notes-->
                        <div class="small text-muted text-uppercase fw-700 mb-2">Note</div>
                        <div class="small mb-0">If there is any problem with the product, please contact us again. Thank you for trusting and choosing our store!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection