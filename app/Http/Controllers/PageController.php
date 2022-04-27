<?php

namespace App\Http\Controllers;

use App\Jobs\CreateFile;
use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $posts = Post::latest("id")->paginate(5);
        return view('index',['posts'=>$posts]);
    }

    public function show($slug){
        $post = Post::where('slug',$slug)->with(['comments','galleries'])->firstOrFail();
        return view('post.detail',compact('post'));
    }

    public function jobTest(){

        CreateFile::dispatch()->delay(now()->addSecond(10));

        //php artisan queue:work

        return 'jobTest';

    }
}
