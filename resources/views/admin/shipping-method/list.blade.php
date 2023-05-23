@php use Illuminate\Support\Str; @endphp
@extends('layouts.admin')
@section('main-content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="filter"></i></div>
                            Shipping Method
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header d-flex bd-highlight justify-content-md-between">
                <div class="card-header row align-items-center justify-content-between pt-3">
                    <div class="col-auto">Shipping-methods List</div>
                    <div class="col-12 col-xl-auto">
                        <a class="btn btn-sm btn-outline-blue-soft text-primary"
                                href="{{ route('admin.shipping-method.add') }}">
                            <i class="me-1" data-feather="arrow-right"></i>
                            Add shipping-method
                        </a>
                    </div>
                </div>
                <a href="{{ route('admin.shipping-method.add') }}"
                        class="btn btn-blue text-white p-2 flex-shrink-1 bd-highlight">Add Shipping method <i
                            data-feather="plus-circle" class="fs-5"></i></a>
            </div>

            <div class="card-body">
                <table id="datatablesSimple" class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Shipping-fee</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Shipping-fee</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($shippingMethods as $method)
                        <tr>
                            <td>{{ $method->id }}</td>
                            <td>{{ $method->name }}</td>
                            <td>{{ $method->shipping_fee }}</td>
                            <td>
                                @if ( $method->status === 1)
                                    <div class="badge bg-primary text-white rounded-pill">Show</div>
                                @else
                                    <div class="badge bg-light text-black rounded-pill">Hidden</div>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                        href="{{ route('admin.shipping-method.edit', ['id'=>$method->id]) }}"><i
                                            data-feather="edit"></i></a>
                                <a class="btn btn-datatable btn-icon btn-transparent-dark"
                                        onclick="return confirm('Are you sure?')"
                                        href="{{ route('admin.shipping-method.delete', ['id' => $method->id]) }}"><i
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