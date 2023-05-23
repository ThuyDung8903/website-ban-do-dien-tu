@extends('layouts.admin')
@section('main-content')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="user-plus"></i></div>
                            Add User
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-outline-blue-soft text-primary"
                                href="{{ route('admin.user.list') }}">
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
                        <img class="img-account-profile rounded-circle mb-2" id="previewImage"
                                src="{{ asset('admin/assets/img/demo/user-placeholder.svg') }}"
                                alt="Preview Image"/>
                        <!-- Profile picture help block-->
                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form action="{{ route('admin.user.do-add') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (username)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputUserName">Username</label>
                                    <input class="form-control" id="inputUserName" name="username" type="text"
                                            placeholder="Enter your username" value="{{ old('username') }}"/>
                                </div>
                                <!-- Form Group (fullname)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputFullName">Full name</label>
                                    <input class="form-control" id="inputFullName" name="fullname" type="text"
                                            placeholder="Enter your fullname" value="{{ old('fullname') }}"/>
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (email)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputEmail">Email</label>
                                    <input class="form-control" id="inputEmail" name="email" type="email"
                                            placeholder="Enter your email" value="{{ old('email') }}"/>
                                </div>
                                <!-- Form Group (phone)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Phone</label>
                                    <input class="form-control" id="inputPhone" name="phone" type="text"
                                            placeholder="Enter your phone" value="{{ old('phone') }}"/>
                                </div>
                            </div>
                            <!-- Form Group (address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputAddress">Address</label>
                                <input class="form-control" id="inputAddress" name="address" type="text"
                                        placeholder="Enter your address" value="{{ old('address') }}"/>
                            </div>
                            <!-- Form Group (Status radio)-->
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <div class="form-check form-check-solid">
                                    <input class="form-check-input" id="working" type="radio" name="status"
                                            checked value="1">
                                    <label class="form-check-label" for="working">Working</label>
                                </div>
                                <div class="form-check form-check-solid">
                                    <input class="form-check-input" id="resigned" type="radio" name="status"
                                            value="0">
                                    <label class="form-check-label" for="resigned">Resigned</label>
                                </div>
                            </div>
                            <!-- Form Group (Roles)-->
                            <div class="mb-3">
                                <label class="small mb-1">Role</label>
                                <select class="form-select" name="role" aria-label="Default select example">
                                    <option selected disabled>Select a role:</option>
                                    <option value="Accountant" {{ old('role') == 'Accountant' ? 'selected' : '' }}>Accountant</option>
                                    <option value="Manager" {{ old('role') == 'Manager' ? 'selected' : '' }}>Manager</option>
                                    <option value="Shop-assistant" {{ old('role') == 'Shop-assistant' ? 'selected' : '' }}>Shop-assistant</option>
                                    <option value="Shopkeeper" {{ old('role') == 'Shopkeeper' ? 'selected' : '' }}>Shopkeeper</option>
                                </select>
                            </div>
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (email)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPassword">Password</label>
                                    <input class="form-control" id="inputPassword" name="password" type="password"
                                            placeholder="Enter your password" value="{{ old('password') }}"/>
                                </div>
                                <!-- Form Group (phone)-->
                                <div class="col-md-6">
                                    <label class="small mb-1"
                                            for="inputPasswordConfirmation">Password Confirmation</label>
                                    <input class="form-control" id="inputPasswordConfirmation"
                                            name="password_confirmation" type="password"
                                            placeholder="Confirm password"
                                            value="{{ old('password_confirmation') }}"/>
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputJoinedTime">Joined Time</label>
                                    <input class="form-control" id="inputJoinedTime" name="joined_time" type="date"
                                            value="{{ old('joined_time') }}"/>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="avatar">Avatar</label>
                                    <input class="form-control" id="avatar" name="avatar" type="file"/>
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button class="btn btn-primary" type="submit">Add user</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection