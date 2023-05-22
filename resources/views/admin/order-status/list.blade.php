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
                            Order-status
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
                <div class="p-2 bd-highlight">Extended DataTables</div>
                <a href="{{ route('admin.order-status.add') }}" class="btn btn-blue text-white p-2 flex-shrink-1 bd-highlight">Add order-status <i
                            data-feather="plus-circle" class="fs-5"></i></a>
            </div>

            <div class="card-body">
                <table id="datatablesSimple" class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($order_statuses as $status)
                        <tr>
                            <td>{{ $status->id }}</td>
                            <td>{{ $status->name }}</td>
                            <td>
                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                        href="{{ route('admin.order-status.edit', ['id'=>$status->id]) }}"><i
                                            data-feather="edit"></i></a>
                                <a class="btn btn-datatable btn-icon btn-transparent-dark"
                                        onclick="return confirm('Are you sure?')"
                                        href="{{ route('admin.order-status.delete', ['id' => $status->id]) }}"><i
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