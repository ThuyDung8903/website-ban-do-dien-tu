@extends('layouts.admin')
@section('main-content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="edit-3"></i></div>
                            Shipping Method
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg-12">
                <!-- Default Bootstrap Form Controls-->
                <div id="default">
                    <div class="card mb-4">
                        <div class="card-header row align-items-center justify-content-between pt-3">
                            <div class="col-auto">Edit {{ $obj->name }}</div>
                            <div class="col-12 col-xl-auto">
                                <a class="btn btn-sm btn-outline-blue-soft text-primary"
                                        href="{{ route('admin.shipping-method.list') }}">
                                    <i class="me-1" data-feather="arrow-left"></i>
                                    Back to Shipping-methods List
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
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
                            <!-- Component Preview-->
                            <div class="sbp-preview">
                                <div class="sbp-preview-content">
                                    <form enctype="multipart/form-data"
                                            action="{{ route('admin.shipping-method.do-edit', ['id' => $obj->id]) }}"
                                            method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name">Name</label>
                                            <input class="form-control" id="name" name="name" type="text"
                                                    placeholder="Input name shipping-method" value="{{ $obj->name }}"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="shipping_fee">Shipping-fee</label>
                                            <input class="form-control" id="shipping_fee" name="shipping_fee" type="text"
                                                    placeholder="Input shipping_fee" value="{{ $obj->shipping_fee }}"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status">Status</label>
                                            <div class="form-check form-check-solid">
                                                <input class="form-check-input" id="show" type="radio" name="status"
                                                        {{ $obj->status == 1 ? 'checked' : '' }} value="1">
                                                <label class="form-check-label" for="show">Show</label>
                                            </div>
                                            <div class="form-check form-check-solid">
                                                <input class="form-check-input" id="hidden" type="radio" name="status"
                                                        {{ $obj->status == 0 ? 'checked' : '' }} value="0">
                                                <label class="form-check-label" for="hidden">Hidden</label>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Save change</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection