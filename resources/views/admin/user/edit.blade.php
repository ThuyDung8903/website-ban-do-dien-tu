@extends('layouts.admin')
@section('main-content')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user-plus"></i></div>
                            Edit User
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-outline-blue-soft text-primary" href="{{ route('admin.user.list') }}">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Back to Users List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
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
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Avatar Preview</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        @if(!$obj->avatar)
                            <img class="img-account-profile rounded-circle mb-2" id="previewImage"
                                    src="{{ asset('admin/assets/img/demo/user-placeholder.svg') }}"
                                    alt="Preview Image"/>
                        @else
                            <img class="img-account-profile rounded-circle mb-2" id="previewImage"
                                    src="{{ asset( $obj->avatar ) }}"
                                    alt="Preview Image"/>
                        @endif
                        <!-- Profile picture help block-->
                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        <form action="{{ route('admin.user.upload-avatar', ['id' => $obj->id]) }}" method="POST"
                                enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" type="file" name="avatar" id="avatar">
                                <br>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload new avatar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form action="{{ route('admin.user.do-edit', ['id' => $obj->id]) }}" method="post"
                                enctype="multipart/form-data">
                            @csrf
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (username)-->
                                <div class="mb-3">
                                    <label class="small mb-1"
                                            for="inputUsername">Username (how your name will appear to other users on the site)</label>
                                    <input class="form-control" id="inputUsername" name="username" type="text"
                                            placeholder="Enter your username" value="{{ $obj->username }}">
                                </div>
                                <!-- Form Group (fullname)-->
                                <div class="mb-3">
                                    <label class="small mb-1"
                                            for="inputFullname">Fullname</label>
                                    <input class="form-control" id="inputFullname" name="fullname" type="text"
                                            placeholder="Enter your fullname" value="{{ $obj->fullname }}">
                                </div>
                                <!-- Form Group (email address)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                    <input class="form-control" id="inputEmailAddress" name="email" type="email"
                                            placeholder="Enter your email address" value="{{ $obj->email }}">
                                </div>
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (address)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputAddress">Address</label>
                                        <input class="form-control" id="inputAddress" name="address" type="text"
                                                placeholder="Enter your address" value="{{ $obj->address }}">
                                    </div>
                                    <!-- Form Group (joined_time)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputJoinedTime">Joined Time</label>
                                        <input class="form-control" id="inputJoinedTime" name="joined_time" type="date"
                                                value="{{ $obj->joined_time }}"/>
                                    </div>
                                </div>
                                <!-- Form Group (Status radio)-->
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <div class="form-check form-check-solid">
                                        <input class="form-check-input" id="working" type="radio" name="status"
                                                {{ $obj->status == 1 ? 'checked' : '' }} value="1">
                                        <label class="form-check-label" for="working">Working</label>
                                    </div>
                                    <div class="form-check form-check-solid">
                                        <input class="form-check-input" id="resigned" type="radio" name="status"
                                                {{ $obj->status == 0 ? 'checked' : '' }} value="0">
                                        <label class="form-check-label" for="resigned">Resigned</label>
                                    </div>
                                </div>
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (phone number)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputPhone">Phone number</label>
                                        <input class="form-control" id="inputPhone" name="phone" type="tel"
                                                placeholder="Enter your phone number" value="{{ $obj->phone }}">
                                    </div>
                                    <!-- Form Group (role)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1">Role</label>
                                        <select class="form-select" name="role" aria-label="Default select example">
                                            <option selected disabled>Select a role:</option>
                                            <option value="Accountant" {{ $obj->role == 'Accountant' ? 'selected' : '' }}>Accountant</option>
                                            <option value="Manager" {{ $obj->role == 'Manager' ? 'selected' : '' }}>Manager</option>
                                            <option value="Shop-assistant" {{ $obj->role == 'Shop-assistant' ? 'selected' : '' }}>Shop-assistant</option>
                                            <option value="Shopkeeper" {{ $obj->role == 'Shopkeeper' ? 'selected' : '' }}>Shopkeeper</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Save changes button-->
                                <button class="btn btn-primary" type="submit">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection