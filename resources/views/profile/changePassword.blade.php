@extends('master')
@section('title') Edit Profile @endsection
@section('content')

    <div class="container">
        <div class="row justify-content-center min-vh-100">
            <div class="col-lg-6 col-xl-5">
                <h4 class="text-center fw-bold my-5"><i class="fas fa-pen"></i> Update Your Profile</h4>
                <div class="text-center">


                    <img src="{{asset(auth()->user()->photo)}}" class="profile-photo" alt="">
                    <p class="mb-0">{{auth()->user()->name}}</p>
                    <p class="text-black-50 samll">{{auth()->user()->email}}</p>
                </div>
                <form action="{{route('change-password')}}" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('currentPassword') is-invalid @enderror" id="currentPassword" name="currentPassword" placeholder="no need">
                        <label for="currentPassword">Current Password</label>
                        @error('currentPassword')
                        <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('newPassword') is-invalid @enderror" id="newPassword" name="newPassword" placeholder="no need">
                        <label for="newPassword">New Password</label>
                        @error('newPassword')
                        <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('confirmPassword') is-invalid @enderror" id="confirmPassword" name="confirmPassword" placeholder="no need">
                        <label for="confirmPassword">Confirm Password</label>
                        @error('confirmPassword')
                        <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button class="btn btn-lg btn-primary">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

