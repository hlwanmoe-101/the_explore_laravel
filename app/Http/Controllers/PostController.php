<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $newName="cover_".uniqid().".".$request->file('cover')->extension();
        $request->file('cover')->storeAs("public/cover",$newName);

        $post=new Post();
        $post->title=$request->title;
        $post->slug=Str::slug($request->title);
        $post->description=$request->description;
        $post->excerpt=Str::words($request->description,50);
        $post->cover=$newName;
        $post->user_id=auth()->id();
        $post->save();

        return redirect()->route('index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.detail',["post"=>$post->slug])->except('index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        Gate::authorize('update',$post);
        return view('post.edit',["post"=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

        $post->title=$request->title;
        $post->slug=Str::slug($request->title);

        $post->description=$request->description;
        $post->excerpt=Str::words($request->description,50);

        if($request->hasFile('cover')){
            //delete old photo
            Storage::delete('public/cover/'.$post->cover);
            //update photo
            $newName="cover_".uniqid().".".$request->file('cover')->extension();
            $request->file('cover')->storeAs("public/cover",$newName);
            $post->cover=$newName;
        }
        $post->update();

        return redirect()->route('post.detail',$post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete',$post);
        Storage::delete('public/cover/'.$post->cover);
        $post->delete();
        return redirect()->route('index');
    }
}
