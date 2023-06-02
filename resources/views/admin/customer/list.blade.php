@extends('layouts.admin')
@section('main-content')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user"></i></div>
                            Customers List
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
        <div class="card">
            <div class="card-body">
                <table id="datatablesSimple" class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Joined Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Joined Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <th>{{ $customer->id }}</th>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-2"><img class="avatar-img img-fluid"
                                                src="{{ asset( $customer->avatar ) }}"/></div>
                                    {{ $customer->fullname }}
                                </div>
                            </td>
                            <td>
                                @if($customer->gender == 1)
                                    Male
                                @else
                                    Female
                                @endif
                            </td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->joined_date }}</td>
                            <td>
                                @if ($customer->status === 1)
                                    <div class="badge bg-primary text-white rounded-pill">Active</div>
                                @else
                                    <div class="badge bg-light text-black rounded-pill">Blocked</div>
                                    @endif
                            </td>
                            <td>
                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                        href="{{ route('admin.customer.edit', ['id' => $customer->id]) }}"><i
                                            data-feather="edit"></i></a>
                                <a class="btn btn-datatable btn-icon btn-transparent-dark"
                                        onclick="return confirm('Are you sure you want to delete this customer?')"
                                        href="{{ route('admin.customer.delete', ['id' => $customer->id]) }}"><i
                                            data-feather="trash-2"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection