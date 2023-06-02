@extends('layouts.app')

@section('title', 'User Profile')

@section('content')

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h4>User Profile</h4>
                    <div class="footer-underline mb-4"></div>
                </div>

                @if(session('message'))
                    <div class="col-md-10">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                        </div>
                    </div>
                @endif

                <div class="col-md-10">
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <h4 class="mb-0 text-white">User Details</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('profile') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control"
                                               value="{{ $user->username ?? '' }}" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control"
                                               value="{{ $user->email ?? '' }}" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Full name</label>
                                        <input type="text" name="fullname" class="form-control"
                                               value="{{ $user->fullname ?? '' }}">
                                        @if($errors->has('fullname'))
                                            <span class="text-danger">{{ $errors->first('fullname') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label>Gender</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="male"
                                                   value="1" {{ $user->gender == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="female"
                                                   value="0" {{ $user->gender == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="female">Female</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Phone number</label>
                                        <input type="text" name="phone" class="form-control"
                                               value="{{ $user->phone ?? '' }}">
                                        @if($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <label>Address</label>
                                        <textarea row="3" name="address"
                                                  class="form-control">{{ $user->address ?? '' }}</textarea>
                                        @if($errors->has('address'))
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
