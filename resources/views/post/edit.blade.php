@extends('master')
@section('title')
    Edit Post : {{env('APP_NAME')}}
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Edit Your Post</h4>
                    <p class="mb-0">
                        <i class="fas fa-calendar"></i>
                        {{date("d-M-Y")}}
                    </p>
                </div>
                <form action="{{route('post.update',$post->id)}}" id="editForm" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-floating mb-4">
                        <input type="text" name="title" value="{{old("title",$post->title)}}" class="form-control @error('title') is-invalid @enderror " id="postTitle" placeholder="no need">
                        <label for="postTitle">Post Title</label>
                        @error('title')
                        <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <img src="{{asset('storage/cover/'.$post->cover)}}" id="coverPreview" class="cover-img w-100 @error('cover') is-invalid @enderror rounded" alt="">
                        <input type="file" class="d-none" name="cover" id="cover">
                        @error('cover')
                        <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-4">
                        <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="postDescription" placeholder="no need" style="height: 400px">
                            {{old("description",$post->description)}}
                        </textarea>
                        <label for="postDescription">Share Your Experience</label>
                        @error('description')
                        <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                    </div>

                </form>

                <div class="border rounded p-4 mb-4" id="gallery">

                    <div class="d-flex align-items-stretch">
                        <div id="uploadUi" class="d-flex me-2 border px-5 rounded align-items-center justify-content-center" style="height: 150px;">
                            <i class="fas fa-upload fw-bold"></i>
                        </div>
                        <div class="d-flex overflow-scroll" style="height: 150px;">
                            @forelse($post->galleries as $gallery)
                                <div class="position-relative">
                                    <form action="{{route('gallery.destroy',$gallery->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm position-absolute start-0 bottom-0">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    <img src="{{asset('storage/gallery/'.$gallery->photo)}}" class="h-100 rounded me-2" alt="">
                                </div>
                            @empty

                            @endforelse
                        </div>
                    </div>
                    <form action="{{route('gallery.store')}}" method="post" id="galleryForm" enctype="multipart/form-data">
                        @csrf

                        <div class="d-none">
                            <input value="{{$post->id}}" name="post_id">
                            <input type="file" id="galleryInput" name="galleries[]" class="@error('galleries') is-invalid @enderror @error('galleries.*') is-invalid @enderror" multiple>
                            @error('galleries')
                            <div class="invalid-feedback ps-2">{{$message}}</div>
                            @enderror
                            @error('galleries.*')
                            <div class="invalid-feedback ps-2">{{$message}}</div>
                            @enderror
                        </div>

                    </form>

                </div>

                <div class="text-center mb-4">
                    <button class="btn btn-lg btn-primary" form="editForm">
                        <i class="fas fa-message"></i>
                        Update Post
                    </button>
                </div>

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

        let uploadUi=document.getElementById('uploadUi');
        let galleryInput=document.getElementById('galleryInput');
        let galleryForm=document.getElementById('galleryForm');

        uploadUi.addEventListener('click',_=>galleryInput.click());
        galleryInput.addEventListener('change',_=>galleryForm.submit());
    </script>
@endpush
