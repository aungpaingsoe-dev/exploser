<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $posts = Post::latest("id")->paginate(5);
        return view('index',['posts'=>$posts]);
    }

    public function show($slug){
        $post = Post::where('slug',$slug)->firstOrFail();
        return view('post.detail',compact('post'));
    }

}
