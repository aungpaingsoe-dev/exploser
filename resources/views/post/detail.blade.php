@extends('master')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="posts">
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-xl-12">
                                <h4 class="fw-bolder p-2">{{ $post->title }}</h4>
                                <img src="{{ asset('storage/cover/'.$post->cover) }}" class="cover-img rounded-3 w-100" alt="">
                            </div>
                            <div class="col-xl-12">
                                <div class="d-flex flex-column justify-content-between  py-2">
                                    <div>
                                        <p>
                                            {{ $post->description }}
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex">
                                            <img src="{{ asset($post->user->photo) }}" class="user-img rounded-circle border-1 border-white shadow-sm" alt="">
                                            <p class="mb-0 ms-2 small">
                                                {{ $post->user->name }}
                                                <br>
                                                <i class="fa-solid fa-calendar-days"></i>
                                                {{ $post->created_at->format("d M Y") }}
                                            </p>
                                        </div>
                                        <div>
                                            @auth
                                                @can('delete',$post)
                                                    <form action="{{ route('post.destroy',$post->id) }}" class="d-inline-block" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-outline-danger" ><i class="fa-solid fa-trash fa-fw"></i></button>
                                                    </form>
                                                @endcan

                                                @can('update',$post)
                                                    <a href="{{ route('post.edit',$post->id) }}" class="btn btn-outline-warning"><i class="fa-solid fa-pen-to-square fa-fw"></i></a>
                                                @endcan


                                            @endauth
                                            <a href="{{ route('index') }}" class="btn btn-outline-primary">Read All</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($post->galleries->count())
                        <div class="gallery mb-4 border rounded p-2">
                            <div class="row text-center">
                                <h5 class="fw-bold">Photos Gallery</h5>
                                @foreach($post->galleries as $gallery)
                                    <div class="col-lg-4 col-xl-3">
                                        <a class="venobox" href="{{ asset('storage/gallery/'.$gallery->photo) }}">
                                            <img src="{{ asset('storage/gallery/'.$gallery->photo) }}" class="img-fluid img-thumbnail rounded-1 my-2" height="250px;" alt="">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @auth()
                        <div id="comment" class="comment mb-4">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <form action="{{ route('comment.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <div class="form-floating mb-4">
                                            <textarea class="form-control @error('message') is-invalid border-danger @endError" name="message" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                            @error('message')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <label for="floatingTextarea2">Comments</label>
                                        </div>
                                        <div class="d-flex justify-content-center mb-2">
                                            <button class="btn btn-primary">Send Comment</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endauth

                    @foreach($post->comments as $comment)
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="card rounded-2 p-3 mb-2">
                                    <div class="d-flex justify-content-between align-items-center mb-2 ">
                                        <div class="d-flex align-items-center ">
                                            <img src="{{ asset( $comment->user->photo ) }}" class="user-img rounded-circle border-1 border-white shadow-sm" alt="">
                                            <div class="ms-1">
                                                <span class="fw-bold fs-12">{{ $comment->user->name }}</span> <br>
                                                <i class="fa-solid fa-clock"></i>
                                                <span class="fs-6">{{ $comment->created_at->diffforHumans()}}</span>
                                            </div>
                                        </div>
                                        @can('delete',$comment)
                                            <div class="ms-5">
                                                <form action="{{ route('comment.destroy',$comment->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-link "><i class="fa-solid fa-trash text-danger"></i></button>
                                                </form>
                                            </div>
                                        @endcan
                                    </div>
                                    <span class="text-black border-1 border-dark py-2 fs-12">{{ $comment->message }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
