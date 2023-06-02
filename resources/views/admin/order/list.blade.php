@extends('layouts.admin')
@section('main-content')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="box"></i></div>
                            Orders List
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5 class="alert-heading">Alert!</h5>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button class="btn-close" type="button" data-bs-dismiss="alert"
                    aria-label="Close" aria-hidden="true"></button>
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5 class="alert-heading">Alert!</h5>
            {{ session('success') }}
            <button class="btn-close" type="button" data-bs-dismiss="alert"
                    aria-label="Close" aria-hidden="true"></button>
        </div>
    @endif
    <div class="container-fluid px-4">
        <div class="card">
            <div class="card-body">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="date">Filter by Date</label>
                            <input type="date" name="date" value="{{ request('date') }}" class="form-control"/>
                        </div>
                        <div class="col-md-2">
                            <label for="time">Filter by Time:</label>
                            <select class="form-select" id="time" name="time">
                                <option value="0" {{ request('time') == 0 ? 'selected' : '' }}>All</option>
                                <option value="1" {{ request('time') == 1 ? 'selected' : '' }}>Today</option>
                                <option value="2" {{ request('time') == 2 ? 'selected' : '' }}>Yesterday</option>
                                <option value="3" {{ request('time') == 3 ? 'selected' : '' }}>For 7 days</option>
                                <option value="4" {{ request('time') == 4 ? 'selected' : '' }}>For 1 month</option>
                                <option value="5" {{ request('time') == 5 ? 'selected' : '' }}>For 6 month</option>
                                <option value="6" {{ request('time') == 6 ? 'selected' : '' }}>For 1 year</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="order-status">Filter by Order_status:</label>
                            <select class="form-select" id="order_status" name="order_status">
                                <option value="all">All</option>
                                @foreach($order_statuses as $order_status)
                                    <option value="{{ $order_status->id }}" {{ request('order_status') == $order_status->id ? 'selected' : ''}}>{{ $order_status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="customer_name">Filter by Customer's name</label>
                            <input type="text" name="customer_name" value="{{ request('customer_name') }}"
                                    class="form-control"/>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <button class="btn btn-primary" id="filterBtn" type="submit">Filter</button>
                        </div>
                    </div>
                </form>
                <table id="datatablesSimple" class="table table-hover dataTable-wrapper dataTable-table">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Tracking No</th>
                        <th>Customer</th>
                        <th>Receiver's information</th>
                        <th>Order</th>
                        <th>Total bill</th>
                        <th>Comment</th>
                        <th>Ordered Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Order ID</th>
                        <th>Tracking No</th>
                        <th>Customer</th>
                        <th>Receiver's information</th>
                        <th>Order</th>
                        <th>Total bill</th>
                        <th>Comment</th>
                        <th>Ordered Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($orders->sortByDesc('created_at') as $order)
                        <tr>
                            <td class="fw-bolder" id="order_id">{{ $order->id }}</td>
                            <td>{{ $order->tracking_number }}</td>
                            <td>{{ $order->customer->fullname }}</td>
                            <td class="d-flex flex-wrap d-inline-block">
                                <ul>
                                    <li><strong>Name:</strong> {{ $order->shipping_name }}</li>
                                    <li><strong>Email:</strong> {{ $order->shipping_mail }}</li>
                                    <li><strong>Phone:</strong> {{ $order->shipping_phone }}</li>
                                    <li><strong>Shipping address:</strong> {{ $order->shipping_address }}</li>
                                </ul>
                            </td>
                            <td class="d-flex flex-wrap d-inline-block">
                                <strong>Product:</strong>
                                <ul class="row">
                                    @foreach($order->order_details as $order_detail)
                                        <li>{{ $order_detail->product_name }} (Price: {{ $order_detail->product_price }}) x {{ $order_detail->quantity }}</li>
                                    @endforeach
                                </ul>
                                <span><strong>Shipping_method: </strong>{{ $order->shipping_method->name }}</span>
                                <span><strong>Payment_method: </strong>{{ $order->payment_method->name }}</span>

                            </td>
                            <td>{{ $order->total_bill }}</td>
                            <td>{{ $order->comment }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>
                                <span id="order_status_name"
                                        class="badge bg-light text-black">{{ $order->order_status->name }}</span>
                            </td>
                            <td>
                                <!-- Button update order_status modal -->
                                <button class="badge bg-primary" type="button" data-bs-toggle="modal"
                                        data-bs-target="{{ '#updateStatusModal'.$order->id }}">
                                    <i data-feather="edit"></i>
                                </button>

                                <!-- Modal -->
                                <form action="{{ route('admin.order.update-status', ['id' => $order->id]) }}"
                                        method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal fade" id="{{ 'updateStatusModal'.$order->id }}" tabindex="-1"
                                            aria-labelledby="updateStatusModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                            id="updateStatusModalLabel">Update status for order: {{$order->tracking_number}} </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="order_status_id">Order status</label>
                                                    <select class="form-select" name="order_status_id">
                                                        @foreach($order_statuses as $order_status)
                                                            <option value="{{ $order_status->id }}" {{ $order->order_status_id == $order_status->id ? 'selected' : ''}}>{{ $order_status->name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <button class="badge bg-primary" type="button">
                                    <a href="{{ route('admin.order.invoice', ['id' => $order->id]) }}">
                                        <i data-feather="eye" class="text-white"></i>
                                    </a>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection