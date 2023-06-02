@extends('layouts.admin')
@section('main-content')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            Account Settings - Profile
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="{{ route('admin.account.profile') }}">Profile</a>
            <a class="nav-link" href="javascript:void(0)">Security</a>
        </nav>
        <hr class="mt-0 mb-4">
        @if ($errors->any())
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
            <div style="position: absolute; top: 1rem; right: 1rem;">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <h5 class="alert-heading">Alert!</h5>
                    {{ session('success') }}
                    <button class="btn-close" type="button" data-bs-dismiss="alert"
                            aria-label="Close" aria-hidden="true"></button>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Avatar</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <img class="img-account-profile rounded-circle mb-2"
                                src="{{ $user->avatar }}" alt="{{ 'avatar-'.$user->username }}"
                                style="width: 160px; height: 160px">
                        <!-- Profile picture help block-->
                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        <!-- Profile picture upload button-->
                        <form action="{{ route('admin.account.upload-avatar') }}" method="POST"
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
                        <form action="{{ route('admin.account.do-edit-user', ['id' => $user->id]) }}" method="post"
                                enctype="multipart/form-data">
                            @csrf
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1"
                                        for="inputUsername">Username (how your name will appear to other users on the site)</label>
                                <input class="form-control" id="inputUsername" name="username" type="text"
                                        placeholder="Enter your username" value="{{ $user->username }}">
                            </div>
                            <!-- Form Group (fullname)-->
                            <div class="mb-3">
                                <label class="small mb-1"
                                        for="inputFullname">Fullname</label>
                                <input class="form-control" id="inputFullname" name="fullname" type="text"
                                        placeholder="Enter your fullname" value="{{ $user->fullname }}">
                            </div>
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                <input class="form-control" id="inputEmailAddress" name="email" type="email"
                                        placeholder="Enter your email address" value="{{ $user->email }}">
                            </div>
                            <!-- Form Group (address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputAddress">Address</label>
                                <input class="form-control" id="inputAddress" name="address" type="text"
                                        placeholder="Enter your address" value="{{ $user->address }}">
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Phone number</label>
                                    <input class="form-control" id="inputPhone" name="phone" type="tel"
                                            placeholder="Enter your phone number" value="{{ $user->phone }}">
                                </div>
                                <!-- Form Group (role)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputRole">Role</label>
                                    <input class="form-control" id="inputRole" type="text" name="role"
                                            disabled value="{{ $user->role }}">
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