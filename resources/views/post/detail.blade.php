@extends('master')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">

                <div class="post mb-4">
                    <div class="row">
                        <h4 class="fw-bold my-3">{{$post->title}}</h4>
                        <img src="{{asset('storage/cover/'.$post->cover)}}" class="cover-img w-100 rounded-3 mb-3" alt="">
                        <p class="text-black-50 mb-3 post-detail">
                            {{$post->description}}
                        </p>
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
