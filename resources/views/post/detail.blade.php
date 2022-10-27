@extends('master')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">

                <div class="post mb-4">
                    <div class="row">
                        <h4 class="fw-bold my-3">{{$post->title}}</h4>
                        <img src="{{asset('storage/cover/'.$post->cover)}}" class="cover-img w-100 rounded-3 mb-3" style="object-fit: cover" alt="">
                        <p class="text-black-50 mb-3 post-detail">
                            {{$post->description}}
                        </p>
                        @if($post->galleries->count())
                            <div class="gallery border rounded mb-5">
                                <h4 class="text-center fw-bold mt-4">Gallery</h4>
                                <div class="row g-4 py-4 px-2 d-flex justify-content-center">
                                    @foreach($post->galleries as $gallery)
                                    <div class="col-6 col-lg-4 col-xl-3">
                                        <a data-gall="gall" class="venobox" href="{{asset('storage/gallery/'.$gallery->photo)}}">
                                            <img src="{{asset('storage/gallery/'.$gallery->photo)}}" class="gallery-photo" alt="">
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endisset

                        <div class="mb-4">
                            <h4 class="text-center fw-bold mb-4">User Comment</h4>
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="comments mb-4">
                                        @forelse($post->comments as $comment)
                                            <div class="border rounded-3 p-3 mb-2">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <div class="d-flex">
                                                        <img src="{{asset($post->user->photo)}}" class="user-img rounded-circle" alt="">
                                                        <p class="mb-0 ms-2 small">
                                                            {{$comment->user->name}}
                                                            <br>
                                                            <i class="fas fa-calendar"></i>
                                                            {{$post->created_at->format("d-M-Y")}}
                                                        </p>
                                                    </div>
                                                    @can('delete',$comment)
                                                    <div>
                                                        <form action="{{route('comment.destroy',$comment->id)}}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-sm btn-outline-danger rounded-circle border-0">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>

                                                    </div>
                                                        @endcan
                                                </div>
                                                <p class="mb-0">
                                                    {{$comment->message}}
                                                </p>
                                            </div>
                                            @empty
{{--                                            <p class="text-center">There is no Comments</p>--}}
                                        @endforelse
                                    </div>
                                    @auth
                                        <form action="{{route('comment.store')}}" method="post" id="commentForm">
                                            @csrf
                                            <input type="hidden" value="{{$post->id}}" name="post_id">
                                            <div class="form-floating mb-2">
                                            <textarea type="text" name="message" class="form-control @error('message') is-invalid @enderror" id="create_comment" placeholder="no need" style="height: 100px">
                                            </textarea>
                                                <label for="create_comment">Your Comment</label>
                                                @error('message')
                                                <p class="invalid-feedback">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="text-center">
                                                <button class="btn btn-lg btn-primary">
                                                    <i class="fa-sharp fa-solid fa-paper-plane"></i>
                                                </button>
                                            </div>
                                        </form>
                                        @endauth
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center border rounded p-4">
                            <div class="d-flex">
                                <img src="{{asset($post->user->photo)}}" class="user-img rounded-circle" alt="">
                                <p class="mb-0 ms-2 small">
                                    {{$post->user->name}}
                                    <br>
                                    <i class="fas fa-calendar"></i>
                                    {{$post->created_at->format("d-M-Y")}}
                                </p>
                            </div>

                            <div>
                                @auth
                                    @can('delete',$post)
                                        <form action="{{route('post.destroy',$post->id)}}" method="post" class="d-inline-block">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-outline-danger">
                                                <i class="fas fa-trash-alt fa-fw"></i>
                                            </button>
                                        </form>
                                    @endcan
                                    @can('update',$post)
                                        <a href="{{route('post.edit',$post->id)}}" class="btn btn-outline-warning">
                                            <i class="fas fa-edit fa-fw"></i>
                                        </a>
                                    @endcan
                                @endauth
                                <a href="{{route('index')}}" class="btn btn-outline-primary">Read ALL</a>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
