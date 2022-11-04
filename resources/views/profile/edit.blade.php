@extends('master')
@section('title') Edit Profile @endsection
@section('content')

    <div class="container">
        <div class="row justify-content-center min-vh-100">
            <div class="col-lg-6 col-xl-5">
                <h4 class="text-center fw-bold my-5"><i class="fas fa-pen"></i> Update Your Profile</h4>
                <div class="text-center">


                    <img src="{{asset(auth()->user()->photo)}}" id="uploadUi" class="profile-photo @error('userPhoto') border border-danger is-invalid @enderror" alt="">
                    <br>
                    <button class="btn btn-sm btn-primary rounded-circle" id="uploadUiBtn" style="margin-top: -30px">
                        <i class="fas fa-camera"></i>
                    </button>

                    @error('userPhoto')
                    <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                    <p class="mb-0">{{auth()->user()->name}}</p>
                    <p class="text-black-50 samll">{{auth()->user()->email}}</p>
                </div>
                <form action="{{route('update-profile')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="userPhoto" id="userPhoto" accept="image/jpeg" class="d-none">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('yourName') is-invalid @enderror" id="yourName" name="yourName" value="{{auth()->user()->name}}" placeholder="no need">
                        <label for="yourName">User Name</label>
                        @error('yourName')
                            <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input disabled type="email" class="form-control" id="email" value="{{auth()->user()->email}}" placeholder="no need">
                        <label for="email">Email</label>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-lg btn-primary">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@push('script')
    <script>
        let uploadUi=document.getElementById('uploadUi');
        let uploadUiBtn=document.getElementById('uploadUiBtn');
        let userPhoto=document.getElementById('userPhoto');
        uploadUiBtn.addEventListener('click',_=>userPhoto.click());
        userPhoto.addEventListener('change',_=>{
            let reader=new FileReader();
            reader.readAsDataURL(userPhoto.files[0]);
            reader.onload=function () {
                uploadUi.src=reader.result;
            }
        });
    </script>
    @endpush
