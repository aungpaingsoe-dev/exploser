@extends('master')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="posts">
                    <div class="post mb-4">
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
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
