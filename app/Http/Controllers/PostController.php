<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'title' => 'required|min:5|unique:posts,title',
            'description' => 'required|min:15',
            'cover' => 'required|file|mimes:png,jpg|max:5000'
        ]);

        $newName = 'cover_'.uniqid()."_.".$request->file('cover')->extension();
        $request->file('cover')->storeAs('public/cover',$newName);

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description,150);
        $post->cover = $newName;
        $post->user_id = Auth::id();
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
        //
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
        return view('post.edit',compact('post'));
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
        $request->validate([
            'title' => "required|min:5|unique:posts,title,$post->id",
            'description' => 'required|min:15',
            'cover' => 'nullable|file|mimes:png,jpg'
        ]);

        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description,150);

            if($request->hasFile('cover')){

                Storage::delete('public/cover/'.$post->cover);

                $newName = 'cover_'.uniqid()."_.".$request->file('cover')->extension();
                $request->file('cover')->storeAs('public/cover',$newName);
                $post->cover = $newName;
            }
        $post->update();

        return redirect()->route('show',$post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Gate::authorize('update',$post);
        Storage::delete('public/cover/'.$post->cover);
        $post->delete();
        return redirect()->route('index');
    }
}
