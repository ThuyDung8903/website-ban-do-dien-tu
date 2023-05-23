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
                            Banner
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header row align-items-center justify-content-between pt-3">
                <div class="col-auto">Banners List</div>
                <div class="col-12 col-xl-auto">
                    <a class="btn btn-sm btn-outline-blue-soft text-primary"
                            href="{{ route('admin.banner.add') }}">
                        <i class="me-1" data-feather="arrow-right"></i>
                        Add banner
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($banners as $banner)
                        <tr>
                            <td>{{ $banner->id }}</td>
                            <td>{{ $banner->name }}</td>
                            <td>
                                <img src="{{ $banner->image }}" alt="{{ $banner->name }}" width="72px"
                                        height="36px">
                            </td>
                            <td>
                                @if ($banner->status === 1)
                                    <div class="badge bg-primary text-white rounded-pill">Show</div>
                                @else
                                    <div class="badge bg-light text-black rounded-pill">Hidden</div>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                        href="{{ route('admin.banner.edit', ['id'=>$banner->id]) }}"><i
                                            data-feather="edit"></i></a>
                                <a class="btn btn-datatable btn-icon btn-transparent-dark"
                                        onclick="return confirm('Are you sure?')"
                                        href="{{ route('admin.banner.delete', ['id' => $banner->id]) }}"><i
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