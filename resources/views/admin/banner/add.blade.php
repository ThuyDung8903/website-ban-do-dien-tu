@extends('layouts.admin')
@section('main-content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="edit-3"></i></div>
                            Banner
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
                        <div class="card-header">Add a new banner</div>
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
                                    <form enctype="multipart/form-data" action="{{ route('admin.banner.do-add') }}"
                                            method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name">Name</label>
                                            <input class="form-control" id="name" name="name" type="text"
                                                    placeholder="Input name banner" value="{{ old('name') }}"/>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image">Image</label>
                                            <input class="form-control" type="file" name="image" id="image"
                                                    value="{{ old('image') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="status">Status</label>
                                            <div class="form-check form-check-solid">
                                                <input class="form-check-input" id="show" type="radio" name="status"
                                                        checked value="1">
                                                <label class="form-check-label" for="show">Show</label>
                                            </div>
                                            <div class="form-check form-check-solid">
                                                <input class="form-check-input" id="hidden" type="radio" name="status"
                                                        value="0">
                                                <label class="form-check-label" for="hidden">Hidden</label>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Add</button>
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