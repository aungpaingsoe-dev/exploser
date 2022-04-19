@extends('master')

@section('title')

    @section('content')

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Edit Post</h4>
                        <p class="mb-0">
                            <i class="fa-solid fa-calendar-days"></i>
                            {{ date('d M Y') }}
                        </p>
                    </div>

                    <form action="{{ route('post.update',$post->id) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control border" name="title" value="{{ $post->title }}" id="postTitle" placeholder="name@example.com">
                            <label for="postTitle">Post Title</label>
                            @error('title')
                            <p class='text-danger'>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <img src="{{ asset('storage/cover/'.$post->cover) }}" id="coverPreview" class="w-100 rounded-2 cover-img " alt="">
                            <input type="file" name='cover' id='cover' class="d-none">
                            @error('cover')
                            <p class='text-danger'>{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-floating">
                                <textarea class="form-control" name='description' style="height: 350px"  placeholder="Leave a comment here" id="floatingTextarea">
                                    {{ $post->description }}
                                </textarea>
                                <label for="floatingTextarea">Share Your Experience</label>
                                @error('description')
                                <p class='text-danger'>{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 text-end">
                            <button class="btn btn-primary btn-lg">
                                <i class="fa-solid fa-circle-plus"></i>
                                Update Post
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        @push('script')

            <script>

                let cover = document.querySelector('#cover');
                let coverPreview = document.querySelector('#coverPreview');

                coverPreview.addEventListener("click",function(){
                    cover.click();
                });

                cover.addEventListener("change",function(){
                    let reader = new FileReader();
                    reader.readAsDataURL(cover.files[0]);
                    reader.onload = function(){
                        coverPreview.src = reader.result;
                    }
                });
            </script>

        @endpush

    @endsection

