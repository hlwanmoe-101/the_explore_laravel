@extends('master')
@section('title')
    Create Post : {{env('APP_NAME')}}
    @endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Create New Post</h4>
                    <p class="mb-0">
                        <i class="fas fa-calendar"></i>
                        {{date("d-M-Y")}}
                    </p>
                </div>
                <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-4">
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror " id="postTitle" placeholder="no need">
                        <label for="postTitle">Post Title</label>
                        @error('title')
                        <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <img src="{{asset('placeholder.jpeg')}}" id="coverPreview" class="cover-img w-100 @error('cover') is-invalid @enderror rounded" alt="">
                        <input type="file" class="d-none" name="cover" id="cover">
                        @error('cover')
                        <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-4">
                        <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="postDescription" placeholder="no need" style="height: 400px"></textarea>
                        <label for="postDescription">Share Your Experience</label>
                        @error('description')
                        <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="text-center mb-4">
                        <button class="btn btn-lg btn-primary">
                            <i class="fas fa-message"></i>
                           Create Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@push('script')
    <script>
        let coverPreview=document.getElementById('coverPreview');
        let cover=document.getElementById('cover');
        coverPreview.addEventListener('click',_=>cover.click());
        cover.addEventListener('change',_=>{
            let reader=new FileReader();
            reader.readAsDataURL(cover.files[0]);
            reader.onload=function () {
                coverPreview.src=reader.result;
            }
        });
    </script>
    @endpush
